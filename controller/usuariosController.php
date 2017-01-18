<?php
include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_usuarios.php");

class UsuariosController {

	private $userId;
	public $model;
	
	public function __construct($userId) {  
		 $this->userId = $userId;
         $this->model = new m_usuarios();
    } 
	
    
	public function index()
	{
        $login = new loginController();
        if($login->_isLoggedIn()){
            $users = $this->model->getAllUsers();     
            require_once("views/templates/header.php");
            require_once("views/usuarios.php");
            require_once("views/templates/footer.php");
        }else{
            require_once("views/login.php");
        }
	}

    public function nuevoUsuario($postData){
        $result = array();
        $errors = $this->validaDatos($postData);

        if(count($errors) > 0 ){
            $message = implode("<br />", $errors);

            $result = array(
                "status" => "error",
                "message" => $message
            );
        }else{
            $this->model->nuevoUsuario($postData);
            $result = array(
                "status"=> "success",
                "msg" => "Registro exitoso"
            );
        }
        
        return $result;
    }



    public function getUsuario() 
    {
    	return $this->model->getUsuario($this->userId);
	}



    public function updateUsuario($data) 
    {
	 
    }


    public function deleteUsuario() 
    {
    	$this->model->deleteUsuario($this->userId);        
        return true;
    }

    private function validaDatos($data){
        $errors = array();
        $username = $data['username'];
        $password = $data['password'];
        if($this->esVacio($username))
            $errors[] = "Nombre de usuario requerido";
        if($this->esVacio($password))
            $errors[] = "Password es requerido";

        if($data['password']!= $data['password_confirm'])
            $errors[] = "Los password deben ser iguales";

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