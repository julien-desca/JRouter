<?php

namespace Router;

class RouteString extends Route{

  public function __construct(string $path, string $action){
    parent::__construct($path, $action);
  }

  public function call(){
    if(!isset($this->callable)){
      throw new RouteException("No Action Set.");
    }
    if(!strpos($this->callable, "@")){ //a regex could be better @TODO
        throw new RouteException("Bad Syntax Action Set.");
    }
    $controllerName; $methodName;
    $actionSplit = explode("@", $this->callable);
    $controllerName = $actionSplit[0];
    $methodName = $actionSplit[1];
    try{
       $controller = new $controllerName();
       $reflectionMethod = new \ReflectionMethod($controllerName, $methodName);
       return $reflectionMethod->invoke($controller, ...$this->matches);
    }
    catch(\ArgumentCountError $e){
      throw new RouterException("Inval argument count.");
    }
  }
}
