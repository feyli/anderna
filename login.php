<?php require_once 'modules/DataBase.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="_assets/includes/styles/styles.css">
    <link rel="stylesheet" href="_assets/includes/styles/style-login.css">
    <title>Connectez-vous</title>
</head>
<body>
    <?php include 'modules/blog/controllers/views/templates/header.php'; ?>
    <main>
    <div class="login-container">
        <h1 class="login-title">Connexion</h1>

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
                <a type="submit" class="btn btn-primary">Connexion</a>
                <a type="button" class="btn btn-secondary" href="index.php">Retour</a>
            </div>
        </form>

    </div>
    </main>
    <?php
        if ($_POST['submit']) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $result = login($email, $password);
            
            if ($result) {
                echo "Login successful!";
            } else {
                echo "Login failed!";
            }
        }
    ?>
</body>
</html>