<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_archivos.php");

/**
* 
*/
class archivoController
{
	private $idArchivo;
	public $model;
	
	public function __construct($idArchivo)
	{
		$this->idArchivo = $idArchivo;
		$this->model = new m_archivo;
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');
			$titulo = "archivos";

			$archivos = $this->model->getAllarchivos();

			require_once("views/templates/header.php");

			require_once("views/templates/nav.php");
            require_once("views/archivo.php"); 
            require_once("views/templates/footer.php");
            
            
		}else{
			require_once("views/login.php");
		}
	}

	public function nuevoArchivo($postData){
		$result = array();
		$errors =  $this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			

			if(($_FILES['archivo_pdf']['tmp_name'])!=""){
				print_r($_FILES);

				$rutaEnServidor='archivos/pdf';
				$rutaTemporal=$_FILES['archivo_pdf']['tmp_name'];
				$nombreImagen=$_FILES['archivo_pdf']['name'];
				$rutaDestino=$rutaEnServidor.'/'.$nombreImagen;
				move_uploaded_file($rutaTemporal, $rutaDestino);
				

				if(($_FILES['archivo_xml']['tmp_name'])!=""){
						print_r($_FILES);

						$rutaEnServidor='archivos/xml';
						$rutaTemporal=$_FILES['archivo_xml']['tmp_name'];
						$nombreImagen=$_FILES['archivo_xml']['name'];
						$rutaDestino=$rutaEnServidor.'/'.$nombreImagen;
						move_uploaded_file($rutaTemporal, $rutaDestino);

				}

				$this->model->nuevoArchivo($postData);
			}

			$result = array(
				"status" => "success",
				"message" => "Registro exitoso");
		}

		return $result;
	}

	public function getarchivo(){
		return $this->model->getarchivo($this->idArchivo);
	}

	public function updatearchivo($data){
		$result = array();
		$errors = false; //$this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$currentApoyo = $this->model->getarchivo($this->idArchivo);

			$newData = array();

			if($currentarchivo['descripcion']!=$data['descripcion'])
				$newData['descripcion']=$data['descripcion'];

			if($currentarchivo['estado'] != $data['estado'])
				$newData['estado'] = $data['estado'];

			if($newData){
				$this->model->updatearchivo($newData, $this->idArchivo);
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
	public function deleteArchivo(){
        $result = array();
        
		if($this->model->deleteArchivo($this->idArchivo)){
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

		$id_apoyo_gasto		= $data['id_apoyo_gasto'];
		

		if ($this->esVacio($id_apoyo_gasto)) {
			$errors[] = "Todo archivo debe estar asociado a un Apoyo o Gasto";
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