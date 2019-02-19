<?php

namespace core;

use core\Methods;

class Router {
    private $routes = [];

    public function on($method, $path, $callback) {
        if (!$method)
            throw new Exception('Invalid method.');
        if (!$path)
            throw new Exception('Invalid path.');
        if (!is_callable($callback))
            throw new Exception('Invalid callback.');

        $method = $this->formatMethod($method);
        $path = $this->formatPath($path);
        $this->routes[$method][$path] = $callback;
    }

    public function run() {
        $method = $this->formatMethod($_SERVER['REQUEST_METHOD']);
        $path = $this->formatPath($this->extractPath());
        $callback = $this->routes[$method][$path];
        if (is_callable($callback))
            call_user_func($callback, $this->getParams($method));
    }

    private function formatMethod($method) {
        return strtoupper($method);
    }

    private function extractPath() {
        return explode('?', $_SERVER['REQUEST_URI'])[0];
    }

    private function formatPath($path) {
        $path = substr($path, 0, 1) !== '/' ? '/'.$path : $path;
        return substr($path, strlen($path) - 1) !== '/' ? $path.'/' : $path; 
    }

    private function getParams($method) {
        return $method == Methods::GET ? $_GET : $_POST;
    }
}
