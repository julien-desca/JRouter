<?php

/** AUTOLOAD */
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$routeur = new Router\Router($_GET['url']);
//TODO declare route here
$routeur->get('', function(){echo "welcome to my page";});
$routeur->run();
