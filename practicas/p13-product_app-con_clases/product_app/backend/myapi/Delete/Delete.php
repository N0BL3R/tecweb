<?php
namespace Marketzone\ProductApp\Delete;

use Marketzone\ProductApp\DataBase;

//require_once __DIR__ . '/../DataBase.php';
//require_once __DIR__ . '/vendor/autoload.php';


class Delete extends DataBase {
    public function delete($id) {
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        
        if( isset($id) ) {
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto eliminado";
            } else {
                $this->data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        } 
    }
}
?>
