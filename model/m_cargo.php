<?php
require_once ('config/database.php');

class m_cargo {
    private $db = null;
    
    public function __construct() {
        $this ->db=Database::getInstance();
    }
    
    public function nuevoCargo($data){
               
        $this->db->insert('cargo',array(
            'mes_contable'       => $data['mesContable'],
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
            "SELECT *  
            FROM cargo as c
            INNER JOIN saldo as s ON c.id_saldo = s.id_saldo
            WHERE id_cargo = :id",array("id" => $idCargo));   

        if ( $result )
            return $result[0];
        else
            return array();
        
    }
    
    public function getAllCargos(){
        $query  = "SELECT * FROM cargo as c INNER JOIN saldo as s ON c.id_saldo = s.id_saldo";
        $result = $this->db->select($query,array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }
    
    public function updateCargo($updateData,$idCargo) {
       return $this->db->update("cargo", 
                    $updateData, 
                    "id_cargo = :id",
                    array( "id" => $idCargo)
               );
        
    }
    
    public function deleteCargo($idCargo) {
        
        return $this->db->delete("cargo","id_cargo = :id", array("id" => $idCargo));
         
    }
}
