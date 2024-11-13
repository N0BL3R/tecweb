<?php
// Asegúrate de incluir la clase necesaria
use TECWEB\MYAPI\Create\Add;
require_once __DIR__ . '/MYAPI/Create/Add.php';  // Ruta correcta al archivo Add.php

// Crear una instancia de Add (usando el nombre correcto de la clase)
$addProduct = new Add('marketzone', 'root', 'rS7;A35_nj39L');

// Recibimos los datos desde el formulario o la solicitud POST
// Aquí asumimos que los datos vienen como $_POST, y los convertimos a un objeto
$productData = json_decode(json_encode($_POST));

// Llamamos al método add() para agregar el producto
$addProduct->add($productData);

// Imprimimos los resultados (datos obtenidos) en formato JSON
echo $addProduct->getData();
?>
