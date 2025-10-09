<?php

return [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/login' => ['controller' => 'LoginController', 'action' => 'login'],
    '/signup' => ['controller' => 'SignupController', 'action' => 'signup'],
    '/logout' => ['controller' => 'LogoutController', 'action' => 'logout'],
    '/dash' => ['controller' => 'DashController', 'action' => 'dash']
    '/forgot' => ['controller' => 'forgottenPasswordController', 'action' => 'forgot'],
    '/reset' => ['controller' => 'resetPasswordController', 'action' => 'reset'],
    '/legal-notice' => ['controller' => 'LegalNoticeController', 'action' => 'legalnotice']
];
