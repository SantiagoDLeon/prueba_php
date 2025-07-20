<?php
class Database {
    private $host = "localhost";
    private $db_name = "prueba_php";
    private $username = "root";
    private $password = "Maxx45682";
    public $conn;

    public function conectar() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->db_name",
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
            return $this->conn;
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>