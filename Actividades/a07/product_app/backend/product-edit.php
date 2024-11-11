<?php
// Incluimos la clase Producto
include_once 'products.php'; 

header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON

$data = array(
    'status' => 'error',
    'message' => 'Ocurrió un error al actualizar el producto.'
);

// OBTENEMOS LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$productoJson = file_get_contents('php://input');

// Verifica si el JSON es vacío
if ($productoJson === false || $productoJson === '') {
    echo json_encode(['status' => 'error', 'message' => 'No se recibieron datos.']);
    exit;
}

// Decodificamos el JSON
$jsonOBJ = json_decode($productoJson);

// Verificamos si hubo un error al decodificar el JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['status' => 'error', 'message' => 'Error de JSON: ' . json_last_error_msg()]);
    exit;
}

// Verificamos que los datos esenciales estén presentes
if (isset($jsonOBJ->id, $jsonOBJ->nombre, $jsonOBJ->marca, $jsonOBJ->modelo, $jsonOBJ->precio, $jsonOBJ->detalles, $jsonOBJ->unidades)) {
    $id = $jsonOBJ->id;
    $nombre = $jsonOBJ->nombre;
    $marca = $jsonOBJ->marca;
    $modelo = $jsonOBJ->modelo;
    $precio = $jsonOBJ->precio;
    $detalles = $jsonOBJ->detalles;
    $unidades = $jsonOBJ->unidades;
    $imagen = isset($jsonOBJ->imagen) ? $jsonOBJ->imagen : null; // Si la imagen es opcional

    // Crear una instancia de la clase Producto
    $producto = new Producto();
    
    // Llamar al método de actualización de la clase Producto
    $resultado = $producto->updateProducto($id, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

    // Regresar la respuesta al frontend
    echo $resultado;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos para actualizar el producto.']);
    exit;
}
?>
