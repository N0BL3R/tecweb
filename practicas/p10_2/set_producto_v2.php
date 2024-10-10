<?php
// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', 'rS7;A35_nj39L', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error);
}

// Recibir los datos del formulario
$id = isset($_POST['id']) ? intval($_POST['id']) : null; // ID del producto (si es una modificación)
$nombre = trim($_POST['nombre']);
$marca = trim($_POST['marca']);
$modelo = trim($_POST['modelo']);
$precio = (float) $_POST['precio'];
$detalles = trim($_POST['detalles']);
$unidades = (int) $_POST['unidades'];
$imagen = $_FILES['imagen']['name']; // Nombre de la imagen

// Comprobar que los campos obligatorios no están vacíos
if (empty($nombre) || empty($marca) || empty($modelo)) {
    echo 'El nombre, la marca y el modelo son obligatorios.';
    exit;
}

// Si se sube una nueva imagen, moverla al directorio "uploads"
if (!empty($imagen)) {
    $directorio = 'uploads/';
    $ruta_imagen = $directorio . basename($imagen);

    if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        echo 'Error al subir la imagen.';
        exit;
    }
} else {
    // Si no se sube una nueva imagen, mantener la imagen actual en caso de modificación
    $ruta_imagen = null;
}

// Comprobar si es una modificación (si hay un ID del producto)
if ($id) {
    // Modificar el producto existente
    if ($ruta_imagen) {
        // Si se subió una nueva imagen, actualizar también la imagen
        $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ?, imagen = ? WHERE id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('sssdsisi', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $ruta_imagen, $id);
    } else {
        // Si no se subió una nueva imagen, mantener la imagen actual
        $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ? WHERE id = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param('sssdsii', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $id);
    }

    if ($stmt->execute()) {
        echo 'Producto modificado correctamente.';
    } else {
        echo 'Error al modificar el producto: ' . $stmt->error;
    }
} else {
    // Insertar un nuevo producto
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('sssdsis', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $ruta_imagen);

    if ($stmt->execute()) {
        echo 'Producto insertado correctamente.';
    } else {
        echo 'Error al insertar el producto: ' . $stmt->error;
    }
}

// Cerrar la conexión y liberar recursos
$stmt->close();
$link->close();
?>
