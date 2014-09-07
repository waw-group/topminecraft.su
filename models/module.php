<?php
/**
 * Created by PhpStorm.
 * User: mops1k
 * Date: 15.03.14
 * Time: 10:48
 */
abstract class Module {
    protected $setup;
    public function __construct()
    {
        global $setup;
        $this->setup = $setup;
    }
    function __destruct()
    {
        R::close();
    }
}