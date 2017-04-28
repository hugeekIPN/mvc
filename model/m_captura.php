<?php
require_once ('config/database.php');

class m_captura {
    private $db = null;
    
    public function __construct() {
        $this ->db=Database::getInstance();
    }
    
    public function nuevaCaptura($data){
        $this->db->Insert('captura',array(
            'mesContable'       => $data['mesContable'],
            'referencia'        => $data['referencia'],
            'fecha_docSalida'   => $data['fecha_docSalida'],
            'docSalida'         => $data['docSalida'],
            'concepto'          => $data['concepto'],
            'cargo'             => $data['cargo'],
            'saldo'             => $data['saldo'],
            'fecha_creacion'    => date("Y-m-d H:i:s"), 
            'ultima_modi'       => date("Y-m-d H:i:s")
        ));
        return true;
    }
    
    public function getCaptura($idCaptura)
    {
        $result = $this->db->select(
                "SELECT * FROM captura WHERE idCaptura = :id",
                array("id" => $idCaptura));
        if ( count($result) > 0 )
            return $result[0];
        else
            return array();
    }
    
    public function getAllCapturas(){
        $query  = "SELECT * FROM captura";
        $result = $this->db->select($query,array());
        if(count($result)>0)
            return $result;
        else
            return array();
    }
    
    public function updateCaptura($updateData,$idCaptura) {
        $this->db->update("captura", 
                    $updateData, 
                    "idCaptura = :id",
                    array( "id" => $idCaptura)
               );
        return true;
    }
    
    public function deleteCaptura($idCaptura) {
         return $this->db->delete("captura","idCaptura = :id", array("id" => $idCaptura));
    }
}
