<?php

require_once __DIR__ . '/../app/Router.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_URI']);
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
