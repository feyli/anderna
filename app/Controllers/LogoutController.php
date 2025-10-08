<?php

use JetBrains\PhpStorm\NoReturn;

class LogoutController
{
    #[NoReturn]
    public function logout(): void
    {
        // Destroy the session (creating one if it exists)
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (session_status() === PHP_SESSION_ACTIVE) session_destroy();

        // Redirect to home page
        header('Location: /');
        exit;
    }
}
