<?php
include_once __DIR__.'/database.php';

header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON
ob_start(); // Inicia el buffer de salida para capturar cualquier salida no deseada

$data = array(
    'status' => 'error',
    'message' => 'Ocurrió un error al actualizar el producto.'
);

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');

if ($producto === false || $producto === '') {
    echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos.']);
    exit;
}

$jsonOBJ = json_decode($producto);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['status' => 'error', 'message' => 'Error de JSON: ' . json_last_error_msg()]);
    exit;
}

if (isset($jsonOBJ->id)) {
    $id = $jsonOBJ->id;
    $nombre = $jsonOBJ->nombre;
    $marca = $jsonOBJ->marca;
    $modelo = $jsonOBJ->modelo;
    $precio = $jsonOBJ->precio;
    $detalles = $jsonOBJ->detalles;
    $unidades = $jsonOBJ->unidades;

    // Actualiza el producto en la base de datos
    $sql = "UPDATE productos SET nombre = '{$nombre}', marca = '{$marca}', modelo = '{$modelo}', precio = {$precio}, detalles = '{$detalles}', unidades = {$unidades} WHERE id = {$id} AND eliminado = 0";
    
    if ($conexion->query($sql) === TRUE) {
        $data['status'] = "success";
        $data['message'] = "Producto actualizado correctamente.";
    } else {
        $data['message'] = "ERROR: No se pudo actualizar el producto. " . mysqli_error($conexion);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID del producto no proporcionado.']);
    exit;
}

$conexion->close();
ob_end_clean(); // Limpia el buffer de salida antes de enviar la respuesta
echo json_encode($data, JSON_PRETTY_PRINT);
?>
