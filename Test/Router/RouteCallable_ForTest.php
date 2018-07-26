<?php
namespace Test\Router;

require_once('Router/RouteCallable.php');

class RouteCallable_ForTest extends \Router\RouteCallable{

  public function getMatches():array{
    return $this->matches;
  }
  public function setMatches(array $matches):void{
     $this->matches = $matches;
  }
}
