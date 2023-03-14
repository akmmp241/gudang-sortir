<?php

namespace Akmalmp\GudangSortir\App;

use Akmalmp\GudangSortir\Controller\ErrorDocumentController;

class Router
{
    public static array $routes = [];

    public static function add(
        string $method,
        string $path,
        string $controller,
        string $function,
        array $middleware = []
    ): void
    {
        self::$routes[] = [
            'method' => $method,
            'path' => $path,
            'controller' => $controller,
            'function' => $function,
            'middleware' => $middleware
        ];
    }

    public static function run(): void
    {
//        SET PATH
        // default path
        $path = "/";
        // path from url
        if (isset($_SERVER['PATH_INFO'])) {
            $path = $_SERVER['PATH_INFO'];
        }

//        REQUEST METHOD GET | POST
        $method = $_SERVER['REQUEST_METHOD'];

        foreach (self::$routes as $route) {
            $pattern = "#^" . $route['path'] . "$#";
            if (preg_match($pattern, $path, $variables) && $method == $route['method']) {
                $controller = new $route['controller']();
                $function = $route['function'];

//                Call Middleware
                foreach ($route['middleware'] as $middleware) {
                    $instance = new $middleware;
                    $instance->before();
                }

                array_shift($variables);
                call_user_func_array([$controller, $function], $variables);

                return;
            }
        }

        http_response_code(404);
        call_user_func([ErrorDocumentController::class, 'notFound']);
    }
}