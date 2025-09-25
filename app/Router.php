<?php

class Router
{
    private $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function dispatch($uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if ($path !== '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }

        if (isset($this->routes[$path])) {
            $route = $this->routes[$path];
            $controllerName = $route['controller'];
            $action = $route['action'];

            $controllerFile = __DIR__ . "/Controllers/$controllerName.php";
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                if (class_exists($controllerName)) {
                    $controller = new $controllerName();
                    if (method_exists($controller, $action)) {
                        $controller->$action();
                        return;
                    } else {
                        $this->error500("Method $action not found in $controllerName");
                        return;
                    }
                } else {
                    $this->error500("Class $controllerName not found");
                    return;
                }
            } else {
                $this->error500("Controller file $controllerName.php not found");
                return;
            }
        }
        $this->error404();
    }

    private function error404()
    {
        http_response_code(404);
        echo "Not Found";
    }

    private function error500($message = "Internal Server Error")
    {
        http_response_code(500);
        echo "$message";
    }
}
