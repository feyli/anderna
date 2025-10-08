<?php
require_once dirname(__DIR__, 2) . '/modules/Database.php';
require_once dirname(__DIR__, 2) . '/modules/User.php';

class resetPasswordController
{
    public function reset()
    {
        $db = new Database();
        $conn = $db->getConnection();

        if (!isset($_GET['token']))
        {
            die("Lien invalide.");
        }

        $token = $_GET['token'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0)
        {
            die("Lien invalide ou expiré.");
        }

        $user = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'], $_POST['confirm_password']))
        {
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);

            if ($password !== $confirm_password)
            {
                echo "<script>alert('Les mots de passe ne correspondent pas.');</script>";
            }
            elseif (strlen($password) < 8)
            {
                echo "<script>alert('Le mot de passe doit contenir au moins 8 caractères.');</script>";
            }
            else
            {
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                $update = $conn->prepare("UPDATE users SET pwd = ?, reset_token = NULL, reset_expires = NULL WHERE id = ?");
                $update->bind_param("si", $hashedPwd, $user['id']);
                $update->execute();

                echo "<script>alert('Votre mot de passe a été réinitialisé avec succès.'); window.location.href='/login';</script>";
                exit;
            }
        }

        require __DIR__ . '/../Views/resetPassword.php';
    }
}