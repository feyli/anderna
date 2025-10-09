<?php

require_once __DIR__ . '/BaseView.php';

class HomeView extends BaseView
{
    public function render(): string
    {
        $head = $this->includeTemplate('head');
        $header = $this->includeTemplate('header');
        $footer = $this->includeTemplate('footer');

        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="description" content="Page d'accueil de l'application DashMed">
    <title>DashMed</title>
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-footer.css">
    {$head}
</head>
<body>
    {$header}
    <main>
        <div class="container">
            <h1 class="name">DashMed</h1>
            <div class="buttons">
                <a class="btn1" href="/login">Se connecter</a>
                <a class="btn2" href="/signup">S'inscrire</a>
            </div>
        </div>
    </main>
    {$footer}
</body>
</html>
HTML;
    }
}

