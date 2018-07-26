<?php
namespace Router;

abstract class Route{

  public $path;
  public $callable;
  protected $matches = []; //var protected for unit testing

  public function __construct(string $path, $callable)
  {
    $this->path = $path;
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

/*
//TODO
Les expressions régulières ne sont pas Tip top, pour un / ses logiquement /, et idem pour le regex de path /^posts/([^/])$/ on obtient une erreur et il faut donc ajouter à notre regex un \ pour être dans les normes de regex.

Pour les personnes intéressées régler ce petit souci et très simple.

Dans la fonction match(); de Route.php, il vous faut mettre après les premières variables qui sont : $url = trim($url, '/'); $path = preg_replace_callback('/:([\w]+)/', [$this, 'paramMatch'], $this->path);

Ajouté en dessous : $path = str_replace('/', '/', $path);

Voilà
 */
