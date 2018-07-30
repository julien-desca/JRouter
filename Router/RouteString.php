<?php

namespace Router;

/**
 * Route which call a controller action
 * Class RouteString
 * @package Router
 */
class RouteString extends Route{

    /**
     * call the catio n
     * @return mixed|void
     * @throws RouterException
     * @throws \ReflectionException
     */
  public function call(){
    if(!isset($this->callable)){
      throw new RouteException("No Action Set.");
    }
    if(!strpos($this->callable, "@")){ //a regex could be better @TODO
        throw new RouteException("Bad Syntax Action Set.");
    }
    $controllerName = '';
    $methodName = '';
    $actionSplit = explode("@", $this->callable);
    $controllerName = $actionSplit[0];
    $methodName = $actionSplit[1];
    try{
       $controller = new $controllerName();
       $reflectionMethod = new \ReflectionMethod($controllerName, $methodName);
       return $reflectionMethod->invoke($controller, ...array_merge($this->matches, $_POST));
    }
    catch(\ArgumentCountError $e){
      throw new RouterException("Inval argument count.");
    }
  }
}
