<?php

return [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/login' => ['controller' => 'LoginController', 'action' => 'login'],
    '/signup' => ['controller' => 'SignupController', 'action' => 'signup'],
    '/logout' => ['controller' => 'LogoutController', 'action' => 'logout'],
    '/forgot' => ['controller' => 'ForgottenPasswordController', 'action' => 'forgot'],
    '/reset' => ['controller' => 'ResetPasswordController', 'action' => 'reset'],
    '/legal-notice' => ['controller' => 'LegalNoticeController', 'action' => 'legalnotice'],
    '/dash' => ['controller' => 'DashController', 'action' => 'dash']
];
