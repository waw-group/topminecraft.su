<?php

/**
 * Класс шаблонизатора системы
 */
class templates extends Singleton {
    /**
     * Путь к папке с шаблонами
     * @var string
     */
    public $path = './';
    /**
     * Название шаблона
     * @var null
     */
    public $name = null;
    public $_data = array();
    public $_blocks = array();
    private $str = null;
    var $time = 0;
    
    function __construct() {
        $this->time = microtime();
    }

    /**
     * Задает переменную шалона и ее значение
     * @param string $name
     * @param string $string
     */
    public function set($name, $string) {
        $exists = false;
        if(is_array($this->_data)) {
            foreach($this->_data as $key => $val) {
                if(isset($val[$name])) {
                    $this->_data[$key] = array($name => $string);
                    $exists = true;
                    break;
                }
            }
        }
        if(!$exists) $this->_data[] = array($name => $string);
    }

    /**
     * Загружает шаблон
     * @param string $file
     */
    public function load_tpl($file) {
        if(!file_exists($this->path.$this->name."/".$file))
            die("Невозможно загрузить файл шаблона: {$file}!");
        $string = file_get_contents($this->path.$this->name."/".$file);
        $string = preg_replace_callback( "#\\{include file=['\"](.+?)['\"]\\}#is",function($m){
              return $this->sub_load($m[1]);
            }, $string);
        $this->str = $string;
    }

    /**
     * Получает блок в шаблоне
     * @param string $var
     */
    public function get_block($var) {
        $string = $this->str;
        if(preg_match("/\[".$var."\]([\w\W\s]*)\[\/".$var."\]/", $string, $output_array)) {
            $this->_blocks[$var] = $output_array[1];
        }
    }

    /**
     * Получить все блоки в шаблоне
     * @param array $array
     */
    public function get_blocks($array) {
        for($i = 0; $i < count($array); $i++) {
            $string = $this->str;
            if(preg_match("/\[".$array[$i]."\]([\w\W\s]*)\[\/".$array[$i]."\]/", $string, $output_array)) {
                $this->_blocks[$array[$i]] = $output_array[1];
            }
        }
    }

    /**
     * Изменяет блок
     * @param string $var
     * @param string $value
     */
    public function set_block($var, $value) {
        $this->str = preg_replace_callback("/\[".$var."\]([\w\W\s]*)\[\/".$var."\]/",function() use ($value) {
              return $value;
        }, $this->str);
    }

    /**
     * Удаляет блок и его содержимое
     * @param $var
     */
    public function remove_block($var) {
        $this->str = preg_replace_callback("/\[".$var."\]([\w\W\s]*)\[\/".$var."\]/", function() {
              return "";
          }, $this->str);
    }

    /**
     * Загружает шаблон и отдает в видет текста
     * @param string $file
     * @return mixed|string
     */
    public function sub_load($file) {
        $ext = function($file) {
            $i = explode(".",$file);
            return $i[count($i)-1];
        };
        if($ext($file) != "php") {
            if(!file_exists($this->path.$this->name."/".$file))
                die("Невозможно загрузить файл шаблона: {$file}!");
            return $this->parseVal(file_get_contents($this->path.$this->name."/".$file));
        } else {
            if(!file_exists($file))
                die("Невозможно загрузить файл php: {$file}!");
            ob_start();
            include($file);
            $php = ob_get_clean();
            return $php;
        }
    }
    
    private function parseVal($string) {
        $count = count($this->_data);
        for($i = 0; $i < $count; $i++) {
            foreach($this->_data[$i] as $key => $value) {
                $string = str_replace("{".$key."}",$value,$string);
            }
        }
        foreach($this->_blocks as $key => $value) {
            $string = preg_replace_callback("/\[".$key."\]([\w\W\s]*)\[\/".$key."\]/",function($m){
                  return $m[1];
              }, $string);
        }
        $string = preg_replace_callback( "#\\{lng\.(.+?)\\}#is",function($m){
              return isset(cfg::$lng[$m[1]]) ? cfg::$lng[$m[1]] : "lng.".$m[1];
            }, $string);
        $string = preg_replace_callback( "#\\{post\.(.+?)\\}#is",function($m){
              return isset($_POST[$m[1]]) ? $_POST[$m[1]] : "";
            }, $string);
        $string = preg_replace_callback( "#\\{get\.(.+?)\\}#is",function($m){
              return isset($_GET[$m[1]]) ? $_GET[$m[1]] : "";
            }, $string);
        return $string;
    }
    
    public function clear() {
        $this->str = "";
    }

    /**
     * Компонует и выводит на экран
     */
    public function view() {
        $this->time = round(microtime() - $this->time,4);
        $this->set("time",$this->time);
        echo $this->parseVal($this->str);
    }
}