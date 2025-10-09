<?php
require_once 'Database.php';
require_once 'User.php';

class UserManager {
    private mysqli $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    // Ajouter un utilisateur
    public function addUser(User $user): bool
    {
        $genderValue = $user->gender;
        $gender = in_array($genderValue, ['M', 'F', 'X']) ? $genderValue : 'X';
        $pwd = password_hash($user->pwd, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (first_name, last_name, gender, email, pwd)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("sssss",
            $user->first_name,
            $user->last_name,
            $gender,
            $user->email,
            $pwd
        );

        return $stmt->execute();
    }

    // Supprimer un utilisateur
    public function deleteUser($id): bool
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Connexion d'un utilisateur
    public function login($email, $pwd): false|array|null
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            if (password_verify($pwd, $userData['pwd'])) {
                return $userData; // Connexion OK
            }
        }
        return false;
    }

    public function deleteUserByEmail($email): bool
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }
}