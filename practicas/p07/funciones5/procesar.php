<?php
header('Content-Type: application/xhtml+xml'); // Para devolver XHTML válido
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Resultado de la Verificación</title>
</head>
<body>
    <?php
    if (isset($_POST['edad']) && isset($_POST['sexo'])) {
        $edad = (int) $_POST['edad'];
        $sexo = $_POST['sexo'];

        // Verificar si es femenino y está en el rango de 18 a 35 años
        if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
            echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
        } else {
            echo "<p>Error: No cumple con los criterios de edad o sexo.</p>";
        }
    } else {
        echo "<p>Error: No se han recibido todos los datos.</p>";
    }
    ?>
</body>
</html>
