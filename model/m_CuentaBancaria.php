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


	
}