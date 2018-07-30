<?php

namespace Router;

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
     * @return Route
     */
    public function get(string $path, $callable): Route
    {
        if (is_callable($callable)) {
            $route = new RouteCallable($path, $callable);
        } else if (gettype($callable) === 'string') {
            $route = new RouteString($path, $callable);
        }
        $this->routes["GET"][] = $route;
        return $route;
    }


    /**
     * Run the application
     * @return mixed
     * @throws RouterException
     */
    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if (!isset($this->routes[$method])) {
            throw new RouterException("invalid method");
        }
        foreach ($this->routes[$method] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new RouterException('No matching routes');
    }

}
