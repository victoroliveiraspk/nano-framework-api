<?php

define('APP_ROOT', dirname(__DIR__));

include_once './autoload.php';

$url = explode('?', $_SERVER['REQUEST_URI']);
print_r($url[0]);

use core\Router;
use core\Methods;

$router = new Router();
$router->on(Methods::GET, '/test', function() {
    echo 'hsuahus';
});

$router->run();
