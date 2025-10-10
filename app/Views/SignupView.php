<?php

require_once __DIR__ . '/BaseView.php';

class SignupView extends BaseView
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
    <link rel="stylesheet" href="/_assets/includes/styles/styles-register.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-footer.css">
    {$head}
    <title>S'inscrire</title>
</head>
<body>
    {$header}
    <main>
        <div class="signup-container">
            <h1 class="signup-title">S'inscrire</h1>

            <form method="POST" id="signupForm">
                <div class="form-group">
                    <label for="nom" class="form-label">Nom<span class="required">*</span></label>
                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        class="form-input"
                        placeholder="Tapez votre nom ici..."
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="prenom" class="form-label">Prénom<span class="required">*</span></label>
                    <input
                        type="text"
                        id="prenom"
                        name="prenom"
                        class="form-input"
                        placeholder="Tapez votre prénom ici..."
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">Genre*</label>
                    <div class="gender-group">
                        <div class="gender-option">
                            <input type="radio" id="femme" name="genre" value="F" required>
                            <label for="femme">F</label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" id="homme" name="genre" value="M" required>
                            <label for="homme">M</label>
                        </div>
                        <div class="gender-option">
                            <input type="radio" id="autre" name="genre" value="X" required>
                            <label for="autre">Autre</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">E-mail<span class="required">*</span></label>
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
                    <label for="motdepasse" class="form-label">Mot de passe<span class="required">*</span></label>
                    <input
                        type="password"
                        id="motdepasse"
                        name="motdepasse"
                        class="form-input"
                        placeholder="Tapez votre mot de passe ici..."
                        required
                        minlength="6"
                    >
                </div>

                <div class="button-group">
                    <button type="submit" name="submit" class="btn btn-primary">S'inscrire</button>
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

