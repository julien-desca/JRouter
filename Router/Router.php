<?php
namespace Router;

class Router {

  private $url;

  protected $routes = [];

  public function __construct(string $url){
    $this->url = $url;
  }

  public function get(string $path, $callable):Route{
    if(is_callable($callable))
    {
      $route = new RouteCallable($path, $callable);
    }
    $this->routes["GET"][] = $route;
    return $route;
  }

  public function run(){
    $method = $_SERVER['REQUEST_METHOD'];
    if(!isset($this->routes[$method]))
    {
      throw new RouterException("invalid method");
    }
    foreach($this->routes[$method] as $route){
      if($route->match($this->url)){
        return $route->call();
      }
    }
     throw new RouterException('No matching routes');
  }

}
