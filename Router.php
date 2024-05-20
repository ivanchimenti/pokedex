<?php

class Router
{
    private $defaultController;
    private $defaultMethod;

    public function __construct($defaultController, $defaultMethod)
    {
        $this->defaultController = $defaultController;
        $this->defaultMethod = $defaultMethod;
    }

    public function route($controller,$action,$id){
        $controller = $this->getControllerFrom($controller);
        $this->executeMethodFromController($controller, $action,$id);
    }

    private function getControllerFrom($module)
    {
        $controllerName = 'get' . ucfirst($module) . 'Controller';
        $validController = method_exists("Configuration", $controllerName) ? $controllerName : $this->defaultController;
        return call_user_func(array("Configuration", $validController));
    }

    private function executeMethodFromController($controller, $method,$id)
    {
        $validMethod = method_exists($controller, $method) ? $method : $this->defaultMethod;
        call_user_func(array($controller, $validMethod));
//        $reflectionMethod = new ReflectionMethod($controller, $validMethod);
//        $parameters = $reflectionMethod->getParameters();

//        if (count($parameters) > 0) {
//            // Llamar al método del controlador con el ID como argumento
//            call_user_func(array($controller, $validMethod), $id);
//        } else {
//            // Llamar al método del controlador sin argumentos
//            call_user_func(array($controller, $validMethod));
//        }
    }
}