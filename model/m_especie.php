<?php
require_once("config/database.php");

class m_especie{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un especie por id
    * @param id_especie - El id del especie
    * @return Los datos del especie en caso de éxito, null en caso contrario
    **/
    public function getEspecie($id_especie) 
    {
        $result = $this->db->select(
                    "SELECT * FROM especies WHERE id_especie = :id",
                    array ("id" => $id_especie)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo especie
    * @param Arreglo con los datos del especie
    * @return true si logra guardar los datos
    **/
    public function nuevoEspecie($data)
    {             
        $this->db->insert('especies',  array (
            'descripcion'    => $data['descripcion'],
            //'estado'         => $data['estado'],
            'fecha_creacion' => date("Y-m-d H:i:s"),
            'ultima_modificacion' => date("Y-m-d H:i:s")    
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un especie
    * @param Arreglo con los datos a actualizar
    * @param id_especie - El id del especie 
    * @return true si logra actualizar
    **/
    public function updateEspecie($updateData, $id_especie)
    {    
        $this->db->update("especies", 
                    $updateData, 
                    "id_especie = :id",
                    array( "id" => $id_especie )
               );

        return true;
    }

    /**
    * Elimina a un especie
    * @param id_especie - el id del especie a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteEspecie($id_especie)  /// update Estado = eliminado
    {    
        return $this->db->delete("especies", "id_especie = :id", array( "id" => $id_especie ));          
    }

    /**
    * Obtiene todos los especies de la base de datos
    **/
    public function getAllEspecies(){
        $query = "SELECT * from especies ORDER BY id_especie DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }
}

?>
