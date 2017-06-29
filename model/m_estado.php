<?php 

require_once('config/database.php');

//
class m_estado
{

	private $db = null;
	
	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function getEstado($idEstado)
	{		
		$result = $this->db->select(
			"SELECT * FROM estadoes as p INNER JOIN cuenta_bancaria as c ON c.id_estado = p.id_estado   WHERE p.id_estado = :id",
			array("id" => $idestado)
			);

		if($result)
			return $result[0];
		else
			return null;
	}

	public function nuevoEstado($data){
		return $this->db->insertLastId('estado',
			array(
				'nombre'		=> $data['nombre'],
				'id_pais'				=> $data['id_pais'],
				));
	}

	public function getAll($nombre){
		$query = "SELECT * from estado where nombre=".$nombre;

		$result = $this->db->select($query, array());

		if($result)
			return $result;
		else
			return null;
	}

}