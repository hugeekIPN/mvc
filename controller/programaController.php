<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_programa.php");

/**
* 
*/
class ProgramaController
{
	private $idPrograma;
	public $model;
	
	public function __construct($idPrograma)
	{
		$this->idPrograma = $idPrograma;
		$this->model = new m_Programa;
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

        $nombe		=> $data['nombre'];
		$descripcion		=> $data['descripcion'];
		$estado		=> $data['estado'];
		$fecha_creacion			=> $data['fecha_creacion'];
		$utima_modificacion 				=> $data['ultima_modificacion'];
		

        if ($this->esVacio($nombe)) {
			$errors[] = "Nombre no puede ser vacío";
		}
		if ($this->esVacio($descripcion)) {
			$errors[] = "Descripción no puede ser vacío";
		}
        if ($this->esVacio($estado)) {
			$errors[] = "Estado no puede ser vacío";
		}
        if ($this->esVacio($fecha_modificacion)) {
			$errors[] = "Fecha de creación no puede ser vacío";
		}
        if ($this->esVacio($ultima_modificacion)) {
			$errors[] = "Ultima modificación no puede ser vacío";
		}
       
        

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