<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_Subrograma.php");

/**
* 
*/
class subSubrogramaController
{
	private $idSubrograma;
	public $model;
	
	public function __construct($idSubrograma)
	{
		$this->idSubrograma = $idSubrograma;
		$this->model = new m_Subrograma;
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');

			$subSubrogramas = $this->model->getAllSubSubrogramas();

			require_once("views/templates/header.php");

			require_once("views/templates/nav.php");
            require_once("views/subSubrogramas.php");// Cual es?
            require_once("views/templates/footer.php");
		}else{
			require_once("views/login.php");
		}
	}

	public function nuevoSubrograma($postData){
		$result = array();
		$errors = $this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$this->model->nuevoSubrograma($postData);

			$result = array(
				"status" => "success",
				"message" => "Registro exitoso");
		}

		return $result;
	}

	public function getSubrograma(){
		return $this->model->getSubrograma($this->idSubrograma);
	}

	public function updateSubrograma($data){
		$result = array();
		$errors = $this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$currentSubrograma = $this->model->getSubrograma($this->idSubrograma);

			$newData = array();


            if($currentSubrograma['programas_id_programa']!=$data['programas_id_programa'])
				$newData['programas_id_programa']=$data['programas_id_programa'];

            if($currentSubrograma['nombre']!=$data['nombre'])
				$newData['nombre']=$data['nombre'];

			if($currentSubrograma['descripcion']!=$data['descripcion'])
				$newData['descripcion']=$data['descripcion'];

			if($currentSubrograma['estado'] != $data['estado'])
				$newData['estado'] = $data['estado'];

			if($currentSubrograma['fecha_creacion'] != $data['fecha_creacion'])
				$newData['fecha_creacion'] = $data['fecha_creacion'];

			if($currentSubrograma['ultima_modificacion'] != $data['ultima_modificacion'])
				$newData['ultima_modificacion'] = $data['ultima_modificacion'];

	     
			if($newData){
				$this->model->updateSubrograma($newData, $this->idSubrograma);
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
	public function deleteSubrograma(){
		 $this->model->deleteSubrograma($this->idSubrograma);        
        return true;
	}


	private function validaDatos($data){
		$errors = array();
        $programas_id_programa => $data['programas_id_programa']
        $nombe		=> $data['nombre'];
		$descripcion		=> $data['descripcion'];
		$estado		=> $data['estado'];
		$fecha_creacion			=> $data['fecha_creacion'];
		$utima_modificacion 				=> $data['ultima_modificacion'];
		
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