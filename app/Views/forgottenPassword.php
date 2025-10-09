<?php require_once dirname(__DIR__, 2) . '/modules/Database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-forgot.css">
    <?php include __DIR__ . '/../../modules/controllers/views/templates/head.php'; ?>
    <title>Mots de passe oubliés</title>
</head>
<body>
    <?php include __DIR__ . '/../../modules/controllers/views/templates/header.php'; ?>
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
                </div>
            </form>
        </div>
    </main>
</body>
</html>