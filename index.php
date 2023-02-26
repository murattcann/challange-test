<?php
require_once "./vendor/autoload.php";
require_once "./config.php";
session_start();

try {
    $routes = require_once "./src/routes.php";

    $currentRoute = $_GET["route"] ?? "home";
    if(!$currentRoute || !isset($routes[$currentRoute])) {
        throw new \App\Exceptions\RouteNotFoundException(message: "Route Not Found", code: 404);
    }

    $currentRouteData = $routes[$currentRoute];

    $controller = new ReflectionClass($currentRouteData["controller"]);
    $method = new ReflectionMethod($currentRouteData["controller"], $currentRouteData["action"]);

    if(!class_exists($controller->getName())){
        throw  new \App\Exceptions\ControllerNotFoundException("Controller Not Found");
    }

    $method->invoke(new $currentRouteData["controller"]);

}catch (Throwable $exception){
    echo $exception->getCode(). " -- ".$exception->getMessage(). " on line: #". $exception->getLine(). " --> File: " . $exception->getFile();
}