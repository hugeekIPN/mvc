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
    * Busca un programa por su nombre
    **/
    public function getProgramaByName($nombre){
        $result = $this->db->select(
            "SELECT * FROM programas WHERE nombre = :nombre",
            array("nombre" => $nombre));

        if($result){
            return $result[0];
        }else{
            return null;
        }
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
            'fecha_creacion' => date("Y-m-d H:i:s"),
            'ultima_modificacion' => date("Y-m-d H:i:s")
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
        return $this->db->delete("programas", "id_programa = :id", array( "id" => $id_programa ));        
        
        
    }

    /**
    * Obtiene todos los programas de la base de datos
    **/
    public function getAllProgramas(){
        $query = "SELECT * from programas";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return null;
    }
}

?>
