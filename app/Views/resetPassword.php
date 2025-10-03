<?php require_once dirname(__DIR__, 2) . '/modules/Database.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-reset.css">
    <?php include __DIR__ . '/../../modules/controllers/views/templates/head.php'; ?>
    <title>Réinitialiser Mots de Passe</title>
</head>
<body>
<?php include __DIR__ . '/../../modules/controllers/views/templates/header.php'; ?>
<main>
    <div class="reset-container">
        <h1 class="reset-title">Réinitialiser Mots de Passe</h1>

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
                <a type="submit" class="btn btn-primary" href="/login">Confirmer</a>
            </div>
        </form>
    </div>
</main>
</body>
</html>