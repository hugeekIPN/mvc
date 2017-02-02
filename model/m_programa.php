<?php
require_once("config/database.php");

class m_programa{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un programa por id
    * @param id_programa - El id del programa
    * @return Los datos del programa en caso de éxito, null en caso contrario
    **/
    public function getPrograma($id_programa) 
    {
        $result = $this->db->select(
                    "SELECT * FROM programas WHERE id_programa = :id",
                    array ("id" => $id_programa)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo programa
    * @param Arreglo con los datos del programa
    * @return true si logra guardar los datos
    **/
    public function nuevoPrograma($data)
    {             
        $this->db->insert('programas',  array (
            'nombre'         => $data['nombre'],  
            'descripcion'    => $data['descripcion'],
            'estado'         => $data['estado'],
            'fecha_creacion'         => $data['fecha_creacion'],
            'ultima_modificacion'         => $data['ultima_modificacion']        
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un programa
    * @param Arreglo con los datos a actualizar
    * @param id_programa - El id del programa 
    * @return true si logra actualizar
    **/
    public function updatePrograma($updateData, $id_programa)
    {    
        $this->db->update("programas", 
                    $updateData, 
                    "id_programa = :id",
                    array( "id" => $id_programa )
               );

        return true;
    }

    /**
    * Elimina a un programa
    * @param id_programa - el id del programa a eliminar
    * @return true si logra insertarlo
    **/
    public function deletePrograma($id_programa)  /// update Estado = eliminado
    {    
        $this->db->delete("programas", "id_programa = :id", array( "id" => $id_programa ));        
        
        return true;
    }

    /**
    * Obtiene todos los programas de la base de datos
    **/
    public function getAllProgramas(){
        $query = "SELECT * from programas ORDER BY id_programa DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return null;
    }
}

?>
