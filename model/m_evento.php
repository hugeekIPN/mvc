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
                    "SELECT * FROM eventos WHERE id_evento = :id",
                    array ("id" => $id_evento)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
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
            'nombre'    => $data['nombre'],
            'descripcion'    => $data['descripcion'],
            'pais'    => $data['pais'],
            'ciudad'    => $data['ciudad'],
            'entidad'    => $data['entidad'],
            'estado'    => $data['estado'],
         //   'fecha_inicio'    => $data['fecha_inicio'],
           // 'fecha_fin'    => $data['fecha_fin'],
            'fecha_creacion'    => $data['fecha_creacion']
          //  'fecha_modificacion'    => $data['fecha_modificacion']
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
        $this->db->update("eventos", 
                    $updateData, 
                    "id_evento = :id",
                    array( "id" => $id_evento )
               );

        return true;
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
        $query = "SELECT * from eventos ORDER BY id_evento DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return null;
    }
}

?>
