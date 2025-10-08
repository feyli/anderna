<?php
require_once dirname(__DIR__, 2) . '/modules/Database.php';
require_once dirname(__DIR__, 2) . '/modules/User.php';

class forgottenPasswordController
{
    public function forgot()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = trim($_POST['email']);
            $db = new Database();
            $conn = $db->getConnection();

            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0)
            {
                echo "<script> alert('Cet adresse mail n\'existe pas. Veuillez en taper une correcte.'); 
                      window.location.href='/forgot'; </script>";
                exit;
            }

            $user = $result->fetch_assoc();

            if (function_exists('random_bytes')) {
                $token = bin2hex(random_bytes(32));
            }
            elseif (function_exists('openssl_random_pseudo_bytes'))
            {
                $token = bin2hex(openssl_random_pseudo_bytes(32));
            }
            else
            {
                $token = bin2hex(md5(uniqid(mt_rand(), true)));
            }

            date_default_timezone_set('Europe/Paris');
            $expires = date("Y-m-d H:i:s", strtotime('+10 minutes'));

            $update = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
            $update->bind_param("sss", $token, $expires, $email);
            $update->execute();

            $resetLink = "https://dashmed.feyli.dev/reset?token=" . $token;

            $headers = "From: noreply@dashmed.feyli.dev\r\n";
            $headers .= "To: '$email'\r\n";
            $headers .= "X-Mailer: PHP/" . phpversion();
            $subject = "Réinitialisation de votre mot de passe";
            $message = "Bonjour,\n\nCliquez sur ce lien pour réinitialiser votre mot de passe :\n$resetLink\n\nCe lien expirera dans 10 minutes.";

            if (mail($email, $subject, $message, $headers))
            {
                echo "<script>alert('Un mail de réinitialisation vous a été envoyé.');</script>";
            }
            else
            {
                echo "<script>alert('Un problème d\'envoi de l\'email de réinitialisation est survenu. Veuillez réessayer.');</script>";
            }
        }
        require __DIR__ . '/../Views/forgottenPassword.php';
    }
}