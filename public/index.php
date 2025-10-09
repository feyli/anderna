<?php

require_once __DIR__ . '/../app/Router.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_URI']);
