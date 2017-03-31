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
		$errors = $this->validaDatos($postData, "0");

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
		$errors = $this->validaDatos($data, "1");

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

	private function validaDatos($data, $aoe){
        
		$errors = array();
        $id_proveedor		= $data['id_proveedor'];
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
        
        if ($this->esVacio($tipo)) {
			$errors[] = "Debe seleccionar un tipo Proveedor/Donatario.";
		}
        
        
		if ($this->esVacio($razon_social)) {
			$errors[] = "Razón social no puede ser vacío";
		}
        
        $anotherRazon =  $this->model->getProveedor_razon($razon_social);
        
       
            if($anotherRazon && $anotherRazon['id_proveedor'] != $id_proveedor && $aoe == "1"){
                $errors[] = "La razón social que ha ingresado, ya existe.";
            }else{
                if($this->model->getProveedor_razon($razon_social) && $aoe == "0")
                    $errors[] = "La razón social que ha ingresado, ya existe. ";
            }
            
    
        
        if ($this->esVacio($rfc) ) {
			$errors[] = "RFC no puede ser vacío";
		}
        
        if ($rfc && (strlen($rfc) <= 11 || strlen($rfc) >=15 ))  {
			$errors[] = "Formato de RFC no válido";
		}
        
		if($telefono && !preg_match("/^[0-9]{10}$/", $telefono)){
			$errors[] = "Formato de teléfono no válido";
		}
        
		if($cp && !preg_match("/^[0-9]{5}$/", $cp)){
			$errors[] = "Formato de CP no válido";
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
    public function solicitud(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

			$proveedores = $this->model->getAllProveedores();

			require_once("views/solicitud_transferencia.php");
		}else{
			require_once("views/login.php");
		}
	}
    
    public function poliza(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

			$proveedores = $this->model->getAllProveedores();

			require_once("views/poliza_sin_cheque.php");
		}else{
			require_once("views/login.php");
		}
	}
    
    
    public function cuenta(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

			$proveedores = $this->model->getAllProveedores();

			require_once("views/cuenta_por_pagar.php");
		}else{
			require_once("views/login.php");
		}
	}
    
	private function esVacio($in){
        if(is_array($in))
            return empty($in);
        elseif ($in == '')
            return true;
        else 
            return false;        
	}
}