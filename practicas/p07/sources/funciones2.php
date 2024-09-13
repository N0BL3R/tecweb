<?php
function generarNumeroAleatorio() {
    return rand(100, 999); // Genera un número aleatorio de 3 dígitos
}

function esPar($numero) {
    return $numero % 2 == 0; // Retorna true si el número es par
}

function esImpar($numero) {
    return $numero % 2 != 0; // Retorna true si el número es impar
}

$matriz = []; // Matriz para almacenar las secuencias
$iteraciones = 0;
$totalNumerosGenerados = 0;

do {
    $iteraciones++;

    // Generar una secuencia de 3 números
    $num1 = generarNumeroAleatorio();
    $num2 = generarNumeroAleatorio();
    $num3 = generarNumeroAleatorio();

    // Almacenar la secuencia en la matriz
    $matriz[] = [$num1, $num2, $num3];

    // Incrementar el conteo de números generados
    $totalNumerosGenerados += 3;

    // Verificar si la secuencia cumple con el patrón impar, par, impar
} while (!(esImpar($num1) && esPar($num2) && esImpar($num3)));

// Mostrar la matriz completa de forma ordenada
echo "Matriz generada:\n";
echo "========================\n";
foreach ($matriz as $fila) {
    // Usamos printf para mantener los números alineados
    printf("%5d %5d %5d\n", $fila[0], $fila[1], $fila[2]);
}
echo "========================\n";

// Mostrar las estadísticas finales
echo "\n$totalNumerosGenerados números obtenidos en $iteraciones iteraciones.\n";
?>
