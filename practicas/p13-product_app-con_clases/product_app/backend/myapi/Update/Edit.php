<?php
namespace Marketzone\ProductApp\Update;

use Marketzone\ProductApp\DataBase;

//require_once __DIR__ . '/../DataBase.php';
//require_once __DIR__ . '/vendor/autoload.php';


class Edit extends DataBase {
    public function edit($jsonOBJ) {
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );

        if( isset($jsonOBJ->id) ) {
            $sql = "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
            $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',";
            $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";

            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->data['status'] = "success";
                $this->data['message'] = "Producto actualizado";
            } else {
                $this->data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }
}
?>
