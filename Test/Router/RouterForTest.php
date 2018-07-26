<?php
namespace Test\Router;

require_once('Router/Router.php');

class RouterForTest extends \Router\Router{

  public function getRoutes():array {
    return $this->routes;
  }

  public function setRoutes(array $routes):void {
    $this->routes = $routes;
  }
}
