<?php
include_once 'products.php';

// Crear una instancia de la clase Producto
$producto = new Producto();

// Obtener todos los productos
echo $producto->getAllProductos();
?>
