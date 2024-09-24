<?php
// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', 'rS7;A35_nj39L', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error);
}

// Recibir los datos del formulario y asegurarse de que son válidos
$nombre = trim($_POST['nombre']);
$marca = trim($_POST['marca']);
$modelo = trim($_POST['modelo']);
$precio = (float) $_POST['precio'];
$detalles = trim($_POST['detalles']);
$unidades = (int) $_POST['unidades'];
$imagen = $_FILES['imagen']['name'];  // Nombre de la imagen

// Comprobar que los campos obligatorios no están vacíos
if (empty($nombre) || empty($marca) || empty($modelo)) {
    echo 'El nombre, la marca y el modelo son obligatorios.';
    exit;
}

// Comprobar si el producto ya existe (nombre, marca y modelo únicos)
$sql = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param('sss', $nombre, $marca, $modelo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Si existe un producto con el mismo nombre, marca y modelo
    echo 'El producto ya existe en la base de datos.';
} else {
    // Subir la imagen al servidor (directorio "uploads")
    $directorio = 'uploads/';
    $ruta_imagen = $directorio . basename($imagen);

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        // Comentamos la consulta anterior:
        /*
        // Insertar el nuevo producto, asegurando que 'eliminado' sea 0 por defecto
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
                VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('sssdsis', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $ruta_imagen);
        */
        
        // Nueva consulta que utiliza los nombres de columnas, excluyendo 'id' y 'eliminado'
        $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('sssdsis', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $ruta_imagen);

        if ($stmt->execute()) {
            // Mostrar resumen de los datos insertados en formato XHTML
            echo '<?xml version="1.0" encoding="UTF-8"?>';
            echo '<!DOCTYPE html>';
            echo '<html xmlns="http://www.w3.org/1999/xhtml">';
            echo '<head><title>Producto Insertado</title></head>';
            echo '<body>';
            echo '<h1>Producto Insertado Correctamente</h1>';
            echo '<ul>';
            echo '<li><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</li>';
            echo '<li><strong>Marca:</strong> ' . htmlspecialchars($marca) . '</li>';
            echo '<li><strong>Modelo:</strong> ' . htmlspecialchars($modelo) . '</li>';
            echo '<li><strong>Precio:</strong> ' . htmlspecialchars($precio) . '</li>';
            echo '<li><strong>Detalles:</strong> ' . htmlspecialchars($detalles) . '</li>';
            echo '<li><strong>Unidades:</strong> ' . htmlspecialchars($unidades) . '</li>';
            echo '<li><strong>Imagen:</strong> <img src="' . htmlspecialchars($ruta_imagen) . '" alt="Imagen del producto" /></li>';
            echo '</ul>';
            echo '</body>';
            echo '</html>';
        } else {
            echo 'Error al insertar el producto: ' . $stmt->error;
        }
    } else {
        echo 'Error al subir la imagen.';
    }
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$link->close();
?>

