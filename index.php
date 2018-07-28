<?php

/** AUTOLOAD */
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

var_dump($_GET['url']);
var_dump($_POST);
$routeur = new Router\Router($_GET['url']);
//TODO declare route here
$routeur->get('/', "Router\TestController@test");
$routeur->get('string', "Router\TestController@test");
$routeur->get('string/:id', "Router\TestController@test2");
$routeur->get('hero/:id', function($id){echo $id;});
$routeur->run();
