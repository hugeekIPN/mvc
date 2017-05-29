<?php
require_once("config/database.php");

class m_archivo{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un archivo por id
    * @param id_archivo - El id del archivo
    * @return Los datos del archivo en caso de éxito, null en caso contrario
    **/
    public function getArchivo($id_archivo) 
    {
        $result = $this->db->select(
                    "SELECT * FROM archivos WHERE id_archivos = :id",
                    array ("id" => $id_archivo)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo archivo
    * @param Arreglo con los datos del archivo
    * @return true si logra guardar los datos
    **/
    public function nuevoArchivo($data)
    {             
        return 
        $this->db->insert('archivos',  array (
            'id_apoyo_gasto'    => $data['id_apoyo_gasto'],
            'pdf' => $_FILES['archivo_pdf']['name'],
            'xml' => $_FILES['archivo_xml']['name']  
        ));
              
    }

    /**
    * Actualiza los datos de un archivo
    * @param Arreglo con los datos a actualizar
    * @param id_archivo - El id del archivo 
    * @return true si logra actualizar
    **/
    public function updateArchivo($updateData, $id_archivo)
    {    
        $this->db->update("archivos", 
                    $updateData, 
                    "id_archivos = :id",
                    array( "id" => $id_archivo )
               );

        return true;
    }

    /**
    * Elimina a un archivo
    * @param id_archivo - el id del archivo a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteArchivo($id_archivo)  /// update Estado = eliminado
    {    
        return $this->db->delete("archivos", "id_archivos = :id", array( "id" => $id_archivo ));          
    }

    /**
    * Obtiene todos los archivos de la base de datos
    **/

    public function getAllArchivos($idApoyo){
        $query = "SELECT * from archivos WHERE id_apoyo_gasto = :id ";

        $result = $this->db->select($query, array( "id" => $idApoyo ));
        if(count($result)>0)
            return $result;
        else
            return array();
    }


       public function getPDF($nombre) 
    {
        $result = $this->db->select(
                    "SELECT * FROM archivos WHERE pdf = :name",
                    array ("name" => $nombre)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

     public function getXML($nombre) 
    {
        $result = $this->db->select(
                    "SELECT * FROM archivos WHERE xml = :name",
                    array ("name" => $nombre)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }
}

?>
