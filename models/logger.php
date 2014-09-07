<?php
/*
* logger class for the system
*/
class Logger extends Module
{
    /**
     * Write log to db
     * @param string $text
     * @param string $user
     * @return int $id
     */
    public function set($user,$text)
    {
        $log = R::dispense('mcslogs');
        $log->date = date("d.m.Y H:i:s");
        $log->user = $user;
        $log->text = $text;
        return R::store($log);
    }

    /**
     * Get log by id
     * @param $id
     * @return \RedBeanPHP\OODBBean
     */
    public function get($id)
    {
        $log = R::load('mcslogs',$id);
        return $log;
    }

    /**
     * Get all logs or logs by user
     * @param string $user
     * @return array
     */
    public function getAll($user = "")
    {
        $log = $user == "" ? R::findAll('mcslogs') : R::findAll('mcslogs',' user = :user', array( ':user' => $user ));
        return $log;
    }
}