<?php
require_once("config/database.php");

class m_usuarios{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un usuario por id
    * @param userId - El id del usuario
    * @return Los datos del usuario en caso de éxito, null en caso contrario
    **/
    public function getUsuario($userId) 
    {
        $result = $this->db->select(
                    "SELECT * FROM usuarios WHERE usuarioId = :id",
                    array ("id" => $userId)
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
    public function nuevoUsuario($data)
    {             
        $this->db->insert('usuarios',  array (
            'username'         => $data['username'],  
            'password'       => $data['password']
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un usuario
    * @param Arreglo con los datos a actualizar
    * @param userId - El id del usuario 
    * @return true si logra actualizar
    **/
    public function updateUsuario($updateData, $userId)
    {    
        $this->db->update("usuarios", 
                    $updateData, 
                    "usuarioId = :id",
                    array( "id" => $userId )
               );

        return true;
    }

    /**
    * Elimina a un usuario
    * @param userId - el id del usuario a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteUsuario($userId)
    {    
        $this->db->delete("usuarios", "usuarioId = :id", array( "id" => $userId ));        
        
        return true;
    }
}

?>
