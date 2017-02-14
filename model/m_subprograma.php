<?php
require_once("config/database.php");

class m_subprograma{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un subprograma por id
    * @param id_subprograma - El id del subprograma
    * @return Los datos del subprograma en caso de éxito, null en caso contrario
    **/
    public function getSubprograma($id_subprograma) 
    {
        $result = $this->db->select(
                    "SELECT * FROM subprogramas WHERE id_subprograma = :id",
                    array ("id" => $id_subprograma)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo subprograma
    * @param Arreglo con los datos del subprograma
    * @return true si logra guardar los datos
    **/
    public function nuevoSubprograma($data)
    {             
        $this->db->insert('subprogramas',  array (
            'programas_id_programa'         => $data['programas_id_programa'], 
            'nombre'         => $data['nombre'],  
            'descripcion'    => $data['descripcion'],
            'estado'         => $data['estado'],
            'fecha_creacion'         => $data['fecha_creacion'],
            'ultima_modificacion'         => $data['ultima_modificacion']        
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un subprograma
    * @param Arreglo con los datos a actualizar
    * @param id_subprograma - El id del subprograma 
    * @return true si logra actualizar
    **/
    public function updateSubprograma($updateData, $id_subprograma)
    {    
        $this->db->update("subprogramas", 
                    $updateData, 
                    "id_subprograma = :id",
                    array( "id" => $id_subprograma )
               );

        return true;
    }

    /**
    * Elimina a un subprograma
    * @param id_subprograma - el id del subprograma a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteSubprograma($id_subprograma)  /// update Estado = eliminado
    {    
        $this->db->delete("subprogramas", "id_subprograma = :id", array( "id" => $id_subprograma ));        
        
        return true;
    }

    /**
    * Obtiene todos los subprogramas de la base de datos
    **/
    public function getAllSubprogramas(){
        $query = "SELECT * from subprogramas ORDER BY id_subprograma DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }
}

?>
