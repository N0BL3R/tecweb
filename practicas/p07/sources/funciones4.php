<?php
// Crear el arreglo con un ciclo for
$arreglo = [];

for ($i = 97; $i <= 122; $i++) {
    $arreglo[$i] = chr($i); // Asignar el valor de la letra correspondiente al código ASCII
}

// Imprimir la tabla en XHTML
echo "<table border='1' cellpadding='5' cellspacing='0'>"; // Tabla con borde

echo "<tr><th>Índice</th><th>Valor</th></tr>"; // Encabezados de la tabla

// Leer el arreglo con foreach y mostrarlo en la tabla
foreach ($arreglo as $key => $value) {
    echo "<tr>";
    echo "<td>$key</td>";   // Mostrar el índice
    echo "<td>$value</td>"; // Mostrar la letra
    echo "</tr>";
}

echo "</table>"; // Cerrar la tabla
?>
