<?php

/** AUTOLOAD */
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

var_dump($_GET['url']);
var_dump($_POST);
$routeur = new Router\Router($_GET['url']);
//TODO declare route here
$routeur->get('hero/:id', function($id){echo $id;});
$routeur->get('/post/', function (){var_dump($_POST);});
$routeur->run();
