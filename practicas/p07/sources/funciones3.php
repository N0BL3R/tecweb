<?php
// Verificar si el número fue pasado como parámetro
if (isset($_GET['multiplo'])) {
    $multiplo = (int) $_GET['multiplo'];

    if ($multiplo > 0) {
        // Iniciar la búsqueda con un ciclo while
        $numeroAleatorio = 0;
        $intentos = 0;

        while ($numeroAleatorio % $multiplo != 0) {
            $numeroAleatorio = rand(1, 1000); // Genera un número aleatorio entre 1 y 1000
            $intentos++;
        }

        echo "Número encontrado: $numeroAleatorio es múltiplo de $multiplo.<br>";
        echo "Intentos realizados: $intentos.<br>";
    } else {
        echo "Por favor, introduce un número válido mayor a 0.";
    }
} else {
    echo "No se ha proporcionado un número múltiplo en la URL.";
}
?>
