<?php

require_once __DIR__ . '/BaseView.php';

class LoginView extends BaseView
{
    public function render(): string
    {
        $head = $this->includeTemplate('head');
        $header = $this->includeTemplate('header');
        $footer = $this->includeTemplate('footer');

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Page d'inscription à l'application DashMed">
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-login.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-footer.css">
    {$head}
    <title>Se connecter</title>
</head>
<body>
    {$header}
    <main>
        <div class="login-container">
            <h1 class="login-title">Se connecter</h1>

            <form method="POST" id="loginForm">
                <div class="form-group">
                    <label for="email" class="form-label">E-mail :</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="Tapez votre e-mail ici..."
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe :</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input"
                        placeholder="Tapez votre mot de passe ici..."
                        required
                    >
                </div>

                <div class="forgot-password">
                    <a href="/forgot">Mot de passe oublié ?</a>
                </div>

                <div class="button-group">
                    <button type="submit" name="submit" class="btn btn-primary">Connexion</button>
                    <a type="button" class="btn btn-secondary" href="/">Retour</a>
                </div>
            </form>

        </div>
    </main>
    {$footer}
</body>
</html>
HTML;
    }
}

