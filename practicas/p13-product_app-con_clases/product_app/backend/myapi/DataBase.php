<?php
namespace Marketzone\ProductApp;

abstract class DataBase {
    protected $conexion;
    protected $data = [];

    public function __construct($db, $user, $pass) {
        $this->conexion = @mysqli_connect('localhost', $user, $pass, $db);

        if (!$this->conexion) {
            die('¡Base de datos NO conectada!');
        }
    }

    public function getData() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}
?>
