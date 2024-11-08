<?php
require_once 'products.php'; // Incluye la clase Producto

// Lee el JSON recibido
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, true);

// Verifica que todos los campos requeridos estén presentes
if (isset($input['id'], $input['nombre'], $input['marca'], $input['modelo'], $input['precio'], $input['detalles'], $input['unidades'], $input['imagen'])) {
    $producto = new Producto();
    $resultado = $producto->updateProducto(
        $input['id'],
        $input['nombre'],
        $input['marca'],
        $input['modelo'],
        $input['precio'],
        $input['detalles'],
        $input['unidades'],
        $input['imagen']
    );
    
    echo $resultado;
} else {
    echo json_encode(['mensaje' => 'Datos incompletos para actualizar el producto.']);
}
?>
