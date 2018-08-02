<?php

namespace JDesca\Router;
use JDesca\Router\Exception\BadCallException;

/**
 * Route which call a controller action
 * Class RouteString
 * @package Router
 */
class RouteString extends Route{

    /**
     * call the catio n
     * @return mixed|void
     * @throws BadCallException
     */
  public function call(){
    if(!isset($this->callable)){
      throw new BadCallException("No Action Set.");
    }
    if(!strpos($this->callable, "@")){ //a regex could be better @TODO
        throw new BadCallException("Bad Syntax Action Set.");
    }
    $controllerName = '';
    $methodName = '';
    $actionSplit = explode("@", $this->callable);
    $controllerName = $actionSplit[0];
    $methodName = $actionSplit[1];
    try{
       $controller = new $controllerName();
       $reflectionMethod = new \ReflectionMethod($controllerName, $methodName);
       return $reflectionMethod->invoke($controller, ...$this->matches);
    }
    catch(\ArgumentCountError $e){
      throw new BadCallException("Inval argument count.");
    }
    catch (\ReflectionException $e){
        throw new BadCallException("Reflection Exception");
    }
  }
}
