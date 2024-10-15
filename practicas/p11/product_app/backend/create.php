<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE EL JSON ENVIADO DESDE EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);

        // VALIDACIÓN PARA VERIFICAR SI EL PRODUCTO YA EXISTE
        $nombre = $jsonOBJ->nombre;
        $query = "SELECT * FROM productos WHERE nombre = ? AND eliminado = 0";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // EL PRODUCTO YA EXISTE
            echo json_encode(['message' => 'Producto ya existe']);
        } else {
            // EL PRODUCTO NO EXISTE, REALIZAMOS LA INSERCIÓN
            $precio = $jsonOBJ->precio;
            $unidades = $jsonOBJ->unidades;
            $modelo = $jsonOBJ->modelo;
            $marca = $jsonOBJ->marca;
            $detalles = $jsonOBJ->detalles; // Guardamos la descripción
            $imagen = $jsonOBJ->imagen;

            $insertQuery = "INSERT INTO productos (nombre, precio, unidades, modelo, marca, detalles, imagen, eliminado) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
            $insertStmt = $conexion->prepare($insertQuery);
            $insertStmt->bind_param("sdissss", $nombre, $precio, $unidades, $modelo, $marca, $detalles, $imagen);

            if ($insertStmt->execute()) {
                echo json_encode(['message' => 'Producto agregado correctamente']);
            } else {
                echo json_encode(['message' => 'Error al agregar el producto']);
            }

            $insertStmt->close();
        }
        $stmt->close();
    }
?>
