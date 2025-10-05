<?php

require_once __DIR__ . '/../app/Router.php';
$routes = require_once __DIR__ . '/../config/routes.php';

$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_URI']);
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<!-- Meta Tags for SEO and Social Media -->
<meta property="og:title" content="DashMed - Votre tableau de bord médical par excellence">
<meta property="og:description" content="Gérez vos informations médicales en toute simplicité avec
    DashMed.">
<meta property="og:url" content="https://dashmed.feyli.dev">
<meta property="og:type" content="website">
<meta name="twitter:title" content="DashMed - Votre tableau de bord médical par excellence">
<meta name="twitter:description" content="Gérez vos informations médicales en toute simplicité avec
    DashMed.">
<meta name="description" content="Gérez vos informations médicales en toute simplicité avec DashMed
    .">
<meta name="keywords" content="DashMed, tableau de bord médical, gestion médicale, santé
    personnelle, dossier médical, rendez-vous médicaux, rappels de médicaments, suivi de la santé">
<meta name="author" content="DashMed">
