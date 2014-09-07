<?php

header ( "Content-type: text/html; Charset=utf-8" );

ini_set('display_errors', 'On'); // вывод ошибок на экран, чтобы понять в чем проблема (на время devel стадии, перед release УДАЛИТЬ!!!)
ini_set('html_errors', 'off'); // вывод ошибок в формате HTML

error_reporting ( E_ALL );

session_start();
define("ROOT_DIR", dirname(__FILE__));
define("DATA", ROOT_DIR . '/data/');
spl_autoload_register(function ($class_name)
{
    $paths = array(ROOT_DIR . "/modules/", ROOT_DIR . "/models/", ROOT_DIR . "/controllers/", ROOT_DIR . "/ajax/");
    foreach ($paths as $value) {
        $file = $value . strtolower($class_name) . ".php";
        if (file_exists($file)) {
            require ($file);
            break;
        }
    }
});
/**
 * Функция получения конфигов и языковых файлов
 * @param string $dir
 * @return string
 */
$config = function ($dir = DATA)
{
    $array = "";
    foreach (glob($dir . "*.ini") as $path) {
        $array[basename($path, ".ini") ] = parse_ini_file($path, true);
    }
    if(isset($array['config']['main']['url_lang']) AND $array['config']['main']['url_lang'] == "true")
    {
        $array['config']['main']['language'] = substr($_SERVER['HTTP_HOST'],0,2);
    }
    return $array;
};
cfg::init();

require ROOT_DIR . "/models/rb.phar";

$setup = R::setup("mysql:host=".cfg::$cfg['database']['mysql']['host'].";dbname=".cfg::$cfg['database']['mysql']['database'],
    cfg::$cfg['database']['mysql']['user'],
    cfg::$cfg['database']['mysql']['password']);

ROUTE::gI()->parse(array("news", "list"));

R::close();