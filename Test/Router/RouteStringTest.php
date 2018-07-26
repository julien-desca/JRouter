<?php
namespace Test\Router;

use PHPUnit\Framework\TestCase;

require_once 'RouteString_ForTest.php';
require_once 'FakeController.php';
require_once'Router/RouterException.php';
use Test\Router\RouteString_ForTest as RouteString;

class RouteStringTest extends TestCase
{
    public function testCall(): void
    {
        $route = new RouteString('home/', "Test\Routeur\FakeController@index" );
        $this->AssertEquals(42,$route->call());
    }


    public function testCallWithParam():void
    {
        $route = new RouteString('home/:id', "Test\Routeur\FakeController@indexWithParam" );
        $route->setMatches([41]);
        $this->AssertEquals(42,$route->call());
    }


    public function testCallWithParams():void
    {
        $route = new RouteString('home/:id', "Test\Routeur\FakeController@indexWithParams" );
        $route->setMatches([10,32]);
        $this->AssertEquals(42,$route->call());
    }

        public function testCallWithToFewArgumentRaiseException():void
        {
            $route = new RouteString('home/:id', "Test\Routeur\FakeController@indexWithParams" );
            $route->setMatches([41]);
            $this->expectException(\Router\RouterException::class);
            $route->call();
        }
}
