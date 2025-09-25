<?php
class Database {
    private $host = "161.97.166.188";
    private $user = "lilian";
    private $pass = "1_@48@C2NGmlDlZl";
    private $dbname = "dashmed";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            throw new Exception("Erreur de connexion : " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }

    public function getConnection() {
        return $this->conn;
    }

    public function close() {
        $this->conn->close();
    }
}
?>