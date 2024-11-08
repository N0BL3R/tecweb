<?php
require_once 'products.php'; // Incluye la clase Producto

// Lee el JSON recibido
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Verifica que todos los campos requeridos estén presentes
if (isset($input['nombre'], $input['marca'], $input['modelo'], $input['precio'], $input['detalles'], $input['unidades'], $input['imagen'])) {
    $producto = new Producto();
    $resultado = $producto->addProducto($input['nombre'], $input['marca'], $input['modelo'], $input['precio'], $input['detalles'], $input['unidades'], $input['imagen']);
    
    echo $resultado;
} else {
    echo json_encode(['mensaje' => 'Datos incompletos para agregar el producto.']);
}
?>
