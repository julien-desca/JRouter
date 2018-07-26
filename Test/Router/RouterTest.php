<?php
namespace Test\Router;

use PHPUnit\Framework\TestCase;

require_once 'RouterForTest.php';
use Test\Router\RouterForTest as Router;

require_once 'Router/Route.php';
use Router\Route;

require_once 'Router/RouterException.php';
use Router\RouterException;

class RouterTest extends TestCase
{
    public function testGet(): void
    {
      $router = new Router("/foo/foufou");
      $router->get('', function(){return 'foo';});
      $this->assertNotEmpty($router->getRoutes()['GET']);
    }

    public function testGetManyRoutes():void
    {
        $router = new Router("/foo/foufou");
        $router->get('', function(){return 'foo';});
        $router->get('live/test/', function(){return null;});
        $this->assertEquals(count($router->getRoutes()["GET"]), 2);
    }

    public function testRun():void
    {
      //mock route object
      $route = $this->createMock(Route::class);
      $route->method('match')->willReturn('true');
      $route->method('call')->willReturn(75);
      $router = new Router("foo/foo");
      $router->setRoutes(["GET" => [$route]]);
      $_SERVER['REQUEST_METHOD'] = "GET";
      $this->assertEquals(75, $router->run());
    }

    public function testRunNoMatchingRouteRaiseException():void
    {
      //mock route object
      $route = $this->createMock(Route::class);
      $route->method('match')->willReturn(false);
      $router = new Router("foo/foo");
      $router->setRoutes(["GET" => [$route]]);
      $_SERVER['REQUEST_METHOD'] = "GET";
      $this->expectException(RouterException::class);
      $router->run();
    }

    public function testRunInvalidMethodRaiseException():void
    {
      $router = new Router("Route/to/nowhere");
      $router->setRoutes(["GET" => []]);
      $_SERVER['REQUEST_METHOD'] = "POST";
      $this->expectException(RouterException::class);;
      $router->run();
    }
}
