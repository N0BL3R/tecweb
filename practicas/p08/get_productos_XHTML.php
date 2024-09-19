<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <?php
    // Inicializar variable $tope
    $tope = '';

    if (isset($_GET['tope'])) {
        $tope = $_GET['tope'];

        if (!empty($tope)) {
            /** SE CREA EL OBJETO DE CONEXION */
            @$link = new mysqli('localhost', 'root', 'rS7;A35_nj39L', 'marketzone');

            /** comprobar la conexión */
            if ($link->connect_errno) {
                die('Falló la conexión: '.$link->connect_error.'<br/>');
            }

            /** Crear una tabla que no devuelve un conjunto de resultados */
            if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                /** útil para liberar memoria asociada a un resultado con demasiada información */
                $result->free();
            }

            $link->close();
        }
    }

    ?>
    
    <h3>Productos con Unidades Menores o Iguales a <?php echo htmlspecialchars($tope); ?></h3>

    <?php
    if (!empty($tope)) {
        if (!empty($rows)) {
            echo '<table class="table">';
            echo '<thead class="thead-dark">';
            echo '<tr>';
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Nombre</th>';
            echo '<th scope="col">Marca</th>';
            echo '<th scope="col">Modelo</th>';
            echo '<th scope="col">Precio</th>';
            echo '<th scope="col">Unidades</th>';
            echo '<th scope="col">Detalles</th>';
            echo '<th scope="col">Imagen</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            foreach ($rows as $row) {
                echo '<tr>';
                echo '<th scope="row">'.htmlspecialchars($row['id']).'</th>';
                echo '<td>'.htmlspecialchars($row['nombre']).'</td>';
                echo '<td>'.htmlspecialchars($row['marca']).'</td>';
                echo '<td>'.htmlspecialchars($row['modelo']).'</td>';
                echo '<td>'.htmlspecialchars($row['precio']).'</td>';
                echo '<td>'.htmlspecialchars($row['unidades']).'</td>';
                echo '<td>'.htmlspecialchars(utf8_encode($row['detalles'])).'</td>';
                echo '<td><img src="'.htmlspecialchars($row['imagen']).'" alt="Imagen del producto"></td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>No se encontraron productos con unidades menores o iguales a '.$tope.'.</p>';
        }
    } else {
        echo '<p>El parámetro "tope" está vacío o no se ha proporcionado.</p>';
    }
    ?>
</body>
</html>
