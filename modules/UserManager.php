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
        $pwd = $this->db->real_escape_string($user->pwd);

        $sql = "INSERT INTO users (first_name, last_name, gender, email, pwd)
                VALUES ('$fn', '$ln', '$gender', '$email', '$pwd')";
        return $this->db->query($sql);
    }

    // Autres méthodes : getUserById, updateUser, deleteUser ...
}
?>