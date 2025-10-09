<?php
class Database {
    private string $host, $user, $pass, $dbname;
    private mysqli $conn;

    /**
     * @throws Exception
     */
    private function loadEnv($path): void
    {
        if (!file_exists($path)) {
            throw new Exception(".env file not found at $path");
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) continue;
            list($name, $value) = array_map('trim', explode('=', $line, 2));
            $_ENV[$name] = $value;
        }
    }

    /**
     * @throws Exception
     */
    public function __construct() {
        $this->loadEnv(__DIR__ . '/../.env');
        $this->host = $_ENV['DB_HOST'] ?? '';
        $this->user = $_ENV['DB_USER'] ?? '';
        $this->pass = $_ENV['DB_PASS'] ?? '';
        $this->dbname = $_ENV['DB_NAME'] ?? '';
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            throw new Exception("Erreur de connexion : " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8");
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }

    public function close(): void
    {
        $this->conn->close();
    }
}
