<?php
namespace TECWEB\MYAPI\Read;

use TECWEB\MYAPI\DataBase;

require_once __DIR__ . '/../DataBase.php';  // Ajusta la ruta según la ubicación


class ListProducts extends DataBase {
    public function list() {
        // Limpiamos cualquier dato anterior
        $this->data = [];

        // Ejecutamos la consulta para obtener los productos
        if ($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            // Convertimos los resultados en un array
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if ($rows) {
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('Error en la consulta: ' . mysqli_error($this->conexion));
        }
    }
}
?>
