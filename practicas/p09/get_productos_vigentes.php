<?php
// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', 'rS7;A35_nj39L', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error);
}

// Encabezado para el contenido XHTML
header('Content-Type: application/xhtml+xml; charset=UTF-8');

// Consulta para obtener los productos vigentes (no eliminados)
$sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen 
        FROM productos WHERE eliminado = 0";
$resultado = $link->query($sql);

// Comprobar si hay productos para mostrar
if ($resultado->num_rows > 0) {
    // Generar el documento XHTML
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html>';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head><title>Productos Vigentes</title></head>';
    echo '<body>';
    echo '<h1>Listado de Productos Vigentes</h1>';
    echo '<table border="1">';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nombre</th>';
    echo '<th>Marca</th>';
    echo '<th>Modelo</th>';
    echo '<th>Precio</th>';
    echo '<th>Detalles</th>';
    echo '<th>Unidades</th>';
    echo '<th>Imagen</th>';
    echo '</tr>';

    // Mostrar cada producto
    while ($producto = $resultado->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($producto['id']) . '</td>';
        echo '<td>' . htmlspecialchars($producto['nombre']) . '</td>';
        echo '<td>' . htmlspecialchars($producto['marca']) . '</td>';
        echo '<td>' . htmlspecialchars($producto['modelo']) . '</td>';
        echo '<td>' . htmlspecialchars($producto['precio']) . '</td>';
        echo '<td>' . htmlspecialchars($producto['detalles']) . '</td>';
        echo '<td>' . htmlspecialchars($producto['unidades']) . '</td>';
        echo '<td><img src="' . htmlspecialchars($producto['imagen']) . '" alt="Imagen del producto" width="100"/></td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</body>';
    echo '</html>';
} else {
    // Si no hay productos vigentes
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<!DOCTYPE html>';
    echo '<html xmlns="http://www.w3.org/1999/xhtml">';
    echo '<head><title>Productos Vigentes</title></head>';
    echo '<body>';
    echo '<h1>No hay productos vigentes disponibles</h1>';
    echo '</body>';
    echo '</html>';
}

// Cerrar la conexión
$link->close();
?>
