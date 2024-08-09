<?php

class Routeur{
    public array $routes;
    public function register(string $path,callable $action):void{
        $this->routes[$path] = $action;
    }

    public function resolve(string $uri){
        $path = explode('?', $uri)[0];
        $action = $this->routes[$path] ?? null;

        if(!is_callable($action)){
            header("HTTP/1.1 404 Not Found");
            include("view/404_real.php");
            throw new Exception('Cette route n\'existe pas');
        }
        return $action();
    }



}

?>