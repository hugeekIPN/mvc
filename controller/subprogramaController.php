<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_subprograma.php");
include_once("model/m_programa.php");


/**
* 
*/
class subprogramaController
{
	private $idSubprograma;
	public $model;
	public $modelPrograma;
	
	public function __construct($idSubprograma)
	{
		$this->idSubprograma = $idSubprograma;
		$this->model = new m_subprograma();
		$this->modelPrograma = new m_programa();
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

			$subprogramas = $this->model->getAllSubprogramas();

			$programas = $this->modelPrograma->getAllProgramas();
			
			require_once("views/templates/header.php");

			require_once("views/templates/nav.php");
            require_once("views/subprogramas.php");
            require_once("views/templates/footer.php");
		}else{
			require_once("views/login.php");
		}
	}

	public function nuevoSubprograma($postData){
		$result = array();
		$errors = $this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{

			if($this->model->nuevoSubprograma($postData)){
				$result = array(
					"status" => "success",
					"message" => "Registro exitoso");
			}else{				
				$result = array(
				"status" => "error",
				"message" => "No se pudieron guardar los datos." );
			}
		}

		return $result;
	}

	/**
	* Obtiene un subprograma dado su, id
	* Obtiene tambien los datos del programa al que pertenece
	**/
	public function getSubprograma(){
		$response = array();
		$result =  $this->model->getSubprograma($this->idSubprograma);

		if($result){
			$result['status'] = 'success';
			$response = $result;
		}else{
			$response = array(
				'status' => 'error',
				'message' => 'No se encontró el subprograma' );
		}

		return $response;
	}

	public function updateSubprograma($data){
		$result = array();
		$errors = $this->validaDatosUpdate($data);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$currentSubprograma = $this->model->getSubprograma($this->idSubprograma);

			$newData = array();

            if($currentSubprograma['id_programa']!=$data['id_programa'])
				$newData['programas_id_programa']=$data['id_programa'];

            if($currentSubprograma['nombre']!=$data['nombre'])
				$newData['nombre']=$data['nombre'];

			if($currentSubprograma['descripcion']!=$data['descripcion'])
				$newData['descripcion']=$data['descripcion'];
	     
			if($newData){
				if($this->model->updateSubprograma($newData, $this->idSubprograma)){
					$result = array(
						"status" => "success",
						"message" => "Registro actualizado");
				}else{
					$result = array(
						"status" => "error",
						"message" => "No se pudo completar la operación");
				}
			}else{
				$result = array(
					"status" => "success",
					"message" => "No hay cambios para actualizar");
			}			
		}

		return $result;
	}


	/**
	* FALTA VALIDAR RELACIONES
	**/
	public function deleteSubprograma(){
		 $this->model->deleteSubprograma($this->idSubprograma);        
        return true;
	}


	private function validaDatos($data){
		$errors = array();
        $programas_id_programa = $data['id_programa'];
        $nombre		= $data['nombre'];
		$descripcion		= $data['descripcion'];	
		
        if ($this->esVacio($programas_id_programa)) {
			$errors[] = "id de programa no puede ser vacío";
		}



        if ($this->esVacio($nombre)) {
			$errors[] = "Nombre no puede ser vacío";
		}else{
			if($this->model->getSubprogramaByName($nombre))
				$errors[] = "El nombre del subprograma ya está registrado";	
		}

		if ($this->esVacio($descripcion)) {
			$errors[] = "Descripción no puede ser vacío";
		}  

		return $errors;
	}

	/**
	* Funcion para validar datos de actualizacion
	**/
	private function validaDatosUpdate($data){		
		$nombre = $data['nombre'];
		$descripcion = $data['descripcion'];
		$errors = array();



		$currentSubprograma = $this->model->getSubprograma($this->idSubprograma);

		//validamos que exista el id del subprograma
        if(!$currentSubprograma){
            $errors[] = "No existe el subprograma";
            return $errors;
        }

        //validamos que exista el id del programa al que pertenece el subprograma
        if(!$this->modelPrograma->getPrograma($data['id_programa'])){
        	$errors[] = "El programa que has seleccionado no está disponible";
        	return $errors;
        }

		$anotherSubprograma = $this->model->getSubprogramaByName($nombre);

		//Validamos que el nombre del programa sea único
		if($anotherSubprograma && $anotherSubprograma['id_subprograma'] != $this->idSubprograma){
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