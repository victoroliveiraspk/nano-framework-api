<?php

define('APP_ROOT', dirname(__DIR__));

include_once './autoload.php';

use core\Router;
use core\Methods;

$router = new Router();
$router->on(Methods::GET, '/test', function($params) {
    print_r($params);
});

$router->run();
