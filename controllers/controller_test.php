<?php

Class Controller_test extends Controller
{
    public function Action_test()
    {
        //$array['test']['section']['key'] = "test";
        templates::gI()->set_block('content',cfg::set(cfg::$cfg));
    }
    public function Action_test_post()
    {
        templates::gI()->set_block('title','test post controller');
    }
}
if(isset($title)) {
    include_once 'main.php';
}
