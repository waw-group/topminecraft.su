<?php
// Класс для работы с конфигом
class cfg extends Singleton
{
    public static $cfg;
    public static $lng;
    public static $lng_type;

    /**
     * Init all configs & languages to arrays
     */
    public static function init()
    {
        global $config;
        self::$cfg = $config();
        $lng = $config(ROOT_DIR . "/languages/");
        self::$lng_type = self::$cfg['config']['main']['language'];
        self::$lng = $lng[self::$lng_type];
    }
    /**
     * Write configs to files
     * @param array $array 3 dimensional array. Example $array['filename']['section']['key']
     * @return int|string Return error string if false or 0 if true
     */
    public static function set($array)
    {
        $err_file = array();
        foreach($array as $file => $array)
        {
            $file = ROOT_DIR."/data/".$file.".ini";
            if(file_exists($file))
            {
                if(!is_writable($file))
                {
                    $err_file[] = $file;
                    continue;
                }
            }
            else
            {
                if(!is_writable(ROOT_DIR."/data/"))
                {
                    $err_file[] = ROOT_DIR."/data/";
                    continue;
                }
            }
            $handle = fopen($file,"w+");
            $string = null;
            foreach($array as $section => $array)
            {
                $string .= "[$section]\r\n";
                foreach($array as $key => $value)
                {
                    $string .= "$key = \"".(string)$value."\"\r\n";
                }
            }
            if($handle)
            {
                if(fwrite($handle,$string))
                {
                    fclose($handle);
                }
            }
        }
        if(count($err_file) > 0)
        {
            $err_string = null;
            foreach($err_file as $key => $value)
            {
                $err_string .= $value." is not writable!\r\n";
            }
            return $err_string;
        } else return 0;
    }
}
