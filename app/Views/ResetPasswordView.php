<?php

require_once __DIR__ . '/BaseView.php';

class ResetPasswordView extends BaseView
{
    public function render(): string
    {
        $head = $this->includeTemplate('head');
        $header = $this->includeTemplate('header');

        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-reset.css">
    {$head}
    <title>Réinitialiser le mot de passe</title>
</head>
<body>
{$header}
<main>
    <div class="reset-container">
        <h1 class="reset-title">Réinitialiser le mot de passe</h1>

        <form method="POST" id="resetForm">
            <div class="form-group">
                <label for="password" class="form-label">Nouveau mot de passe :</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input"
                    placeholder="Tapez votre nouveau mot de passe ici..."
                    required
                >
            </div>

            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirmation du mot de passe :</label>
                <input
                    type="password"
                    id="confirm_password"
                    name="confirm_password"
                    class="form-input"
                    placeholder="Confirmez votre nouveau mot de passe ici..."
                    required
                >
            </div>

            <div class="button-forgot">
                <button type="submit" class="btn btn-primary">Confirmer</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>
HTML;
    }
}

