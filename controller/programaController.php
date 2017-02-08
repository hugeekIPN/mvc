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
		return $this->model->getPrograma($this->idPrograma);
	}

	public function updatePrograma($data){
		$result = array();
		$errors = $this->validaDatos($postData);

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

			if($currentPrograma['estado'] != $data['estado'])
				$newData['estado'] = $data['estado'];

			if($currentPrograma['fecha_creacion'] != $data['fecha_creacion'])
				$newData['fecha_creacion'] = $data['fecha_creacion'];

			if($currentPrograma['ultima_modificacion'] != $data['ultima_modificacion'])
				$newData['ultima_modificacion'] = $data['ultima_modificacion'];

	     
			if($newData){
				$this->model->updatePrograma($newData, $this->idPrograma);
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
	public function deletePrograma(){
		 $this->model->deletePrograma($this->idPrograma);        
        return true;
	}


	private function validaDatos($data){
		$errors = array();

        $nombre		= $data['nombre'];
		$descripcion		= $data['descripcion'];

		

        if ($this->esVacio($nombre)) {
			$errors[] = "Nombre no puede ser vacío";
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