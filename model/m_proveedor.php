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
    
    public function getProveedor_razon($razon)
	{		
		$result = $this->db->select(
			"SELECT * FROM proveedores WHERE razon_social = :razon",
			array("razon" => $razon)
			);

		if($result)
			return $result[0];
		else
			return null;
	}

	public function nuevoProveedor($data){
		return $this->db->insertLastId('proveedores',
			array(
				'razon_social'		=> $data['razon_social'],
				'rfc'				=> $data['rfc'],
				'telefono'			=> $data['telefono'],
				'calle'				=> $data['calle'],
				'colonia'			=> $data['colonia'],
				'cp'				=> $data['cp'],
				'delegacion'		=> $data['delegacion'],
				'id_estado'			=> $data['entidad'],
				'tipo'				=> $data['tipo'],
                'contacto'			=> $data['contacto'],
				'correo_contacto'	=> $data['correo_contacto']
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
		return $this->db->delete("proveedores","id_proveedor = :id",
			array("id"=>$idProveedor));
            
	}

	public function getAllProveedores(){
		$query = "SELECT * from proveedores";

		$result = $this->db->select($query, array());

		if($result)
			return $result;
		else
			return array();
	}

	public function getAll($tipo){
		$query = "SELECT * from proveedores where tipo=".$tipo;

		$result = $this->db->select($query, array());

		if($result)
			return $result;
		else
			return array();
	}

}