<?php
namespace Test\Router;

require_once('Router/RouteString.php');

class RouteString_ForTest extends \Router\RouteString{

  public function getMatches():array{
    return $this->matches;
  }
  public function setMatches(array $matches):void{
     $this->matches = $matches;
  }
}
