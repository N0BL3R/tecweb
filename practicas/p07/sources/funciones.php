<?php
// Verificar si el número fue pasado como parámetro
if (isset($_GET['numero'])) {
    // Recuperar el número desde la URL
    $numero = $_GET['numero'];

    // Verificar si el número es válido
    if (is_numeric($numero)) {
        // Convertir a entero por si acaso
        $numero = (int) $numero;

        // Comprobar si es múltiplo de 5 y 7
        if ($numero % 5 == 0 && $numero % 7 == 0) {
            echo "El número $numero es múltiplo de 5 y 7.";
        } else {
            echo "El número $numero no es múltiplo de 5 y 7.";
        }
    } else {
        echo "Por favor, introduce un número válido.";
    }
} else {
    echo "No se ha proporcionado un número.";
}
?>
