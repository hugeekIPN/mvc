<?php 

require_once('config/database.php');

/**
* 
*/
class m_proveedor
{

	private $db = null;

	
	function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function getProveedor($idProveedor)
	{		
		$result = $this->db->select(
			"SELECT * FROM proveedores WHERE id_proveedor = :id",
			array("id" => $idProveedor)
			);

		if($result)
			return $result[0];
		else
			return null;
	}

	public function nuevoProveedor($data){
		$this->db->insert('proveedores',
			array(
				'razon_social'		=> $data['razon_social'],
				'referencia' 		=> $data['referencia'],
				'cuenta' 			=> $data['cuenta'],
				'banco' 			=> $data['banco'],
				'sucursal'			=> $data['sucursal'],
				'plaza'				=> $data['plaza'],
				'rfc'				=> $data['rfc'],
				'telefono'			=> $data['telefono'],
				'calle'				=> $data['calle'],
				'colonia'			=> $data['colonia'],
				'cp'				=> $data['cp'],
				'delegacion'		=> $data['delegacion'],
				'pais'				=> $data['pais'],
				'entidad'			=> $data['entidad'],
				'tipo'				=> $data['tipo'],
				'correo_contacto'	=> $data['correo_contacto'],
				'fecha_creacion'         => $data['fecha_creacion'],
            	'ultima_modificacion'         => $data['ultima_modificacion']  
				));
	}


	public function updateProveedor($data, $idProveedor)
	{
		$this->db->update(
			"proveedores", $data,
			"id_proveedor = :id",
			array("id" => $idProveedor)
			);

		return true;
	}


	public function eliminarProveedor($idProveedor)
	{
		$this->db->delete("proveedores","id_proveedor = :id",
			array("id"=>$idProveedor));

		return true;
	}

	public function getAllProveedores(){
		$query = "SELECT * from proveedores";

		$result = $this->db->select($query, array());

		if($result)
			return $result;
		else
			return null;
	}

}