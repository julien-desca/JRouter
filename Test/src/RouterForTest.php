<?php
namespace Test\Router;

use JDesca\Router\Router;

class RouterForTest extends Router {

  public function getRoutes():array {
    return $this->routes;
  }

  public function setRoutes(array $routes):void {
    $this->routes = $routes;
  }
}
