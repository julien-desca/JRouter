<?php

namespace Router;

use Router\Exception\RouterException;

/**
 * Base class for route. A route can be create to call a callable or to call an action method of a controller
 * Class Route
 * @package Router
 */
abstract class Route
{

    /**
     * Path of the route
     * @var string
     */
    protected $path;

    /**
     * action to call
     * @var callable|string
     */
    protected $callable;

    /**
     * param of the request
     * @var array
     */
    protected $matches = []; //var protected for unit testing

    /**
     * Route constructor.
     * @param string $path Path of the route
     * @param callable|string $callable  action to call
     */
    public function __construct(string $path, $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    /**
     * look if $url matches to route
     * @param $url
     * @return bool
     */
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;  // On sauvegarde les paramètre dans l'instance pour plus tard
        $post = json_decode(file_get_contents('php://input'), true);
        if(!empty($post)){
            $this->matches[] = $post;
        }
        return true;
    }

    /**
     * call the route action
     * @throws \Exception
     */
    public function call()
    {
        //to override
        throw new RouterException('You cannot call this method. you have to override it');
    }

}
