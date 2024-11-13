<?php
require_once __DIR__ . '/../vendor/autoload.php';
// Asegúrate de incluir la clase necesaria
use Marketzone\ProductApp\Delete\Delete;
//require_once __DIR__ . '/MYAPI/Delete/Delete.php';  // Ruta correcta al archivo Delete.php

// Crear una instancia de Delete
$deleteProduct = new Delete('marketzone', 'root', 'rS7;A35_nj39L');

// Verificar que el ID del producto ha sido proporcionado
if (isset($_POST['id'])) {
    // Llamamos al método delete() para eliminar el producto
    $deleteProduct->delete($_POST['id']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de producto no proporcionado']);
}

// Imprimimos los resultados (datos obtenidos) en formato JSON
echo $deleteProduct->getData();
?>
