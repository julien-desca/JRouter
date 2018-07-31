<?php
namespace Test\Router;

use PHPUnit\Framework\TestCase;

require_once 'RouterForTest.php';
require_once 'Router/Route.php';
use Router\Route;
require_once 'Router/RouteCallable.php';

require_once 'Router/Exception/RouterException.php';
require_once 'Router/Exception/MethodNotAllowedException.php';
use Router\Exception\MethodNotAllowedException;

require_once 'Router/Exception/RouteNotFoundException.php';
use Router\Exception\RouteNotFoundException;

use Test\Router\RouterForTest as Router;



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

    public function testPost():void{
        $router = new Router("/foo/foufou");
        $router->post('', function(){return 'foo';});
        $router->post('live/test/', function(){return null;});
        $this->assertEquals(count($router->getRoutes()["POST"]), 2);
    }

    public function testPut():void{
        $router = new Router("/foo/foufou");
        $router->put('', function(){return 'foo';});
        $router->put('live/test/', function(){return null;});
        $this->assertEquals(count($router->getRoutes()["PUT"]), 2);
    }

    public function testDelete():void{
        $router = new Router("/foo/foufou");
        $router->delete('', function(){return 'foo';});
        $router->delete('live/test/', function(){return null;});
        $this->assertEquals(count($router->getRoutes()["DELETE"]), 2);
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
      $this->expectException(RouteNotFoundException::class);
      $router->run();
    }

    public function testRunInvalidMethodRaiseException():void
    {
      $router = new Router("Route/to/nowhere");
      $router->setRoutes(["GET" => []]);
      $_SERVER['REQUEST_METHOD'] = "POST";
      $this->expectException(MethodNotAllowedException::class);
      $router->run();
    }
}
