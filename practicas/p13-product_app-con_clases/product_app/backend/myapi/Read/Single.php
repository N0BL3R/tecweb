<?php
namespace TECWEB\MYAPI\Read;

use TECWEB\MYAPI\DataBase;

require_once __DIR__ . '/../DataBase.php';

class Single extends DataBase {
    public function single($id) {
        $this->data = array();
        
        if (isset($id)) {
            $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();
                if ($row) {
                    $this->data = $row;
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }
}
?>
