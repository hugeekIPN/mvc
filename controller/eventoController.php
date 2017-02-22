<?php 

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_evento.php");

/**
* 
*/
class EventoController
{
	private $idEvento;
	public $model;
	
	public function __construct($idEvento)
	{
		$this->idEvento = $idEvento;
		$this->model = new m_evento;
	}

	public function index(){

		$login = new loginController();

		if($login->_isLoggedIn()){
			$usuario = sessionController::get('username');
			$titulo = "Eventos";

			$eventos = $this->model->getAllEventos();
            require_once("views/templates/header.php");
			require_once("views/templates/nav.php");
            require_once("views/eventos.php");// Cual es? 
            require_once("views/templates/footer.php");
		}else{
			require_once("views/login.php");
		}
	}

	public function nuevoEvento($postData){
		$result = array();
		$errors = false; //$this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			$this->model->nuevoEvento($postData);

			$result = array(
				"status" => "success",
				"message" => "Registro exitoso");
		}

		return $result;
	}

	public function getEvento(){
		return $this->model->getEvento($this->idEvento);
	}

	public function updateEvento($data){
		$result = array();
		$errors = false; //$this->validaDatos($postData);

		if($errors){
			$message = implode("<br>", $errors);

			$result = array(
				"status" => "error",
				"message" => $message );
		}else{
			//$currentEvento = $this->model->getEvento($this->idEvento);

			// $newData = array();
            /*
			if($currentEvento['subprogramas_isSubprogramas']!=$data['subprogramas_isSubprogramas'])
				$newData['subprogramas_isSubprogramas']=$data['subprogramas_isSubprogramas'];

			if($currentEvento['fecha'] != $data['fecha'])
				$newData['fecha'] = $data['fecha'];

			if($currentEvento['descripcion'] != $data['descripcion'])
				$newData['descripcion'] = $data['descripcion'];

			if($currentEvento['pais'] != $data['pais'])
				$newData['pais'] = $data['pais'];

            if($currentEvento['ciudad'] != $data['ciudad'])
				$newData['ciudad'] = $data['ciudad'];

            if($currentEvento['entidad'] != $data['entidad'])
				$newData['entidad'] = $data['entidad'];

            if($currentEvento['estado'] != $data['estado'])
				$newData['estado'] = $data['estado'];

           if($currentEvento['fecha_creacion'] != $data['fecha_creacion'])
				$newData['fecha_creacion'] = $data['fecha_creacion'];

            if($currentEvento['ultima_modificacion'] != $data['ultima_modificacion'])
				$newData['ultima_modificacion'] = $data['ultima_modificacion'];
            */
	     
			if($data){
				 $message = $this->model->updateEvento($data, $this->idEvento);
                
                	$result = array(
				"status" => "success",
				"message" => $message);
			}

		
		}

		return $result;
	}


	/**
	* FALTA VALIDAR RELACIONES
	**/
	public function deleteEvento(){
		 $this->model->deleteEvento($this->idEvento);        
        return true;
	}


	/* private function validaDatos($data){
		$errors = array();

		$subprogramas_idsubprogramas  => $data['subprogramas_idsubprogramas'];
		$fecha		=> $data['fecha'];
		$descripcion			=> $data['descripcion'];
		$pais 				=> $data['pais'];
        $ciudad 				=> $data['ciudad'];
        $entidad 				=> $data['entidad'];
        $estado 				=> $data['estado'];
        $fecha_creacion 				=> $data['fecha_creacion'];
        $ultima_modificacion 				=> $data['ultima_modificacion'];
		

		if ($this->esVacio($subprogramas_idsubprogramas)) {
			$errors[] = "Descripción no puede ser vacío";
		}
        if ($this->esVacio($fecha)) {
			$errors[] = "fecha no puede ser vacío";
		}
        if ($this->esVacio($descripcion)) {
			$errors[] = "Descripción no puede ser vacío";
		}
        if ($this->esVacio($ciudad)) {
			$errors[] = "Ciudad no puede ser vacío";
		}
        if ($this->esVacio($entidad)) {
			$errors[] = "Entidad no puede ser vacío";
		}
        if ($this->esVacio($estado)) {
			$errors[] = "Estado no puede ser vacío";
		}
        if ($this->esVacio($fecha_creacion)) {
			$errors[] = "Fecha de cración no puede ser vacío";
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
		// return $errors; }


	}




	/**
	* Verifica si un arreglo o un string es vacio
	
	private function esVacio($in){
        if(is_array($in))
            return empty($in);
        elseif ($in == '')
            return true;
        else 
            return false;        
	}**/
