<?php require_once dirname(__DIR__, 2) . '/modules/Database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-login.css">
    <link rel="stylesheet" href="/_assets/includes/styles/styles-footer.css">
    <?php include __DIR__ . '/../../modules/controllers/views/templates/head.php'; ?>
    <title>Se connecter</title>
</head>
<body>
    <?php include __DIR__ . '/../../modules/controllers/views/templates/header.php'; ?>
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
                    <a href="#">Mot de passe oublié ?</a>
                </div>

                <div class="button-group">
                    <button type="submit" name="submit" class="btn btn-primary">Connexion</button>
                    <a type="button" class="btn btn-secondary" href="/">Retour</a>
                </div>
            </form>

        </div>
    </main>
    <?php
    require_once dirname(__DIR__, 2) . '/modules/UserManager.php';
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $database = new DataBase();
        $userManager = new UserManager($database);
        $result = $userManager->login($email, $password);

        if ($result) {
            echo "Login successful!";
        } else {
            echo "Login failed!";
        }
    }
    include __DIR__ . '/../../modules/controllers/views/templates/footer.php'; ?>
</body>
</html>