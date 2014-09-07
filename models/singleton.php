<?php

abstract class Singleton
{
    // в $_aInstances будут хранится все
    // экзмепляры всех классов наследующих класс Singleton
    private static $_aInstances = array();

    /**
     * Returns the application singleton or null if the singleton has not been created yet.
     * @return templates|ROUTE|auth the application singleton, null if the singleton has not been created yet.
     */
    public static function getInstance()
    {
        $sClassName = get_called_class();
        if (class_exists($sClassName)) {
            if (!isset(self::$_aInstances[$sClassName]))
                self::$_aInstances[$sClassName] = new $sClassName();
            return self::$_aInstances[$sClassName];
        }
        return 0;
    }

    public static function gI()
    {
        return self::getInstance();
    }

    final private function __clone()
    {
    }
}