<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_especie.php");

/**
* 
*/
class EspecieController
{
	private $idEspecie;
	public $model;
	
	public function __construct($idEspecie)
	{
		$this->idEspecie = $idEspecie;
		$this->model = new m_especie;
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');
			$titulo = "Especies";

			$especies = $this->model->getAllEspecies();

			require_once("views/templates/header.php");

			require_once("views/templates/nav.php");
            require_once("views/especie.php");// Cual es?
            require_once("views/templates/footer.php");
		}else{
			require_once("views/login.php");
		}
	}

	public function nuevoEspecie($postData){
		$result = array();
		$errors = false;// $this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$this->model->nuevoEspecie($postData);

			$result = array(
				"status" => "success",
				"message" => "Registro exitoso");
		}

		return $result;
	}

	public function getEspecie(){
		return $this->model->getEspecie($this->idEspecie);
	}

	public function updateEspecie($data){
		$result = array();
		$errors = false; //$this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$currentApoyo = $this->model->getEspecie($this->idEspecie);

			$newData = array();

			if($currentEspecie['descripcion']!=$data['descripcion'])
				$newData['descripcion']=$data['descripcion'];

			if($currentEspecie['estado'] != $data['estado'])
				$newData['estado'] = $data['estado'];

			if($currentEspecie['fecha_creacion'] != $data['fecha_creacion'])
				$newData['fecha_creacion'] = $data['fecha_creacion'];

			if($currentEspecie['ultima_modificacion'] != $data['ultima_modificacion'])
				$newData['ultima_modificacion'] = $data['ultima_modificacion'];

	     
			if($newData){
				$this->model->updateEspecie($newData, $this->idEspecie);
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
	public function deleteEspecie(){
		 $this->model->deleteEspecie($this->idEspecie);        
        return true;
	}


	private function validaDatos($data){
		$errors = array();

		$descripcion		= $data['descripcion'];
		$estado		= "1";
		//$fecha_creacion			= $data['fecha_creacion'];
		//$utima_modificacion = $data['ultima_modificacion'];
		

		if ($this->esVacio($descripcion)) {
			$errors[] = "Descripción no puede ser vacío";
		}
        if ($this->esVacio($estado)) {
			$errors[] = "Estado no puede ser vacío";
		}
        /*
        if ($this->esVacio($fecha_modificacion)) {
			$errors[] = "Fecha de creación no puede ser vacío";
		}
        if ($this->esVacio($ultima_modificacion)) {
			$errors[] = "Ultima modificación no puede ser vacío";
		}
       */
        

		// Las validaciones son en caso de que se proporcionen. Hay que definirlo.
		//if ($rfc && (strlen($rfc) != 12))  {
		//	$errors[] = "Formato de rfc no válido";
		//}

		//if($telefono && !preg_match("/^[0-9]{10}$/", $telefono)){
		//	$errors[] = "Formtao de teléfono no válido";
		//}

		//if($cp && !preg_match("/^[0-9]{5}$/", subject)){
		//	$errors[] = "Formato de cp no válido";
		//}

		//if($tipo && !($tipo == 1 || $tipo == 2)){
		//	$errors[] = "Tipo de proveedor no válido";
		//}

		//if($correo_contacto && !filter_var($correo_contacto, FILTER_VALIDATE_EMAIL)){
		//	$errors[] "Formato de correo de contacto incorrecto";
		//}

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