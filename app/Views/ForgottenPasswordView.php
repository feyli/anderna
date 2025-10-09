<?php

require_once __DIR__ . '/BaseView.php';

class ForgottenPasswordView extends BaseView
{
    public function render(): string
    {
        $head = $this->includeTemplate('head');
        $header = $this->includeTemplate('header');

        return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-forgot.css">
    {$head}
    <title>Mots de passe oubliés</title>
</head>
<body>
    {$header}
    <main>
        <div class="forgot-container">
            <h1 class="forgot-title">Mot de passe oublié</h1>

            <form method="POST" id="forgotForm">
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
                <div class="button-forgot">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <a type="button" class="btn btn-secondary" href="/login">Retour</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
HTML;
    }
}

