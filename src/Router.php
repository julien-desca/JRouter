<?php

namespace JDesca\Router;
use JDesca\Router\Exception\MethodNotAllowedException;
use JDesca\Router\Exception\RouterException;
use JDesca\Router\Exception\RouteNotFoundException;

/**
 * call the right action for requested url
 * Class Router
 * @package Router
 */
class Router
{
    /**
     * requested url
     * @var string
     */
    private $url;

    /**
     * Registered Routes
     * @var array
     */
    protected $routes = [];

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Register a new route with GET method
     * @param string $path path of the route
     * @param callable|string $callable callable to call when route match or controller class "/Full/Name/Controller@actionMethod"
     * @return Route created Route
     * @throws RouterException
     */
    public function get(string $path, $callable): Route
    {
        $route = $this->createRoute($path, $callable);
        $this->routes["GET"][] = $route;
        return $route;
    }

    /**
     * Register a new route with POST method
     * @param string $path path of the route
     * @param callable|string $callable callable to call when route match or controller class "/Full/Name/Controller@actionMethod"
     * @return Route created Route
     * @throws RouterException
     */
    public function post(string $path, $callable){
        $route = $this->createRoute($path, $callable);
        $this->routes["POST"][] = $route;
        return $route;
    }

    /**
     * Register a new route with PUT method
     * @param string $path
     * @param $callable
     * @return Route
     * @throws RouterException
     */
    public function put(string $path, $callable){
        $route = $this->createRoute($path, $callable);
        $this->routes["PUT"][] = $route;
        return $route;
    }

    /**
     * Register a new route with DELETE method
     * @param string $path
     * @param $callable
     * @return Route
     * @throws RouterException
     */
    public function delete(string $path, $callable){
        $route = $this->createRoute($path, $callable);
        $this->routes["DELETE"][] = $route;
        return $route;
    }

    /**
     * Instantiate Route
     * @param string $path
     * @param $callable
     * @return Route
     * @throws RouterException
     */
    private function createRoute(string $path, $callable):Route{
        $route = null;
        if (is_callable($callable)) {
            $route = new RouteCallable($path, $callable);
        } else if (gettype($callable) === 'string') {
            $route = new RouteString($path, $callable);
        }
        else{
            throw new RouterException("bad callable type!");
        }
        return $route;
    }


    /**
     * Run the application
     * @return mixed
     * @throws MethodNotAllowedException
     * @throws RouteNotFoundException
     */
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if (!isset($this->routes[$method])) {
            throw new MethodNotAllowedException('METHOD : ' . $method . ' is not allowed');
        }
        foreach ($this->routes[$method] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new RouteNotFoundException('No matching routes');
    }

}
