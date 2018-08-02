### 1. Installation

 - with Composer :
 
 
 ```
 composer require julien-desca/router dev-master
```


### 2. Use

- Modify your .htacces like this :

```
RewriteEngine on

RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$  /index.php?url=$1 [QSA,L]
```

- in index.php :

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$router = new \JDesca\Router\Router($_GET['url']);

//register your routes

try {
    //you can pass a string like Controller@action
    $router->get('your/path', 'Full\Name\To\Controller@actionMethod');
    $router->get('your/path/function', function () {  //:foo for parameters
        echo "foo !!!";
    });
    //eventually with parameters
    $router->get('your/path/:id', function ($id) {  //:foo for parameters
        echo ":id paramater is equal to : $id";
    });
    //you can work with GET POST PUT and DELETE methods
    $router->post('your/path', 'Full\Name\To\Controller@otherActionMethod');
    $router->put('your/path', 'Full\Name\To\Controller@putActionMethod');
    $router->delete('your/path', 'Full\Name\To\Controller@deleteActionMethod');
    $router->get('', 'TestController@testGet');
    $router->get('/:id', 'TestController@testGetWithParam');

    /**
     * then juste run the app
     */
    $router->run();
} catch (\JDesca\Router\Exception\MethodNotAllowedException $e) {
} catch (\JDesca\Router\Exception\RouteNotFoundException $e) {
} catch (\JDesca\Router\Exception\RouterException $e) {
} catch (\Exception $e){
}
//or you can also pass a callable

class TestController{
    public function testGetWithParam($id){
        echo "you param is : $id";
    }

    public function testGet(){
        echo "Get Works!";
    }
}
```

