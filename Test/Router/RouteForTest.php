<?php
namespace Test\Router;

require_once('Router/Route.php');

class RouteForTest extends \Router\Route{

  public function getMatches():array{
    return $this->matches;
  }
}
