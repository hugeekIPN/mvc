<?php
require_once("config/database.php");

class m_referencia{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un referencia por id
    * @param id_referencia - El id del referencia
    * @return Los datos del referencia en caso de éxito, null en caso contrario
    **/
    public function getreferencia($id_referencia) 
    {
        $result = $this->db->select(
                    "SELECT * FROM referencias WHERE id_referencia = :id",
                    array ("id" => $id_referencia)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo referencia
    * @param Arreglo con los datos del referencia
    * @return true si logra guardar los datos
    **/
    public function nuevoReferencia($data)
    {             
        $this->db->insert('referencias',  array (
            'descripcion'    => $data['descripcion'],
            'estado'         => $data['estado'], 
            'fecha_creacion'         => $data['fecha_creacion'],
            'ultima_modificacion'         => $data['ultima_modificacion']    
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un referencia
    * @param Arreglo con los datos a actualizar
    * @param id_referencia - El id del referencia 
    * @return true si logra actualizar
    **/
    public function updateReferencia($updateData, $id_referencia)
    {    
        $this->db->update("referencias", 
                    $updateData, 
                    "id_referencia = :id",
                    array( "id" => $id_referencia )
               );

        return true;
    }

    /**
    * Elimina a un referencia
    * @param id_referencia - el id del referencia a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteReferencia($id_referencia)  /// update Estado = eliminado
    {    
        $this->db->delete("referencias", "id_referencia = :id", array( "id" => $id_referencia ));        
        
        return true;
    }

    /**
    * Obtiene todos los referencias de la base de datos
    **/
    public function getAllReferencias(){
        $query = "SELECT * from referencias ORDER BY id_referencia DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return null;
    }
}

?>
