<?php
$nombre = 'nombre_producto';
$marca  = 'marca_producto';
$modelo = 'modelo_producto';
$precio = 1.0;
$detalles = 'detalles_producto';
$unidades = 1;
$imagen   = 'img/imagen.png';

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'rS7;A35_nj39L', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

/** Insertando valores de manera explícita en las columnas correspondientes */
$sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
        VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

if ( $link->query($sql) ) 
{
    echo 'Producto insertado con ID: '.$link->insert_id;
}
else
{
    echo 'El Producto no pudo ser insertado =(';
}

$link->close();
?>
