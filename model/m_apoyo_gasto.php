<?php
require_once("config/database.php");

class m_apoyo_gasto{

    private $db = null;

    public function __construct(){             
        $this->db = Database::getInstance();
    }

    /**
    * Obtiene un apoyo_gasto por id
    * @param id_apoyo - El id del usuario
    * @return Los datos del usuario en caso de éxito, null en caso contrario
    **/
    public function getApoyoGasto($id_apoyo) 
    {
        $result = $this->db->select(
                    "SELECT * FROM apoyos_gastos WHERE id_apoyo = :id",
                    array ("id" => $id_apoyo)
                  );
        if ( count($result) > 0 )
            return $result[0];
        else
            return null;
    }

    /**
    * Guarda un nuevo apoyo_gasto
    * @param Arreglo con los datos del apoyo_gasto
    * @return true si logra guardar los datos
    **/
    public function nuevoApoyoGasto($data)
    {             
        $this->db->insert('usuarios',  array (
            'apoyo_gasto'         => $data['apoyo_gasto'],  
            'especies_id_especie'         => $data['especies_id_especie'], 
            'anio'         => $data['anio'], 
            'folio'         => $data['folio'], 
            'tipo'         => $data['tipo'], 
            'cantidad'         => $data['cantidad'], 
            'unidad'         => $data['unidad'], 
            'pais'         => $data['pais'], 
            'estado'         => $data['estado'], 
            'descripcion'         => $data['descripcion'], 
            'moneda'         => $data['moneda'], 
            'tipo_cambio'         => $data['tipo_cambio'], 
            'fcambio'         => $data['fcambio'], 
            'freferencia'         => $data['freferencia'], 
            'fcaptura'         => $data['fcaptura'], 
            'observaciones'         => $data['observaciones'], 
            'frecuencia'         => $data['frecuencia'], 
            'eventos'         => $data['eventos'], 
            'estado'         => $data['estado']
        ));
        
       return true;       
    }

    /**
    * Actualiza los datos de un apoyo_gasto
    * @param Arreglo con los datos a actualizar
    * @param userId - El id del apoyo_gasto 
    * @return true si logra actualizar
    **/
    public function updateApoyoGasto($updateData, $id_apoyo)
    {    
        $this->db->update("apoyos_gastos", 
                    $updateData, 
                    "id_apoyo = :id",
                    array( "id" => $id_apoyo )
               );

        return true;
    }

    /**
    * Elimina a un apoyo_gasto
    * @param userId - el id del apoyo_gasto a eliminar
    * @return true si logra insertarlo
    **/
    public function deleteApoyoGasto($id_apoyo)  /// update Estado = eliminado
    {    
        $this->db->delete("apoyos_gastos", "id_apoyo = :id", array( "id" => $id_apoyo ));        
        
        return true;
    }

    /**
    * Obtiene todos los apoyos_gastos de la base de datos
    **/
    public function getAllApoyosGastos(){
        $query = "SELECT * from apoyos_gastos ORDER BY id_apoyo DESC";
        $result = $this->db->select($query, array());
        if(count($result)>0)
            return $result;
        else
            return null;
    }
}

?>
