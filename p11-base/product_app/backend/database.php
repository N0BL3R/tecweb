<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        'rS7;A35_nj39L',
        'marketzone'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }
?>