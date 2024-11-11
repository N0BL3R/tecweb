<?php
require_once 'products.php'; // Incluye la clase Producto

// Establecer el encabezado para JSON
header('Content-Type: application/json');

// Lee el JSON recibido
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Verifica que todos los campos requeridos estén presentes
if (isset($input['nombre'], $input['marca'], $input['modelo'], $input['precio'], $input['detalles'], $input['unidades'], $input['imagen'])) {
    $producto = new Producto();
    $resultado = $producto->addProducto($input['nombre'], $input['marca'], $input['modelo'], $input['precio'], $input['detalles'], $input['unidades'], $input['imagen']);
    
    // Asegurarse de que la respuesta sea un JSON correcto
    echo json_encode([
        'status' => 'success',
        'message' => 'Producto agregado correctamente',
        'data' => json_decode($resultado) // Esto es solo si el resultado de addProducto devuelve un JSON válido
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Datos incompletos para agregar el producto.'
    ]);
}
?>
