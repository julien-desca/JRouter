<?php
namespace Test\Router;

use JDesca\Router\Route;

class RouteForTest extends Route {

  public function getMatches():array{
    return $this->matches;
  }
}
