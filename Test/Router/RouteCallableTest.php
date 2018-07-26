<?php
namespace Test\Router;

use PHPUnit\Framework\TestCase;

require_once 'Router/Route.php';
require_once 'Router/RouteCallable.php';
use Router\RouteCallable;

class RouteCallableTest extends TestCase
{
    public function testCall(): void
    {
      $route = new RouteCallable('home/', function(){return true;} );
      $this->assertTrue($route->call());
    }
}
