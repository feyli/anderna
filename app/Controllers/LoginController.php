<?php

require_once dirname(__DIR__, 2) . '/modules/Database.php';
require_once dirname(__DIR__, 2) . '/modules/UserManager.php';

class LoginController
{
    public function login(): void
    {
        // Check if user is logged in
        session_start();
        if (isset($_SESSION['user_id'])) {
            header('Location: /dash');
            exit;
        }

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $database = new DataBase();
            $userManager = new UserManager($database);
            $result = $userManager->login($email, $password);

            if ($result) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_email'] = $result['email'];
                $_SESSION['user_name'] = $result['first_name'] . ' ' . $result['last_name'];
                header('Location: /dash');
                exit;
            }
        }


        require __DIR__ . '/../Views/login.php';
    }
}