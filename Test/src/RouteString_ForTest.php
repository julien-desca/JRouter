<?php
namespace Test\Router;

use JDesca\Router\RouteString;

class RouteString_ForTest extends RouteString {

  public function getMatches():array{
    return $this->matches;
  }
  public function setMatches(array $matches):void{
     $this->matches = $matches;
  }
}
