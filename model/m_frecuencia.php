<?php 

require_once('config/database.php');

/**
* 
*/
class m_frecuencia
{

	private $db = null;

	
	function __construct()
	{
		$this->db = Database::getInstance();
	}


    
	public function getFrecuencia($id=null)
	{	
		$result = [];
		if($id){
			$result = $this->db->select(
			"SELECT * FROM frecuencia_apoyo WHERE id = :id",
			array("id" => $idProveedor)
			);
			if($result) $result = $result[0];
		}else{
			$result = $this->db->select(
			"SELECT * FROM frecuencia_apoyo",
			[]
			);
		}
		return $result;
	}
}