<?php
require_once __DIR__ . '/../vendor/autoload.php';
// Asegúrate de incluir la clase necesaria
use Marketzone\ProductApp\Read\Search;
//require_once __DIR__ . '/MYAPI/Read/Search.php';

// Crear una instancia de la clase Search (usando los datos de la conexión)
$searchProduct = new Search('marketzone', 'root', 'rS7;A35_nj39L');

// Recibimos el término de búsqueda desde la solicitud GET
$searchTerm = $_GET['search'] ?? '';  // Si no se pasa un término, usar una cadena vacía

// Llamamos al método search() para obtener los productos que coinciden
$response = $searchProduct->search($searchTerm);

// Imprimimos la respuesta en formato JSON
echo $response;
?>
