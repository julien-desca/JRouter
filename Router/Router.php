<?php
namespace Router;

class Router {

  private $url;

  private $route = [];

  public function __construct($url){
    $this->url = $url;
  }

  public function get($path, $callable){
    $route = new Route($path, $callable);
    $this->routes["GET"][] = $route;
    return $route; // On retourne la route pour "enchainer" les méthodes
  }

  public function run(){
    if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
    {
      throw new RouterException("INVALID METHOD");
    }
    foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
      if($route->match($this->url)){
        return $route->call();
      }
    }
     throw new RouterException('No matching routes');
  }
}
