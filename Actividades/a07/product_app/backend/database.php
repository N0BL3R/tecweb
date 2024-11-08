<?php
class DB {
    private $host = 'localhost';
    private $user = 'root';
    private $password = 'rS7;A35_nj39L';
    private $dbname = 'marketzone';
    private $conn;

    // Constructor que inicializa la conexión
    public function __construct() {
        $this->connect();
    }

    // Método para conectar a la base de datos
    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        
        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    // Método para obtener la conexión
    public function getConnection() {
        return $this->conn;
    }
}
?>
