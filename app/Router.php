<?php

class Router
{
    private array $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function dispatch($uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if ($path !== '/' && str_ends_with($path, '/')) {
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
                    } else {
                        $this->error500("Method $action not found in $controllerName");
                    }
                } else {
                    $this->error500("Class $controllerName not found");
                }
            } else {
                $this->error500("Controller file $controllerName.php not found");
            }
            return;
        }
        $this->error404();
    }

    private function error404(): void
    {
        http_response_code(404);
        echo "Not Found";
    }

    private function error500($message = "Internal Server Error"): void
    {
        http_response_code(500);
        echo "$message";
    }
}
