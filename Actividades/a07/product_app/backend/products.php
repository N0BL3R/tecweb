<?php
include_once 'database.php';

class Producto {
    private $conn;
    private $table = 'productos';

    public function __construct() {
        // Obtener la conexión a la base de datos
        $db = new DB();
        $this->conn = $db->getConnection();
    }

    // Método para obtener todos los productos
    public function getAllProductos() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            return json_encode($productos);
        } else {
            return json_encode(['mensaje' => 'No hay productos']);
        }
    }

    // Método para agregar un nuevo producto
    public function addProducto($nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        if (empty($imagen)) {
            return json_encode(['mensaje' => 'Imagen no válida']);
        }

        $query = "INSERT INTO " . $this->table . " (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            return json_encode(['mensaje' => 'Error al preparar la consulta: ' . $this->conn->error]);
        }

        $stmt->bind_param("sssssis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
        
        if ($stmt->execute()) {
            return json_encode(['mensaje' => 'Producto agregado correctamente']);
        } else {
            return json_encode(['mensaje' => 'Error al agregar producto: ' . $stmt->error]);
        }
    }

    // Método para eliminar un producto
    public function deleteProducto($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return json_encode(['mensaje' => 'Producto eliminado correctamente']);
        } else {
            return json_encode(['mensaje' => 'Error al eliminar producto']);
        }
    }

    // Método para editar un producto
    public function updateProducto($id, $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen) {
        // Si la imagen está vacía, se asume que no se debe actualizar
        if (empty($imagen)) {
            return json_encode(['mensaje' => 'Imagen no válida']);
        }
    
        // Consulta SQL para actualizar el producto
        $query = "UPDATE " . $this->table . " 
                  SET nombre = ?, marca = ?, modelo = ?, precio = ?, detalles = ?, unidades = ?, imagen = ? 
                  WHERE id = ? AND eliminado = 0";
    
        $stmt = $this->conn->prepare($query);
    
        if ($stmt === false) {
            return json_encode(['mensaje' => 'Error al preparar la consulta: ' . $this->conn->error]);
        }
    
        // Vinculamos los parámetros con los valores
        $stmt->bind_param("ssssssii", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen, $id);
    
        // Ejecutamos la consulta
        if ($stmt->execute()) {
            return json_encode(['mensaje' => 'Producto actualizado correctamente']);
        } else {
            return json_encode(['mensaje' => 'Error al actualizar producto: ' . $stmt->error]);
        }
    }
    
    
    

    // Método para buscar productos
    public function searchProductos($searchTerm) {
        $query = "SELECT * FROM " . $this->table . " WHERE nombre LIKE ? OR marca LIKE ? OR modelo LIKE ?";
        $stmt = $this->conn->prepare($query);
        $searchTermWithWildcard = "%" . $searchTerm . "%";
        $stmt->bind_param("sss", $searchTermWithWildcard, $searchTermWithWildcard, $searchTermWithWildcard);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            return json_encode($productos);
        } else {
            return json_encode(['mensaje' => 'No se encontraron productos']);
        }
    }
}
?>
