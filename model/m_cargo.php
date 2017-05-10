<?php
require_once ('config/database.php');

class m_cargo {
    private $db = null;
    
    public function __construct() {
        $this ->db=Database::getInstance();
    }
    
    public function nuevoCargo($data){
        $data['saldo']++;  // id saldo nuevo
        
        $this->db->insert('cargo',array(
            'mes_contable'       => $data['mesContable'],
           // 'referencia'        => $data['referencia'],
            'fecha_docto_salida'   => $data['fecha_docSalida'],
            'docto_salida'         => $data['docSalida'],
            'concepto'          => $data['concepto'],
            'cargo'             => $data['cargo'],
            'id_saldo'             => $data['saldo']
        ));
        
        return true;
    }
    
    public function getCargo($idCargo)
    {
        $result = $this->db->select(
                "SELECT * FROM cargo WHERE id_cargo = :id",
                array("id" => $idCargo));
        if ( count($result) > 0 )
            return $result[0];
        else
            return array();
        
        
                $result = array();
        $query = "SELECT programas_id_programa as id_programa, p.saldo as saldo, s.id_subprograma,  s.nombre, s.descripcion, s.fecha_creacion, s.ultima_modificacion 
            FROM gasto AS s            
            INNER JOIN saldo as p on s.programas_id_programa=p.id_programa
            WHERE s.id_subprograma = :id";

        $select = $this->db->select($query,
                    array ("id" => $id_subprograma)
                  );

        if ($select)
            $result = $select[0];

        return $result;
        
    }
    
    public function getAllCargos(){
        $query  = "SELECT * FROM cargo";
        $result = $this->db->select($query,array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }
    
    public function updateCargo($updateData,$idCargo) {
        $this->db->update("cargo", 
                    $updateData, 
                    "idcargo = :id",
                    array( "id" => $idCargo)
               );
        return true;
    }
    
    public function deleteCargo($idCargo) {
         return $this->db->delete("cargo","idcargo = :id", array("id" => $idCargo));
    }
}
