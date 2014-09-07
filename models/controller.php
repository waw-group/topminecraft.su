<?php
abstract class Controller
{
    protected $request;
    protected $class;
    protected $settings;
    public function __construct()
    {
        $this->request = ROUTE::gI()->get_request();
        $this->settings = new Module_settings();
        $template = $this->settings->getKey('template');
        templates::gI()->path = "templates/".$template."/";
        templates::gI()->set("THEME", "/".cfg::$cfg['config']['main']['path'].templates::gI()->path);
        templates::gI()->load_tpl('index.tpl');
        templates::gI()->get_blocks(array(
            'content',
            'pages',
            'title',
            'pagination'
        ));
        $links = null;
        $pages = $this->getClass('Module_page')->getAllPages();
        foreach($pages as $page)
        {
            templates::gI()->set('name',$page[0]);
            templates::gI()->set('title', $page[1]);
            $links .= templates::gI()->sub_load('page_links.tpl');
        }
        templates::gI()->set_block('pages',$links);
    }
    public function getClass($name)
    {
        if (!isset($this->class[$name]))
            $this->class[$name] = new $name();
        return $this->class[$name];
    }
    function __destruct()
    {
        R::close();
  	    templates::gI()->view();
    }
}
