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
            require_once("views/especie.php"); 
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
        $result = array();
        
		if($this->model->deleteEspecie($this->idEspecie)){
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