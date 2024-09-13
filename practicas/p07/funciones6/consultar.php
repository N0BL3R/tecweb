<?php
// Arreglo asociativo con los vehículos
$parqueVehicular = [
    'ABC1234' => [
        'Auto' => [
            'marca' => 'Honda',
            'modelo' => 2020,
            'tipo' => 'camioneta',
        ],
        'Propietario' => [
            'nombre' => 'Alfonzo Esparza',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'C.U., Jardines de San Manuel',
        ]
    ],
    'DEF5678' => [
        'Auto' => [
            'marca' => 'Mazda',
            'modelo' => 2019,
            'tipo' => 'sedan',
        ],
        'Propietario' => [
            'nombre' => 'Ma. del Consuelo Molina',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => '97 oriente',
        ]
    ],
    'GHI9101' => [
        'Auto' => [
            'marca' => 'Toyota',
            'modelo' => 2021,
            'tipo' => 'hatchback',
        ],
        'Propietario' => [
            'nombre' => 'Carlos García',
            'ciudad' => 'Tlaxcala, Tlax.',
            'direccion' => 'Av. Independencia 45',
        ]
    ],
    // Otros vehículos...
];

// Iniciar el documento XHTML
echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
echo '<html xmlns="http://www.w3.org/1999/xhtml">';
echo '<head><title>Resultados del Parque Vehicular</title></head>';
echo '<body>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['consulta'] === 'matricula' && isset($_POST['matricula'])) {
        // Consulta por matrícula específica
        $matricula = strtoupper($_POST['matricula']); // Convertir a mayúsculas para coincidencia
        if (isset($parqueVehicular[$matricula])) {
            $vehiculo = $parqueVehicular[$matricula];
            echo "<h2>Resultados para la matrícula $matricula:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Propiedad</th><th>Valor</th></tr>";
            echo "<tr><td><strong>Marca</strong></td><td>" . $vehiculo['Auto']['marca'] . "</td></tr>";
            echo "<tr><td><strong>Modelo</strong></td><td>" . $vehiculo['Auto']['modelo'] . "</td></tr>";
            echo "<tr><td><strong>Tipo</strong></td><td>" . $vehiculo['Auto']['tipo'] . "</td></tr>";
            echo "<tr><td><strong>Propietario</strong></td><td>" . $vehiculo['Propietario']['nombre'] . "</td></tr>";
            echo "<tr><td><strong>Ciudad</strong></td><td>" . $vehiculo['Propietario']['ciudad'] . "</td></tr>";
            echo "<tr><td><strong>Dirección</strong></td><td>" . $vehiculo['Propietario']['direccion'] . "</td></tr>";
            echo "</table>";
        } else {
            echo "<p>No se encontró ningún vehículo con la matrícula <strong>$matricula</strong>.</p>";
        }
    } elseif ($_POST['consulta'] === 'todos') {
        // Mostrar todos los vehículos
        echo "<h2>Todos los Vehículos Registrados:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Matrícula</th><th>Marca</th><th>Modelo</th><th>Tipo</th><th>Propietario</th><th>Ciudad</th><th>Dirección</th></tr>";
        foreach ($parqueVehicular as $matricula => $vehiculo) {
            echo "<tr>";
            echo "<td>$matricula</td>";
            echo "<td>" . $vehiculo['Auto']['marca'] . "</td>";
            echo "<td>" . $vehiculo['Auto']['modelo'] . "</td>";
            echo "<td>" . $vehiculo['Auto']['tipo'] . "</td>";
            echo "<td>" . $vehiculo['Propietario']['nombre'] . "</td>";
            echo "<td>" . $vehiculo['Propietario']['ciudad'] . "</td>";
            echo "<td>" . $vehiculo['Propietario']['direccion'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Por favor, ingrese una matrícula válida o seleccione 'Ver todos los vehículos'.</p>";
    }
} else {
    echo "<p>No se ha recibido ninguna solicitud.</p>";
}

// Cerrar las etiquetas XHTML
echo '</body>';
echo '</html>';
?>
