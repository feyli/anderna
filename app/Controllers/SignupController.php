<?php

require_once dirname(__DIR__, 2) . '/modules/Database.php';
require_once dirname(__DIR__, 2) . '/modules/UserManager.php';

class SignupController
{
    public function signup(): void
    {
        if (isset($_POST['submit'])) {
            // Create user object
            $user = new stdClass();
            $user->first_name = $_POST['nom'];
            $user->last_name = $_POST['prenom'];
            $user->gender = $_POST['genre'];
            $user->email = $_POST['email'];
            $user->pwd = $_POST['motdepasse'];
            
            // Initialize database and UserManager (same as login!)
            $database = new DataBase();
            $userManager = new UserManager($database);
            
            // Call addUser method
            $result = $userManager->addUser($user);
        }

        require __DIR__ . '/../Views/signup.php';
    }
}