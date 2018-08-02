<?php
namespace Test\Router;

use JDesca\Router\Exception\BadCallException;
use PHPUnit\Framework\TestCase;

use Test\Router\RouteString_ForTest as RouteString;

class RouteStringTest extends TestCase
{
    public function testCall(): void
    {
        $route = new RouteString('home/', "Test\Router\FakeController@index" );
        $this->AssertEquals(42,$route->call());
    }


    public function testCallWithParam():void
    {
        $route = new RouteString('home/:id', "Test\Router\FakeController@indexWithParam" );
        $route->setMatches([41]);
        $this->AssertEquals(42,$route->call());
    }


    public function testCallWithParams():void
    {
        $route = new RouteString('home/:id', "Test\Router\FakeController@indexWithParams" );
        $route->setMatches([10,32]);
        $this->AssertEquals(42,$route->call());
    }

        public function testCallWithToFewArgumentRaiseException():void
        {
            $route = new RouteString('home/:id', "Test\Router\FakeController@indexWithParams" );
            $route->setMatches([41]);
            $this->expectException(BadCallException::class);
            $route->call();
        }
}
