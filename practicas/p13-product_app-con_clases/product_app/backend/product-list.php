<?php
// Asegúrate de incluir la clase necesaria
use TECWEB\MYAPI\Read\ListProducts;
require_once __DIR__ . '/MYAPI/Read/List.php';  // Ruta correcta al archivo List.php

// Crear una instancia de ListProducts
$productList = new ListProducts('marketzone', 'root', 'rS7;A35_nj39L');

// Llamamos al método list() para obtener los productos
$productList->list();

// Imprimir los datos obtenidos en formato JSON
echo $productList->getData();
?>