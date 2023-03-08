<?php

namespace App\Libraries;

class Router
{
    private string $url;
    private array $url1;
    private  $controller;
    private $metodo = "index";
    private $parametros=[];


    public function __construct()
    {
        $url = $this->url() ?? [0];

        if (file_exists(dirname(__DIR__).DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR.ucwords($url[0]).".php")) {

            $this->controller = ucwords($url[0]);
            unset($url[0]);
            $carregar = "\\App\\Controllers\\" . $this->controller;
            $this->controller = new $carregar;
        } elseif (file_exists(dirname(__DIR__).DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR."admin".DIRECTORY_SEPARATOR.ucwords($url[0]).".php")) {

            $this->controller = ucwords($url[0]);
            unset($url[0]);
            $carregar = "\\App\\Controllers\\admin\\" . $this->controller;
            $this->controller = new $carregar;
            
        } 
        elseif(empty($url[0])){
            
            $this->controller = ucwords("home");
            $carregar = "\\App\\Controllers\\" . $this->controller;
            $this->controller = new $carregar;
        }
        else {
            $this->controller = "Error";
            $carregar = "\\App\\Controllers\\" . $this->controller;
            $this->controller = new $carregar;
        }
      
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) :
                $this->metodo = $url[1];
                unset($url[1]);
            endif;
        }
        $this->parametros=$url? array_values($url) : [];
        call_user_func_array([$this->controller,$this->metodo],$this->parametros);
        
    }


    private function url()
    {
        if (!empty(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL))) :
            $this->url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
            $this->url = trim(rtrim($this->url));
            $this->url1 = explode('/', $this->url);

            return $this->url1;
        endif;
    }
}
