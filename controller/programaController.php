<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_programa.php");

/**
* 
*/
class programaController
{
	private $idPrograma;
	public $model;
	
	public function __construct($idPrograma)
	{
		$this->idPrograma = $idPrograma;
		$this->model = new m_programa();
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

			$programas = $this->model->getAllProgramas();

			require_once("views/templates/header.php");

			require_once("views/templates/nav.php");
            require_once("views/programas.php");// Cual es?
            require_once("views/templates/footer.php");
		}else{
			require_once("views/login.php");
		}
	}

	public function nuevoPrograma($postData){
		$result = array();
		$errors = $this->validaDatos($postData);
		
		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$this->model->nuevoPrograma($postData);

			$result = array(
				"status" => "success",
				"message" => "Registro exitoso");
		}

		return $result;
	}

	public function getPrograma(){
		$result = $this->model->getPrograma($this->idPrograma);

		if($result){
			$result['status'] = "success";

		}else{
			$result = array(
				"status" => "error",
				"message" => "El id del programa no existe");
		}

		return $result;
	}

	public function updatePrograma($data){
		$result = array();
		$errors = $this->validaDatosUpdate($data);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$currentPrograma = $this->model->getPrograma($this->idPrograma);

			$newData = array();

            if($currentPrograma['nombre']!=$data['nombre'])
				$newData['nombre']=$data['nombre'];

			if($currentPrograma['descripcion']!=$data['descripcion'])
				$newData['descripcion']=$data['descripcion'];
	     
			if($newData){

				$newData['ultima_modificacion'] = date("Y-m-d H:i:s");
 				$this->model->updatePrograma($newData, $this->idPrograma);
			}

			$result = array(
				"status" => "success",
				"message" => "Registro actualizado");
		}

		return $result;
	}

	/**
	* Funcion para validar datos de actualizacion
	**/
	private function validaDatosUpdate($data){
		$nombre = $data['nombre'];
		$descripcion = $data['descripcion'];

		$errors = array();

		$currentPrograma = $this->model->getPrograma($this->idPrograma);

		//validamos que exista el id del usuario
        if(!$currentPrograma){
            $errors[] = "No existe el programa";
            return $errors;
        }

		$anotherPrograma = $this->model->getProgramaByName($nombre);

		//Validamos que el nombre del programa sea único
		if($anotherPrograma && $anotherPrograma['id_programa'] != $this->idPrograma){
			$errors[] = "El nombre ya está registrado";
		}

		if ($this->esVacio($nombre)) {
			$errors[] = "Nombre no puede ser vacío";
		}

		if ($this->esVacio($descripcion)) {
			$errors[] = "Descripción no puede ser vacío";
		}

		return $errors;
	}


	/**
	* FALTA VALIDAR RELACIONES
	**/
	public function deletePrograma(){
		$result = array();
		if($this->model->deletePrograma($this->idPrograma)){
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

        $nombre		= $data['nombre'];
		$descripcion		= $data['descripcion'];

		

        if ($this->esVacio($nombre)) {
			$errors[] = "Nombre no puede ser vacío";
		}

		if($this->model->getProgramaByName($nombre)){
			$errors[] = "El nombre del programa ya esta registrado";
		}

		if ($this->esVacio($descripcion)) {
			$errors[] = "Descripción no puede ser vacío";
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