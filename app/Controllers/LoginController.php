<?php

require_once dirname(__DIR__, 2) . '/modules/Database.php';
require_once dirname(__DIR__, 2) . '/modules/UserManager.php';

class LoginController
{
    public function login(): void
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $database = new DataBase();
            $userManager = new UserManager($database);
            $result = $userManager->login($email, $password);
        }


        require __DIR__ . '/../Views/login.php';
    }
}