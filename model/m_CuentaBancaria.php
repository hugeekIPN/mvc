<?php 

require_once('config/database.php');

/**
* 
*/
class m_Cuenta_bancaria
{

	private $db = null;

	
	function __construct()
	{
		$this->db = Database::getInstance();
	}


    
	public function getCuenta($idProveedor)
	{		
		$result = $this->db->select(
			"SELECT * FROM cuenta_bancaria WHERE id_proveedor = :id",
			array("id" => $idProveedor)
			);

		if($result)
			return $result[0];
		else
			return null;
	}

	public function nuevoCuenta_bancaria($data){
		return $this->db->insertLastId('cuenta_bancaria',
			array(
				'clabe'			=> $data['clabe'],
				'cuenta'		=> $data['cuenta'],
				'referencia'	=> $data['referencia'],
				'banco'		=> $data['banco'],
				'sucursal'		=> $data['sucursal'],
				'plaza'	=> $data['plaza'],
				'id_proveedor'		=> $data['id_proveedor']
				));
	}

	public function updateCuenta($data, $idProveedor)
		{
			return $this->db->update(
				"cuenta_bancaria", $data,
				"id_proveedor = :id",
				array("id" => $idProveedor)
				);
		}
	
}