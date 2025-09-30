<?php
require_once 'Database.php';
require_once 'User.php';

class UserManager {
    private $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    // Ajouter un utilisateur
    public function addUser($user) {
        $fn = $this->db->real_escape_string($user->first_name);
        $ln = $this->db->real_escape_string($user->last_name);
        $gender = $this->db->real_escape_string($user->gender);
        $email = $this->db->real_escape_string($user->email);
        $pwd = password_hash($user->pwd, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, gender, email, pwd)
                VALUES ('$fn', '$ln', '$gender', '$email', '$pwd')";
        return $this->db->query($sql);
    }

    public function deleteUser($id) {
        $id = intval($id);
        $sql = "DELETE FROM users WHERE id=$id";
        return $this->db->query($sql);
    }

    public function login($email, $pwd) {
        $email = $this->db->real_escape_string($email);
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $this->db->query($sql);
        if ($result && $result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            // Vérification du mot de passe
            if (password_verify($pwd, $userData['pwd'])) {
                return $userData; // Connexion OK
            }
        }
        return false;
    }

    public function deleteUserByEmail($email) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $this->db->affected_rows > 0;
    }
}
?>