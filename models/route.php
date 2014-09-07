<?php
class ROUTE extends Singleton
{   protected $response;
    public function parse($response) {
        $request = urldecode($_SERVER['REQUEST_URI']);
        $host = $_SERVER['HTTP_HOST'];
        $address = "http://".$host."/".$request;


        if(preg_match("/http:\/\/[a-zA-Z0-9а-яА-Я\-\.]+\/([a-zA-Z0-9а-яА-Я\-\._\/]*)(.*)/", $address, $output_array)) {
          $request = $output_array[1];
        }
        $request_type = $_SERVER['REQUEST_METHOD'];
        $request = str_replace(".html","",$request);
        $request = str_replace(cfg::$cfg['config']['main']['path'],"",$request);
        $request = str_replace("index.php/","",$request);
        $request = str_replace("index.php","",$request);
        $request = substr($request,1);
        $request = urldecode($request);
        $request = htmlspecialchars($request);
        $request = explode('/',$request);
        if(count($request) != 0) {
            if($request[0] !== "ajax") {
                if($request[0] == "") $request = $response;
                $this->response = $request;
                if(!file_exists(ROOT_DIR.'/controllers/controller_'.$request[0].'.php')) exit($this->error404());
                // Вставка, чтобы не возникало проблем с открытием админки
                if(empty($request[1]) OR !isset($request[1])) $request[1] = "index";
                if($request[0] == 'admin' AND (empty($request[1]) OR !isset($request[1]))) $request[1] = "index";
                // Конец вставки
                $class = 'Controller_'.$request[0];
                $action = 'Action_'.$request[1];
                if($request_type == "POST") {
                    if(method_exists($class, $action.'_post')) $action = $action.'_post';
                }
            } else {
                if(!file_exists(ROOT_DIR.'/ajax/ajax_'.$request[1].'.php'))  $request = $response;
                $class = 'Ajax_'.$request[1];
                $action = 'Action_'.$request[2];
            }

            if(method_exists($class, $action)) {
                $controller = new $class();
                $controller->$action();
            } else {
                $this->error404();
            }
        }
    }
    
    public function get_request()
    {
        $return = "";
        $request = urldecode($_SERVER['REQUEST_URI']);
        $host = $_SERVER['HTTP_HOST'];
        $address = "http://".$host."/".$request;
        if(preg_match("/http:\/\/[a-zA-Z0-9а-яА-Я\-\.]+\/([a-zA-Z0-9а-яА-Я\-\._\/]*)(.*)/", $address, $output_array)) {
          $request = $output_array[1];
        }
        $request = str_replace(".html","",$request);
        $request = str_replace(cfg::$cfg['config']['main']['path'],"",$request);
        $request = str_replace("index.php/","",$request);
        $request = str_replace("index.php","",$request);
        $request = substr($request,1);
        $request = urldecode($request);
        $request = htmlspecialchars($request);
        $request = explode('/',$request);
        if($request[0] == "") $request = $this->response;
        if(count($request) > 2 && $request[0] != 'ajax') {
            for($i = 2; $i < count($request); $i++) {
                $return[] = $request[$i];
            }
            return $return;
        } elseif (count($request) > 3 && $request[0] == 'ajax') {
            for($i = 3; $i < count($request); $i++) {
                $return[] = $request[$i];
            }
            return $return;
        } else return false;
    }
    public function error404() {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        echo "Error 404 - Page not found";
        die();
    }
    public function getType() {
        $request = $_SERVER['REQUEST_URI'];
        $request = str_replace("index.php/","",$request);
        $request = str_replace("index.php","",$request);
        $request = substr($request,1);
        $request = explode('/',$request);
        if(isset($request[0]) AND $request[0] == "ajax") return "ajax";
        elseif(isset($request[0]) AND $request[0] == "admin") return "admin";
        else return "client";
    }
}
