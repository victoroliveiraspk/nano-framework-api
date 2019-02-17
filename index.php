<?php

define('APP_ROOT', dirname(__DIR__));

include_once './autoload.php';

use core\Router;
use core\Methods;
use core\View;

$router = new Router();
$router->on(Methods::GET, '/test', function() {
    echo 'hsuahus';
});

$router->run();