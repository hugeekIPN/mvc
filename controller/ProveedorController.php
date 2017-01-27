

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
		$this->model = new m_proveedor;
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

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


	private function validaDatos($data){
		$errors = array();

		$razon_social		=> $data['razon_social'];
		$referencia 		=> $data['referencia'];
		$cuenta 			=> $data['cuenta'];
		$banco 				=> $data['banco'];
		$sucursal			=> $data['sucursal'];
		$plaza				=> $data['plaza'];
		$rfc				=> $data['rfc'];
		$telefono			=> $data['telefono'];
		$calle				=> $data['calle'];
		$colonia			=> $data['colonia'];
		$cp					=> $data['cp'];
		$delegacion			=> $data['delegacion'];
		$pais				=> $data['pais'];
		$entidad			=> $data['entidad'];
		$tipo				=> $data['tipo'];
		$contacto			=> $data['contacto'];
		$correo_contacto	=> $data['correo_contacto'];

		if ($this->esVacio($razon_social)) {
			$errors[] = "Razon social no puede ser vacío";
		}

		// Las validaciones son en caso de que se proporcionen. Hay que definirlo.
		if ($rfc && (strlen($rfc) != 12))  {
			$errors[] = "Formato de rfc no válido";
		}

		if($telefono && !preg_match("/^[0-9]{10}$/", $telefono)){
			$errors[] = "Formtao de teléfono no válido";
		}

		if($cp && !preg_match("/^[0-9]{5}$/", subject)){
			$errors[] = "Formato de cp no válido";
		}

		if($tipo && !($tipo == 1 || $tipo == 2)){
			$errors[] = "Tipo de proveedor no válido";
		}

		if($correo_contacto && !filter_var($correo_contacto, FILTER_VALIDATE_EMAIL)){
			$errors[] "Formato de correo de contacto incorrecto";
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