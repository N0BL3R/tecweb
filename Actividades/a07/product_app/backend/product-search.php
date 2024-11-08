<?php
include_once 'products.php';

// Obtener el término de búsqueda desde la solicitud POST
$searchTerm = $_POST['searchTerm'];

// Crear una instancia de la clase Producto
$producto = new Producto();

// Buscar productos que coincidan con el término de búsqueda
echo $producto->searchProductos($searchTerm);
?>
