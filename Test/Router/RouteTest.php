<?php
namespace Test\Router;

use PHPUnit\Framework\TestCase;

require_once 'RouteForTest.php';
use Test\Router\RouteForTest as Route;

class RouteTest extends TestCase
{
    public function testMatchOk(): void
    {
        $route = new Route('home', null);
        $this->assertTrue($route->match('/home'));
    }

    public function testMatchOkLongerUrl():void
    {
          $route = new Route('home/sweet/home/to/you', null);
            $this->assertTrue($route->match('/home/sweet/home/to/you'));
    }

    public function testMatchOkWithPathStartingWithSeparator():void
    {
          $route = new Route('/home', null);
          $this->assertTrue($route->match('/home'));
    }

    public function testMatchNoMatchingUrl():void
    {
          $route = new Route('home', null);
          $this->assertFalse($route->match('/foo'));
    }

    public function testMatchOkWithParam():void
    {
            $route = new Route('id/:id', null);
            $this->assertTrue($route->match('/id/12'));
    }

    public function testMatchOkWithTSeveralParams():void
    {
              $route = new Route('id/:id/:foo', null);
              $this->assertTrue($route->match('/id/12/machin'));
    }

    public function testMatchRecordMatches():void
    {
              $route = new Route('id/:id/:slug', null);
              $route->match('/id/12/foo');
              $this->assertEquals($route->getMatches()[0], 12 );
              $this->assertEquals($route->getMatches()[1], 'foo' );
    }
}
