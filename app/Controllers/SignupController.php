<?php

require_once dirname(__DIR__, 2) . '/modules/Database.php';
require_once dirname(__DIR__, 2) . '/modules/User.php';
require_once dirname(__DIR__, 2) . '/modules/UserManager.php';
require_once __DIR__ . '/../Views/SignupView.php';

class SignupController
{
    public function signup(): void
    {
        if (isset($_POST['submit'])) {
            // Create user object
            $user = new User([
                'first_name' => $_POST['nom'],
                'last_name' => $_POST['prenom'],
                'gender' => $_POST['genre'],
                'email' => $_POST['email'],
                'pwd' => $_POST['motdepasse']
            ]);

            // Initialize database and UserManager (same as login!)
            $database = new DataBase();
            $userManager = new UserManager($database);
            
            // Check if user already exists with this email
            if ($userManager->userExistsByEmail($user->email)) {
                echo "<script>alert('Un compte existe déjà avec cette adresse email.'); window.location.href='/signup';</script>";
                return;
            }

            // Call addUser method
            $result = $userManager->addUser($user);

            if ($result) {
                echo "<script>alert('Votre compte a été créé avec succès.'); window.location.href='/login';</script>";
            } else {
                echo "<script>alert('Une erreur est survenue lors de la création du compte.'); window.location.href='/signup';</script>";
            }
            return;
        }

        $view = new SignupView();
        $view->display();
    }
}