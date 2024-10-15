<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    // SE VERIFICA HABER RECIBIDO EL TÉRMINO DE BÚSQUEDA Y QUE NO ESTÉ VACÍO
    if( isset($_POST['searchTerm']) && !empty($_POST['searchTerm']) ) {
        $searchTerm = $_POST['searchTerm'];

        // SE REALIZA LA QUERY USANDO LA CLÁUSULA LIKE
        $query = "SELECT * FROM productos WHERE nombre LIKE '%$searchTerm%' OR marca LIKE '%$searchTerm%' OR detalles LIKE '%$searchTerm%'";

        // SE EJECUTA LA QUERY Y SE VALIDAN LOS RESULTADOS
        if ( $result = $conexion->query($query) ) {
            while($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // CODIFICAR A UTF-8 LOS DATOS Y AGREGARLOS AL ARREGLO DE RESPUESTA
                $producto = array();
                foreach($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                $data[] = $producto;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
    } else {
        $data['error'] = 'Por favor, ingresa un término de búsqueda.';
    }
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON Y SE DEVUELVE
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
