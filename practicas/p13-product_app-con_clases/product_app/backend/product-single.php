<?php
// Asegúrate de incluir la clase necesaria
use TECWEB\MYAPI\Read\Single;
require_once __DIR__ . '/MYAPI/Read/Single.php';  // Ruta correcta al archivo Single.php

// Crear una instancia de Single (usando el nombre correcto de la clase)
$singleProduct = new Single('marketzone', 'root', 'rS7;A35_nj39L');

// Recibimos el ID del producto a través de $_POST
$productId = $_POST['id'] ?? null;

// Llamamos al método single() para obtener el producto
$singleProduct->single($productId);

// Imprimimos los resultados (datos obtenidos) en formato JSON
echo $singleProduct->getData();
?>
