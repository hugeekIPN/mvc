<?php
require_once("config/database.php");

class m_referencia_apoyo{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un referencia_apoyo por id
    * @param id_referencia_apoyo - El id del referencia_apoyo
    * @return Los datos del referencia_apoyo en caso de éxito, null en caso contrario
    **/
    public function getReferencia_apoyo($id_referencia,$id_apoyo) 
    {
        $result = $this->db->select(
                    "SELECT * FROM referencias_apoyos WHERE id_referencia = :idRef and idApoyo = ",
                    array ("idRef" => $id_referencia_apoyo,
                            "idApoyo" => $
                    )
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo referencia_apoyo
    * @param Arreglo con los datos del referencia_apoyo
    * @return true si logra guardar los datos
    **/
    public function nuevoreferencia_apoyo($data)
    {             
        $this->db->insert('referencia_apoyos',  array (
            'descripcion'    => $data['descripcion'],
            'estado'         => $data['estado']      
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un referencia_apoyo
    * @param Arreglo con los datos a actualizar
    * @param id_referencia_apoyo - El id del referencia_apoyo 
    * @return true si logra actualizar
    **/
    public function updatereferencia_apoyo($updateData, $id_referencia_apoyo)
    {    
        $this->db->update("referencia_apoyos", 
                    $updateData, 
                    "id_referencia_apoyo = :id",
                    array( "id" => $id_referencia_apoyo )
               );

        return true;
    }

    /**
    * Elimina a un referencia_apoyo
    * @param id_referencia_apoyo - el id del referencia_apoyo a eliminar
    * @return true si logra insertarlo
    **/
    public function deletereferencia_apoyo($id_referencia_apoyo)  /// update Estado = eliminado
    {    
        $this->db->delete("referencia_apoyos", "id_referencia_apoyo = :id", array( "id" => $id_referencia_apoyo ));        
        
        return true;
    }

    /**
    * Obtiene todos los referencia_apoyos de la base de datos
    **/
    public function getAllreferencia_apoyos(){
        $query = "SELECT * from referencia_apoyos ORDER BY id_referencia_apoyo DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return null;
    }
}

?>
