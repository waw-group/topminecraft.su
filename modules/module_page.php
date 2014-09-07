<?php
/*
* Module for Controller_page
*/
class Module_page extends Module
{
    public function getPage($name)
    {
        $page = R::find('mcspage',' name = :name',array( ':name' => $name ));
        return $page;
    }
    public function setPage($name,$title,$content)
    {
        $page = R::dispense('mcspage');
        $page->name = $name;
        $page->title = $title;
        $page->content = $content;
        return R::store($page);
    }
    public function getAllPages()
    {
        $pages = array();
        $p = R::findAll('mcspage');
        foreach($p as $v)
        {
            $pages[] = array( 0 => $v->name, 1 => $v->title );
        }
        return $pages;
    }
    public function editPage($id,$name,$title,$content)
    {
        $page = R::load('mcspage',$id);
        $page->name = $name;
        $page->title = $title;
        $page->content = $content;
        return R::store($page);
    }
    public function deletePage($id)
    {
        $page = R::load('mcspage',$id);
        return R::trash($page);
    }
}