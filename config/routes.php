<?php

return [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/login' => ['controller' => 'LoginController', 'action' => 'login'],
    '/signup' => ['controller' => 'SignupController', 'action' => 'signup'],
    '/logout' => ['controller' => 'LogoutController', 'action' => 'logout'],
    '/forgot' => ['controller' => 'forgottenPasswordController', 'action' => 'forgot'],
    '/reset' => ['controller' => 'resetPasswordController', 'action' => 'reset']
];
