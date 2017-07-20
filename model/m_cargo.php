<?php
require_once ('config/database.php');

class m_cargo {
    private $db = null;
    
    public function __construct() {
        $this ->db=Database::getInstance();
    }
    
    /**
    ** Agrega un nuevo cargo a la base
    **/
    public function nuevoCargo($data){               
        $this->db->insert('cargo',array(
            'mes_contable'       => $data['mesContable'],
            'fecha_docto_salida'   => $data['fecha_docSalida'],
            'id_documentoto_salida'         => $data['docSalida'],
            'concepto'          => $data['concepto'],
            'cargo'             => $data['cargo'],
        ));        
        return true;
    }   

    /**
    ** Obtiene cargo por id
    **/
    public function getCargo($idCargo)
    {
        $result = $this->db->select(
            "SELECT 
            id_cargo as idCargo
            ,mes_contable as mesContable
            ,date(fecha_docto_salida) as fechaDoctoSalida
            ,date(fecha_creacion) as fechaCaptura
            ,id_documento_salida as doctoSalida
            ,concepto
            ,cargo
            FROM cargo
            WHERE id_cargo = :id",array("id" => $idCargo));   

        if ( $result )
            return $result[0];
        else
            return array();
        
    }
    
    public function getAllCargos(){
        $query  = "SELECT 
            id_cargo as idCargo
            ,mes_contable as mesContable
            ,date(fecha_docto_salida) as fechaDoctoSalida
            ,date(fecha_creacion) as fechaCaptura
            ,id_documento_salida as doctoSalida
            ,concepto
            ,cargo
            FROM cargo";
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
