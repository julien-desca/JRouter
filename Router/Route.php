<?php
namespace Router;

abstract class Route{

  protected $path;

  protected $callable;

  protected $matches = []; //var protected for unit testing

  public function __construct(string $path, $callable)
  {
    $this->path = trim($path, '/');
    $this->callable = $callable;
  }

  /**
  * Permettra de capturer l'url avec les paramètre
  * get('/posts/:slug-:id') par exemple
  **/
  public function match($url){
      $url = trim($url, '/');
      $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
      $regex = "#^$path$#";
      if(!preg_match($regex, $url, $matches)){
          return false;
      }
      array_shift($matches);
      $this->matches = $matches;  // On sauvegarde les paramètre dans l'instance pour plus tard
      return true;
  }

  public function call()
  {
    //to override
    throw new \Exception('You cannot call this method. you have to override it');
  }

}
