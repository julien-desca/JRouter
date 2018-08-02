<?php

namespace Test\Router;

use JDesca\Router\RouteCallable;

class RouteCallable_ForTest extends RouteCallable {

  public function getMatches():array{
    return $this->matches;
  }
  public function setMatches(array $matches):void{
     $this->matches = $matches;
  }
}
