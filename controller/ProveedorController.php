<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_proveedor.php");


/**
* 
*/
class ProveedorController
{
	private $idProveedor;
	public $model;
	
	public function __construct($idProveedor)
	{
		$this->idProveedor = $idProveedor;
		$this->model = new m_proveedor();
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');
			$titulo = "Proveedores y Donatarios";

			$proveedores = $this->model->getAllProveedores();

			require_once("views/templates/header.php");

			require_once("views/templates/nav.php");
            require_once("views/proveedores.php");
            require_once("views/templates/footer.php");
		}else{
			require_once("views/login.php");
		}
	}

	public function nuevoProveedor($postData){
		$result = array();
		$errors = $this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$this->model->nuevoProveedor($postData);

			$result = array(
				"status" => "success",
				"message" => "Registro exitoso");
		}

		return $result;
	}

	public function getProveedor(){
		return $this->model->getProveedor($this->idProveedor);
	}

	public function updateProveedor($data){
		$result = array();
		$errors = $this->validaDatos($data);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
            
			$currentProveedor = $this->model->getProveedor($this->idProveedor);

			$newData = array();

			if($currentProveedor['razon_social']!=$data['razon_social'])
				$newData['razon_social']=$data['razon_social'];

			if($currentProveedor['referencia'] != $data['referencia'])
				$newData['referencia'] = $data['referencia'];

			if($currentProveedor['cuenta'] != $data['cuenta'])
				$newData['cuenta'] = $data['cuenta'];

			if($currentProveedor['banco'] != $data['banco'])
				$newData['banco'] = $data['banco'];

			if($currentProveedor['sucursal'] != $data['sucursal'])
				$newData['sucursal'] = $data['sucursal'];


			if($currentProveedor['rfc'] != $data['rfc'])
				$newData['rfc'] = $data['rfc'];

			if($currentProveedor['telefono'] != $data['telefono'])
				$newData['telefono'] = $data['telefono'];

			if($currentProveedor['calle'] != $data['calle'])
				$newData['calle'] = $data['calle'];


			if($currentProveedor['cp'] != $data['cp'])
				$newData['cp'] = $data['cp'];

			if($currentProveedor['delegacion'] != $data['delegacion'])
				$newData['delegacion'] = $data['delegacion'];

			if($currentProveedor['pais'] != $data['pais'])
				$newData['pais'] = $data['pais'];

			if($currentProveedor['entidad'] != $data['entidad'])
				$newData['entidad'] = $data['entidad'];


			if($currentProveedor['correo_contacto'] != $data['correo_contacto'])
				$newData['correo_contacto'] = $data['correo_contacto'];
            
            if($currentProveedor['tipo'] != $data['tipo'])
				$newData['tipo'] = $data['tipo'];
            
            if($currentProveedor['plaza'] != $data['plaza'])
				$newData['plaza'] = $data['plaza'];
            
            if($currentProveedor['colonia'] != $data['colonia'])
				$newData['colonia'] = $data['colonia'];

            if($currentProveedor['contacto'] != $data['contacto'])
				$newData['contacto'] = $data['contacto'];
            
			if($newData){
				$this->model->updateProveedor($newData, $this->idProveedor);
			}

			$result = array(
				"status" => "success",
				"message" => "Registro actualizado");
		}

		return $result;
	}


	/**
	* FALTA VALIDAR RELACIONES
	**/
	public function deleteProveedor(){
        $result = array();
        
		if($this->model->eliminarProveedor($this->idProveedor)){
			$result = array(
				"status" => "success",
				"message" => "Registro eliminado");
		}else{
			$result = array(
				"status" => "error",
				"message" => "No se pudo realizar la operación");
		}

		return $result;
	}

	private function validaDatos($data){
		$errors = array();

		$razon_social		= $data['razon_social'];
		$referencia 		= $data['referencia'];
		$cuenta 			= $data['cuenta'];
		$banco 				= $data['banco'];
		$sucursal			= $data['sucursal'];
        $plaza				= $data['plaza'];
		$rfc				= $data['rfc'];
		$telefono			= $data['telefono'];
		$calle				= $data['calle'];
		$colonia			= $data['colonia'];
		$cp					= $data['cp'];
		$delegacion			= $data['delegacion'];
		$pais				= $data['pais'];
		$entidad			= $data['entidad'];
		$tipo				= $data['tipo'];
		$contacto			= $data['contacto'];
		$correo_contacto	= $data['correo_contacto'];

		if ($this->esVacio($razon_social)) {
			$errors[] = "Razon social no puede ser vacío";
		}
        
        if ($this->esVacio($rfc)) {
			$errors[] = "RFC no puede ser vacío";
		}
        
        if ($rfc && (strlen($rfc) <= 11 || strlen($rfc) >=15 ))  {
			$errors[] = "Formato de rfc no válido";
		}
        
		if($telefono && !preg_match("/^[0-9]{10}$/", $telefono)){
			$errors[] = "Formato de teléfono no válido";
		}
        
		if($cp && !preg_match("/^[0-9]{5}$/", $cp)){
			$errors[] = "Formato de cp no válido";
		}
        
        if($tipo && !($tipo == 1 || $tipo == 2)){
			$errors[] = "Tipo de proveedor no válido";
		}
       
        
		if($correo_contacto && !filter_var($correo_contacto, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Formato de correo de contacto incorrecto";
		}
        
        
		return $errors;

	}
	
    /**
	* Verifica si un arreglo o un string es vacio
	**/
    
	private function esVacio($in){
        if(is_array($in))
            return empty($in);
        elseif ($in == '')
            return true;
        else 
            return false;        
	}
}