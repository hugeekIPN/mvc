<?php
include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_saldo.php");

class saldoController {

	private $saldoId;
	public $model;
	
	public function __construct($saldoId) { 
		 $this->saldoId = $saldoId;
         $this->model = new m_saldo();
    } 
    
    
    
	public function index()
	{
        $login = new loginController();
        if($login->_isLoggedIn()){
            
							
            $usuario = sessionController::get("username");	
            $titulo = "Usuarios";

            $users = $this->model->getAllUsers();     
            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/usuarios.php");
            require_once("views/templates/footer.php");
        }else{
            require_once("views/login.php");
        }
	}
    
 
    
       public function cap_apoyos()
	{
        $login = new loginController();
        if($login->_isLoggedIn()){
            
							
				$usuario = sessionController::get("username");	
            
            
            $users = $this->model->getAllUsers();
            
            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            
            require_once("views/captura-apoyos.php");
           // require_once("views/templates/footer.php");
        }else{
            require_once("views/login.php");
        }
	}
    
    public function nuevoSaldo($postData){
        $result = array();
        $errors =  $this->validaDatos($postData);

        if(count($errors) > 0 ){
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message
            );
            
        }else{
            $this->model->nuevoSaldo($postData);
            $result = array(
                "status"=> "success",
                "message" => "Registro exitoso"
            );
        }
        
        return $result;
    }



    public function getSaldo() 
    {
    	return $this->model->getSaldo($this->saldoId);
	}



    public function updateUsuario($data) 
    {
        $errors = $this->validaDatosUpdate($data);

        if(count ($errors) > 0){
            $message = implode("<br />", $errors);
            $result = array(
                "status" => "error",
                "message" => $message
                );
        }else{
            $currentUser = $this->model->getUsuario($this->userId);
            $newData = array();

            if($currentUser['nombre'] != $data['username'])
                $newData['nombre'] = $data['username'];

            if($currentUser['email'] != $data['email'])
                $newData['email'] = $data['email'];

            if($data['password'])
                if($currentUser['password'] !=
                    $data['password'])
                    $newData['password'] = $data['password'];

            if($newData){
                $this->model->updateUsuario($newData, $this->userId);
            }

            $result = array(
                "status" => "success",
                "message" => "Registro Actualizado"
                );
        }

        return $result;
	 
    }



    public function deleteUsuario() 
    {   
            	        
        if(! $this->model->getUsuario($this->userId))
            return array(
                "status" => "error",
                "message" => "El usuario no existe");

        if($this->userId == sessionController::get("usuarioId")){
            return array(
                "status" => "error",
                "message" => "No se puede eliminar al usuario actual"
                );
        }

        $this->model->deleteUsuario($this->userId);
        return array(
            "status" => "success",
            "message" => "Operaci&oacute;n completada");

    }

    private function validaDatos($data){
        $errors = array();
        $saldo = $data['saldo'];

        if($this->esVacio($saldo))
            $errors[] = "Saldo no puede ser vacío";

        return $errors;

    }

    private function validaDatosUpdate($data){
        
        $errors = array();

     
        return $errors;

    }

    private function esVacio($in){
        if(is_array($in))
            return empty($in);
        elseif ($in == '')
            return true;
        else 
            return false;        
    }

	} // fin de clase