<?php

class Core 
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        //Set current controller
        if(isset($url[0]) && file_exists('../app/controller/' . ucwords($url[0]). '.php')){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../app/controller/' . $this->currentController . '.php';

        //Init controller
        $this->currentController = new $this->currentController;

        //Set current method
        if(isset($url[1]) && method_exists($this->currentController, $url[1])){
            $this->currentMethod = $url[1];
            unset($url[1]);
        }

        //Leave the rest in params
        $this->params = $url ? array_values($url) : [];
        
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}