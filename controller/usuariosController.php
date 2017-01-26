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
            
							
				$usuario = sessionController::get("username");	
            
            
            $users = $this->model->getAllUsers();     
            require_once("views/templates/header.php");
            require_once("views/usuarios.php");
            require_once("views/templates/footer.php");
        }else{
            require_once("views/login.php");
        }
	}

    public function proveedores()
	{
        $login = new loginController();
        if($login->_isLoggedIn()){
            
							
				$usuario = sessionController::get("username");	
            
            
            $users = $this->model->getAllUsers();
             require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/proveedores.php");
            require_once("views/templates/footer.php");
        }else{
            require_once("views/login.php");
        }
	}
    
       public function especie()
	{
        $login = new loginController();
        if($login->_isLoggedIn()){
            
							
				$usuario = sessionController::get("username");	
            
            
            $users = $this->model->getAllUsers();
            
            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/especie.php");
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
                "message" => "Registro exitoso"
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

            if($currentUser['username'] != $data['username'])
                $newData['username'] = $data['username'];

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

    public function eventos(){
        $login = new loginController();
        if($login->_isLoggedIn()){
            
                            
        $usuario = sessionController::get("username");  
            
            
            $users = $this->model->getAllUsers();

            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/eventos.php");
            require_once("views/templates/footer.php");
        }else{
            require_once("views/login.php");
        }

    }


    public function deleteUsuario() 
    {   
            	        
        if(! $this->model->getUsuario($this->userId))
            return array(
                "status" => "error",
                "message" => "El usuario no existe");

        $this->model->deleteUsuario($this->userId);
        return array(
            "status" => "success",
            "message" => "Operaci&oacute;n completada");

    }

    private function validaDatos($data){
        $errors = array();
        $username = $data['username'];
        $password = $data['password'];
        $password_confirm = $data['password_confirm'];
        if($this->esVacio($username))
            $errors[] = "Nombre de usuario requerido";
        if($this->esVacio($password))
            $errors[] = "Password es requerido";

        if($password != $password_confirm)
            $errors[] = "Los password deben ser iguales";

        return $errors;

    }

    private function validaDatosUpdate($data){
        $id = $data['usuarioId'];
        $username = $data['username'];
        $password = $data['password'];
        $password_confirm = $data['password_confirm'];
        $errors = array();

        //validamos que exista el id del usuario
        if($this->model->getUsuario($this->userId) ==null){
            $errors[] = "No existe el usuario";
            return $errors;
        }

        if($this->esVacio($username))
            $errors[] = "Nombre de usuario requerido";

        if($password != $password_confirm)
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