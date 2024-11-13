<?php
// Asegúrate de incluir la clase necesaria
use TECWEB\MYAPI\Update\Edit;
require_once __DIR__ . '/MYAPI/Update/Edit.php';  // Ruta correcta al archivo Edit.php

// Crear una instancia de Edit (usando el nombre correcto de la clase)
$editProduct = new Edit('marketzone', 'root', 'rS7;A35_nj39L');

// Recibimos los datos desde el formulario o la solicitud POST
// Aquí asumimos que los datos vienen como $_POST, y los convertimos a un objeto
$productData = json_decode(json_encode($_POST));

// Llamamos al método edit() para editar el producto
$editProduct->edit($productData);

// Imprimimos los resultados (datos obtenidos) en formato JSON
echo $editProduct->getData();
?>
