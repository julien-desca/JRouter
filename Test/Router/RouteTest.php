<?php
namespace Test\Routeur;

use PHPUnit\Framework\TestCase;

require_once('Router/Route.php');
use Router\Route;

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

    public function testMatchWithParam():void
    {
            $route = new Route('id/:id', null);
            $this->assertTrue($route->match('/id/12'));
    }

    public function testMatchWithTSeveralParams():void
    {
              $route = new Route('id/:id/:foo', null);
              $this->assertTrue($route->match('/id/12/machin'));
    }
}
