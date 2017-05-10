<?php
require_once("config/database.php");

class m_saldo{

    private $db = null;

    public function __construct(){           
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un usuario por id
    * @param userId - El id del usuario
    * @return Los datos del usuario en caso de éxito, null en caso contrario
    **/
    public function getSaldo($saldoId) 
    {
        $result = $this->db->select(
                    "SELECT * FROM saldo WHERE id_saldo = :id",
                    array ("id" => $saldoId)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo usuario
    * @param Arreglo con los datos del usuario
    * @return true si logra guardar los datos
    **/
    
    public function nuevoSaldo($data)
    {                     
       return $this->db->insert('saldo',  array (
            'saldo'         => $data['saldo']
        ));      
    }

    /**
    * Actualiza los datos de un usuario
    * @param Arreglo con los datos a actualizar
    * @param userId - El id del usuario 
    * @return true si logra actualizar
    **/
    public function updateSaldo($updateData, $saldoId)
    {    
        $this->db->update("saldo", 
                    $updateData, 
                    "id_saldo = :id",
                    array( "id" => $saldoId )
               );

        return true;
    }

    /**
    * Elimina a un usuario
    * @param userId - el id del usuario a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteSaldo($saldoId)  /// update Estado = eliminado
    {    
        
        $this->db->delete("saldo", "id_saldo = :id", array( "id" => $saldoId ));        
        
        return true;
    }

    /**
    * Obtiene todos los usuarios de la base de datos
    **/
    public function getAllSaldos(){
        $query = "SELECT * from saldo ORDER BY id_saldo DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return null;
    }
    
     public function getUltimoSaldo(){
        $query = "SELECT * from saldo order by id_saldo desc limit 1";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return 0;
    }
}

?>
