<?php
require_once("config/database.php");

class m_evento{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un evento por id
    * @param id_evento - El id del evento
    * @return Los datos del evento en caso de éxito, null en caso contrario
    **/
    public function getEvento($id_evento) 
    {
        $result = $this->db->select(
                    "SELECT e.id_evento, e.nombre, e.descripcion, e.subprogramas_idsubprogramas, s.nombre as nombre_subprograma
                    FROM eventos as e
                    INNER JOIN subprogramas as s
                    ON e.subprogramas_idsubprogramas=s.id_subprograma
                    WHERE e.id_evento = :id",
                    array ("id" => $id_evento)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return array();
    }

    /**
    * Guarda un nuevo evento
    * @param Arreglo con los datos del evento
    * @return true si logra guardar los datos
    **/
    public function nuevoEvento($data)
    {             
        $this->db->insert('eventos',  array (
            'subprogramas_idsubprogramas'    => $data['subprogramas_idsubprogramas'],
            'nombre'         => $data['nombre'],
            'descripcion'    => $data['descripcion'],
            //'pais'    => $data['pais'],
            //'ciudad'    => $data['ciudad'],
            //'entidad'    => $data['entidad'],
            //'estado'    => $data['estado'],
            //'fecha_inicio'    => $data['fecha_inicio'],
            //'fecha_fin'    => $data['fecha_fin'],
             //'fecha_creacion'    => date("Y-m-d H:i:s "),
             //'fecha_modificacion'    => date("Y-m-d H:i:s")
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un evento
    * @param Arreglo con los datos a actualizar
    * @param id_evento - El id del evento 
    * @return true si logra actualizar
    **/
    public function updateEvento($updateData, $id_evento)
    {    
        return $this->db->update("eventos", 
                    $updateData, 
                    "id_evento = :id",
                    array( "id" => $id_evento )
               );

        
    }

    /**
    * Elimina a un evento
    * @param id_evento - el id del evento a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteEvento($id_evento)  /// update Estado = eliminado
    {    
        $this->db->delete("eventos", "id_evento = :id", array( "id" => $id_evento ));        
        
        return true;
    }

    /**
    * Obtiene todos los eventos de la base de datos
    **/
    public function getAllEventos(){

        $query = "SELECT e.id_evento, e.nombre, e.descripcion, e.subprogramas_idsubprogramas, s.nombre as nombre_subprograma
                    FROM eventos as e
                    INNER JOIN subprogramas as s
                    ON e.subprogramas_idsubprogramas=s.id_subprograma";

        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }
}

?>
