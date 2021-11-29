<?php

class Router{
    function __construct($route){
        // var_dump($route);
        /* structure d'une route 
           /controllerName/actionOfTheController/id
        */
        $route = trim($route, '/');
        $route = filter_var($route, FILTER_SANITIZE_URL);
        $route = explode('/',$route);

        $controllerName= array_shift($route);
        // var_dump($controllerName);
        // var_dump($route);


        /* structure des noms de fichiers correspondants aux controllers
            <nameOfTheController class="controller php"></nameOfTheController>
        */
        $controllerFilePath = "controller/$controllerName.controller.php";
        if(!file_exists($controllerFilePath)){
            // die("File for the controller :\"$controllerName\" not found ==> c'est pas bien hein");
            header("Location: /error404");
            die;
        }
        // require_once $controllerFilePath;
        // structure des noms en classes correspondants aux controllers NameController;
        $controllerName = ucfirst($controllerName)."Controller";
        $this->controller = new $controllerName($route);
    }

    function render(){
            // cette fonction renvoie le contenu de la class (les données)
            return $this->controller->content;

    }
}