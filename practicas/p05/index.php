<?php
// Código PHP que puede ejecutarse antes del HTML
$mensaje = "Actividad 5";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página XHTML con PHP</title>
</head>
<body>
    <h1><?php echo $mensaje; ?></h1>
    
    <p>La fecha de hoy es: <strong><?php echo date("d/m/Y"); ?></strong></p>
    
    <h2>Ejercicio 1</h2>
    <ul>
        <li><strong>$_myvar</strong>: Válida. Comienza con un <code>$</code> y el primer carácter después del <code>$</code> es un guion bajo (<code>_</code>), lo cual es permitido. Luego tiene letras, lo que también es válido.</li>
        <li><strong>$_7var</strong>: Válida. Comienza con un <code>$</code> y luego un guion bajo (<code>_</code>), lo cual es correcto. El número 7 aparece después del primer carácter, lo que es válido según las reglas de nombramiento de PHP.</li>
        <li><strong>myvar</strong>: No válida. No es una variable válida en PHP porque falta el signo <code>$</code> al inicio. Las variables en PHP siempre deben comenzar con <code>$</code>.</li>
        <li><strong>$myvar</strong>: Válida. Comienza con un <code>$</code> seguido de letras. Cumple con todas las reglas.</li>
        <li><strong>$var7</strong>: Válida. Comienza con un <code>$</code> seguido de letras, y luego tiene un número, lo cual es permitido.</li>
        <li><strong>$_element1</strong>: Válida. Comienza con un <code>$</code> seguido de un guion bajo (<code>_</code>) y luego tiene letras y un número. Cumple con las reglas de nombramiento.</li>
        <li><strong>$house*5</strong>: No válida. Aunque comienza con <code>$</code>, contiene un símbolo no permitido (<code>*</code>), lo que invalida el nombre de la variable. Los caracteres especiales como <code>*</code> no son válidos en los nombres de variables.</li>
    </ul>
    
    <h2>Ejercicio 2</h2>
    <h3>Bloque 1: Valores iniciales</h3>
    <?php
    // Bloque 1: Asignaciones iniciales
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a; // Referencia de $a

        // Mostrar contenido de las variables
        echo "<p><strong>Valor de \$a:</strong> $a</p>";
        echo "<p><strong>Valor de \$b:</strong> $b</p>";
        echo "<p><strong>Valor de \$c:</strong> $c (Referencia de \$a)</p>";
    ?>

    <h3>Bloque 2: Nuevas asignaciones</h3>
    <?php
        // Bloque 2: Nuevas asignaciones
        $a = "PHP server";
        $b = &$a; // Referencia de $a ahora también asignada a $b

        // Mostrar contenido de las variables
        echo "<p><strong>Nuevo valor de \$a:</strong> $a</p>";
        echo "<p><strong>Nuevo valor de \$b:</strong> $b (Referencia de \$a)</p>";
        echo "<p><strong>Valor de \$c:</strong> $c (Referencia anterior de \$a)</p>";
    ?>

    <h3>Descripción del segundo bloque de asignaciones</h3>
    <p>
    En el segundo bloque, la variable <strong>\$a</strong> cambió su valor a "PHP server". Dado que <strong>\$b</strong> 
    se define como referencia a <strong>\$a</strong>, el valor de <strong>\$b</strong> también es "PHP server". Sin embargo, <strong>\$c</strong> sigue siendo una referencia a <strong>\$a</strong>.
    </p>

    <h2>Ejercicio 3</h2>
    <?php
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        $c = intval($b) * 10; // Utiliza intval() para asegurarse de que $b se convierte a un número entero
        $a .= $b;             // Concatenación de $b con $a
        $b = intval($b) * $c; // Asegúrate de que $b se convierte a un número entero antes de multiplicar
        $z[0] = "MySQL";     // Cambia el valor referenciado por $z[0] a "MySQL"
        
        // Imprimir los valores de las variables
        echo "<p>a = " . $a . "</p>"; // Imprime: a = PHP55a version de PHP
        echo "<p>b = " . $b . "</p>"; // Imprime: b = 250
        echo "<p>c = " . $c . "</p>"; // Imprime: c = 50
        echo "<p>z[0] = " . $z[0] . "</p>"; // Imprime: z[0] = MySQL
    ?>

    <h2>Ejercicio 4</h2>
    <?php
        $a = "PHP5";
        $z[] = &$a; // Usamos $a sin $GLOBALS
        $b = "5a version de PHP";
        $c = intval($b) * 10; // Utilizamos intval() para convertir a entero
        $a .= $b; // Concatenación de $b con $a
        $b = intval($b) * $c; // Multiplicación de $b con $c
        $z[0] = "MySQL"; // Cambia el valor referenciado por $z[0] a "MySQL"

        // Función para imprimir valores usando global
        function printGlobals() {
            global $a, $b, $c, $z;
            echo "<p>a = " . $a . "</p>"; // Imprime: a = PHP55a version de PHP
            echo "<p>b = " . $b . "</p>"; // Imprime: b = 250
            echo "<p>c = " . $c . "</p>"; // Imprime: c = 50
            echo "<p>z[0] = " . $z[0] . "</p>"; // Imprime: z[0] = MySQL
        }

        printGlobals();
    ?>

    <h2>Ejercicio 5</h2>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo "<p>Valor de \$a: $a</p>";
        echo "<p>Valor de \$b: $b</p>";
        echo "<p>Valor de \$c: $c</p>";        
    ?>

    <h2>Ejercicio 6</h2>
    <?php
       $a = "0";
       $b = "TRUE";
       $c = FALSE;
       $d = ($a or $b);
       $e = ($a and $c);
       $f = ($a XOR $b);
       
       // Mostrar los valores booleanos usando var_dump
       echo "<p>"; var_dump($a); echo "</p>";
       echo "<p>"; var_dump($b); echo "</p>";
       echo "<p>"; var_dump($c); echo "</p>";
       echo "<p>"; var_dump($d); echo "</p>";
       echo "<p>"; var_dump($e); echo "</p>";
       echo "<p>"; var_dump($f); echo "</p>";
       
       // Mostrar valores booleanos convertidos a cadenas
       echo "<p>Valor de \$c: " . ($c ? 'true' : 'false') . "</p>";
       echo "<p>Valor de \$e: " . ($e ? 'true' : 'false') . "</p>";
    ?>
    
    <h2>Ejercicio 7</h2>
    <?php
        // Versión de Apache y PHP
        echo '<p>Versión de Apache: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';
        echo '<p>Versión de PHP: ' . phpversion() . '</p>';

        // Información del sistema operativo del servidor
        echo '<p>Información del servidor: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';

        // Idioma del navegador
        echo '<p>Idioma del navegador: ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '</p>';
    ?>
</body>
</html>

<p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
  </p>