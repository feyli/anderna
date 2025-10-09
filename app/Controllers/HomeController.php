<?php

require_once __DIR__ . '/../Views/HomeView.php';

class HomeController
{
    public function index(): void
    {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si l'utilisateur est connecté, rediriger vers le dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: /dash');
            exit;
        }

        // Sinon, afficher la page d'accueil
        $view = new HomeView();
        $view->display();
    }
}