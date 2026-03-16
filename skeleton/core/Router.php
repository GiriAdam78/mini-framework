<?php

namespace Core;

class Router{
    private $routes = [];

    public function get($uri, $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function run($request)
    {
       
        $method = $request->method();
        $uri = $request->uri();

        if(isset($this->routes[$method][$uri])){

            $action = $this->routes[$method][$uri];

            // If Clousure
            if($action instanceof \Closure){
                echo $action();

                return;
            }
            
            [$controller, $method] = explode('@', $action);

            $controller = "App\\Controllers". $controller;

            $controller = new $controller;

            $controller->method();
        }else{
           throw new \Core\Exceptions\NotFoundException("Page Not Found");
        }
    }
}