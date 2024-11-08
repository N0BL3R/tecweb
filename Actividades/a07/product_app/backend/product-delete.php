<?php
require_once 'products.php'; // Incluye la clase Producto

// Verifica si el ID fue proporcionado en la solicitud GET
if (isset($_GET['id'])) {
    $producto = new Producto();
    $resultado = $producto->deleteProducto($_GET['id']);
    
    echo $resultado;
} else {
    echo json_encode(['mensaje' => 'ID de producto no especificado para eliminar.']);
}
?>
