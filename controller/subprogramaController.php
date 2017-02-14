<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_subprograma.php");

/**
* 
*/
class subprogramaController
{
	private $idSubprograma;
	public $model;
	
	public function __construct($idSubprograma)
	{
		$this->idSubprograma = $idSubprograma;
		$this->model = new m_subprograma();
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

			$subprogramas = $this->model->getAllSubprogramas();
			
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
			$this->model->nuevoSubprograma($postData);

			$result = array(
				"status" => "success",
				"message" => "Registro exitoso");
		}

		return $result;
	}

	public function getSubprograma(){
		return $this->model->getSubprograma($this->idSubprograma);
	}

	public function updateSubprograma($data){
		$result = array();
		$errors = $this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$currentSubprograma = $this->model->getSubprograma($this->idSubprograma);

			$newData = array();


            if($currentSubprograma['programas_id_programa']!=$data['programas_id_programa'])
				$newData['programas_id_programa']=$data['programas_id_programa'];

            if($currentSubprograma['nombre']!=$data['nombre'])
				$newData['nombre']=$data['nombre'];

			if($currentSubprograma['descripcion']!=$data['descripcion'])
				$newData['descripcion']=$data['descripcion'];

			if($currentSubprograma['estado'] != $data['estado'])
				$newData['estado'] = $data['estado'];

			if($currentSubprograma['fecha_creacion'] != $data['fecha_creacion'])
				$newData['fecha_creacion'] = $data['fecha_creacion'];

			if($currentSubprograma['ultima_modificacion'] != $data['ultima_modificacion'])
				$newData['ultima_modificacion'] = $data['ultima_modificacion'];

	     
			if($newData){
				$this->model->updateSubprograma($newData, $this->idSubprograma);
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
	public function deleteSubprograma(){
		 $this->model->deleteSubprograma($this->idSubprograma);        
        return true;
	}


	private function validaDatos($data){
		$errors = array();
        $programas_id_programa = $data['programas_id_programa'];
        $nombe		= $data['nombre'];
		$descripcion		= $data['descripcion'];
		$estado		= $data['estado'];
		$fecha_creacion			= $data['fecha_creacion'];
		$utima_modificacion 				= $data['ultima_modificacion'];
		
        if ($this->esVacio($programas_id_programa)) {
			$errors[] = "id_programa no puede ser vacío";
		}
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