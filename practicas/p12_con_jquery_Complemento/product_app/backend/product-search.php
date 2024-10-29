<?php
include_once __DIR__.'/database.php';

$data = array();
if (isset($_GET['search'])) {
    // Usar real_escape_string para evitar inyecciones SQL
    $search = $conexion->real_escape_string(trim($_GET['search']));

    // Consulta para verificar solo el nombre y no eliminar
    $sql = "SELECT * FROM productos WHERE nombre = '{$search}' AND eliminado = 0";

    if ($result = $conexion->query($sql)) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if (!empty($rows)) {
            $data = $rows; // Si se encuentra un resultado, llenamos el array
        }
        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }
    $conexion->close();
}

header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
echo json_encode($data);
?>
