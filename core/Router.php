<?php

namespace core;

class Router {
    private $routes = [];

    public function on($method, $path, $callback) {
        if (!$method)
            throw new Exception('Invalid method.');
        if (!$path)
            throw new Exception('Invalid path.');
        if (!$callback)
            throw new Exception('Invalid callback.');

        $method = $this->formatMethod($method);
        $path = $this->formatPath($path);
        $this->routes[$method][$path] = $callback;
    }

    public function run() {
        $method = $this->formatMethod(strtoupper($_SERVER['REQUEST_METHOD']));
        $path = $this->formatPath($_SERVER['REQUEST_URI']);
        $callback = $this->routes[$method][$path];
        if ($callback)
            call_user_func($callback);
    }

    private function formatMethod($method) {
        return strtoupper($method);
    }

    private function formatPath($path) {
        return substr($path, 0, 1) === '/' ? substr($path, 1) : $path;
    }
}
