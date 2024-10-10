<?php

// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', 'rS7;A35_nj39L', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error);
}

// Verificar si se ha pasado un ID en la URL
if (isset($_GET['id'])) {
    // Obtener el ID del producto desde la URL
    $id_producto = intval($_GET['id']);

    // Consulta para obtener el producto específico por ID
    $sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen 
            FROM productos WHERE eliminado = 0 AND id = $id_producto";
    $resultado = $link->query($sql);

    // Comprobar si el producto existe
    if ($resultado->num_rows > 0) {
        // Obtener los datos del producto
        $producto = $resultado->fetch_assoc();

        // Devolver los datos del producto en formato JSON
        header('Content-Type: application/json');
        echo json_encode($producto);
    } else {
        // Si no se encuentra el producto con ese ID
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Producto no encontrado']);
    }
} else {
    // Si no se proporciona ID, generar la tabla de productos

    // Consulta para obtener los productos vigentes (no eliminados)
    $sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen 
            FROM productos WHERE eliminado = 0";
    $resultado = $link->query($sql);

    // Comprobar si hay productos para mostrar
    if ($resultado->num_rows > 0) {
        // Generar el documento XHTML
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<!DOCTYPE html>';
        echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">';
        echo '<head>';
        echo '<meta charset="UTF-8" />';
        echo '<title>Productos Vigentes</title>';
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
        echo '</head>';
        echo '<body>';
        echo '<h1>Listado de Productos Vigentes</h1>';
        echo '<table class="table table-striped">';
        echo '<thead class="thead-dark">';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre</th>';
        echo '<th>Marca</th>';
        echo '<th>Modelo</th>';
        echo '<th>Precio</th>';
        echo '<th>Detalles</th>';
        echo '<th>Unidades</th>';
        echo '<th>Imagen</th>';
        echo '<th>Editar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

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
            echo '<td><a href="formulario_productos_v2.html?id=' . htmlspecialchars($producto['id']) . '" class="btn btn-warning">Editar</a></td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</body>';
        echo '</html>';
    } else {
        // Si no hay productos vigentes
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<!DOCTYPE html>';
        echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">';
        echo '<head><meta charset="UTF-8" /><title>Productos Vigentes</title></head>';
        echo '<body>';
        echo '<h1>No hay productos vigentes disponibles</h1>';
        echo '</body>';
        echo '</html>';
    }
}

// Cerrar la conexión
$link->close();
?>
