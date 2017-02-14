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
        $result = array();
        $query = "SELECT programas_id_programa as id_programa, p.nombre as nombre_programa, s.id_subprograma,  s.nombre, s.descripcion, s.fecha_creacion, s.ultima_modificacion 
            FROM subprogramas AS s            
            INNER JOIN programas as p on s.programas_id_programa=p.id_programa
            WHERE s.id_subprograma = :id
            ORDER BY s.id_subprograma DESC";

        $select = $this->db->select($query,
                    array ("id" => $id_subprograma)
                  );

        if ($select)
            $result = $select[0];

        return $result;
        
    }

    /**
    * Obtiene un subprograma por su nombre
    * @param nombre - El nombre del subprograma
    * @return Los datos del subprograma en caso de éxito, array vacio en caso contrario
    **/
    public function getSubprogramaByName($nombre) 
    {   
        $result = array();
        $query = "SELECT programas_id_programa as id_programa, p.nombre as nombre_programa, s.id_subprograma,  s.nombre, s.descripcion, s.fecha_creacion, s.ultima_modificacion 
            FROM subprogramas AS s            
            INNER JOIN programas as p on s.programas_id_programa=p.id_programa
            WHERE s.nombre = :nombre
            ORDER BY s.id_subprograma DESC";

        $select = $this->db->select($query,
                    array ("nombre" => $nombre)
                  );

        if ($select)
            $result = $select[0];

        return $result;
        
    }

        /**
    * Obtiene todos los subprogramas de la base de datos
    **/
    public function getAllSubprogramas(){
        $query = "SELECT programas_id_programa as id_programa, p.nombre as nombre_programa, s.id_subprograma,  s.nombre, s.descripcion, s.fecha_creacion, s.ultima_modificacion 
            FROM subprogramas AS s
            INNER JOIN programas as p on s.programas_id_programa=p.id_programa
            ORDER BY s.id_subprograma DESC";

        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }

    /**
    * Guarda un nuevo subprograma
    * @param Arreglo con los datos del subprograma
    * @return true si logra guardar los datos
    **/
    public function nuevoSubprograma($data)
    {             
        $result = $this->db->insert('subprogramas',  array (
            'programas_id_programa'         => $data['id_programa'], 
            'nombre'         => $data['nombre'],  
            'descripcion'    => $data['descripcion'],            
            'fecha_creacion' => date("Y-m-d H:i:s"),
            'ultima_modificacion' => date("Y-m-d H:i:s")        
        ));
        
       return $result;       
    }

    /**
    * Actualiza los datos de un subprograma
    * @param Arreglo con los datos a actualizar
    * @param id_subprograma - El id del subprograma 
    * @return true si logra actualizar
    **/
    public function updateSubprograma($updateData, $id_subprograma)
    {    
        $data = $updateData;
        $data['ultima_modificacion'] = date("Y-m-d H:i:s");
        $result = $this->db->update("subprogramas", 
                    $data, 
                    "id_subprograma = :id",
                    array( "id" => $id_subprograma )
               );

        return $result;
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


}

?>
