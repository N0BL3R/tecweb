<?php
namespace Marketzone\ProductApp\Read;

use Marketzone\ProductApp\DataBase;

//require_once __DIR__ . '/../DataBase.php';
//require_once __DIR__ . '/vendor/autoload.php';


class Search extends DataBase {
    public function search($search) {
        // SE INICIALIZA EL ARREGLO DE RESPUESTA
        $this->data = [];

        if( isset($search) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            if ( $result = $this->conexion->query($sql) ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                
                // SE VERIFICA QUE HAYA RESULTADOS
                if (count($rows) > 0) {
                    foreach ($rows as $num => $row) {
                        // SE MAPEAN LOS RESULTADOS AL ARREGLO DE RESPUESTA
                        $this->data[$num] = $row;
                    }
                }
                $result->free();
            } else {
                // SI HAY UN ERROR EN LA CONSULTA, SE DEVUELVE UN ERROR
                die('Query Error: '.mysqli_error($this->conexion));
            }
            // SE CIERRE LA CONEXIÓN
            $this->conexion->close();
        }

        // SE DEVUELVE LA RESPUESTA EN FORMATO JSON
        return json_encode($this->data);
    }
}
?>
