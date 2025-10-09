<?php

require_once __DIR__ . '/BaseView.php';

class LegalNoticeView extends BaseView
{
    public function render(): string
    {
        $head = $this->includeTemplate('head');
        $header = $this->includeTemplate('header');
        $footer = $this->includeTemplate('footer');

        $currentDate = date("d/m/Y");

        return <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="description" content="Mentions légales de l'application DashMed">
    <title>Mentions légales - DashMed</title>
    <link rel="stylesheet" href="/_assets/includes/styles/styles-footer.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-legal-notice.css">
    {$head}
</head>
<body>
{$header}
<div class="legal-scroll-container">
    <div class="legal-container">
        <h1>Mentions légales</h1>
        <h2>1. Présentation du site</h2>
        <p>Conformément aux dispositions des articles 6-III et 19 de la Loi n° 2004-575 du 21 juin 2004 pour la Confiance dans l'économie numérique, nous portons à la connaissance des utilisateurs du site les informations suivantes :</p>
        <p><strong>Nom officiel :</strong> DashMed</p>
        <p><strong>URL du site :</strong> <a href="https://dashmed.feyli.dev/" target="_blank">https://dashmed.feyli.dev/</a></p>

        <h2>2. Projet académique</h2>
        <p>Ce site web est développé dans le cadre d'un projet académique.</p>
        <p><strong>Établissement :</strong> AMU, IUT d'Aix-en-Provence, département informatique</p>
        <p><strong>Adresse :</strong> 413 Avenue Gaston Berger, 13100 Aix-en-Provence</p>

        <h2>3. Objectif du site</h2>
        <p>DashMed est une plateforme conçue pour permettre aux médecins de suivre leurs patients plus facilement.</p>

        <h2>4. Hébergement</h2>
        <p>Le site et la base de données sont hébergés sur un serveur privé (VPS) géré par un membre du groupe de projet.</p>
        <p>Aucune donnée sensible ou réelle de patients n'est utilisée dans ce projet académique.</p>

        <h2>5. Technologies utilisées</h2>
        <p>Le site est développé avec les technologies suivantes :</p>
        <ul>
            <li>PHP</li>
            <li>MySQL (administré via phpMyAdmin)</li>
        </ul>

        <h2>6. Cookies et données personnelles</h2>
        <p>Ce site n'utilise pas de cookies pour le suivi publicitaire.</p>
        <p>Dans le cadre de ce projet académique, aucune donnée personnelle réelle n'est collectée ou stockée.</p>

        <h2>7. Propriété intellectuelle</h2>
        <p>L'ensemble du contenu de ce site constitue une œuvre protégée par les lois en vigueur sur la propriété intellectuelle. Aucune reproduction ou représentation ne peut être réalisée en contravention avec les droits du site.</p>

        <h2>8. Contact</h2>
        <p>Pour toute question relative à ce projet académique, veuillez contacter le département informatique de l'IUT d'Aix-en-Provence.</p>

        <p style="margin-top: 40px; text-align: center; font-style: italic;">Dernière mise à jour : {$currentDate}</p>
    </div>
</div>
{$footer}
</body>
</html>
HTML;
    }
}

