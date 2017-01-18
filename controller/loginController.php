<?php
include_once("sessionController.php");
include_once("model/m_login.php");

	class LoginController {

		public $model;
		
		public function __construct() {  
	        $this->model = new m_login();
	    } 
		
		public function index()
		{			
			if( $this->_isLoggedIn() ):
							
				$usuario = sessionController::get("username");											

				require_once("views/templates/header.php");
				require_once("views/dashboard.php");
			    require_once("views/templates/footer.php");		

			else:
				require_once("views/login.php");
			endif;
		}


		public function login($username, $password)
		{			

			$errors = $this->_validateLoginFields($username, $password);
	        if(count($errors) != 0) {
	            $result = implode("<br />", $errors);
	            echo json_encode(array(
	                'status' => 'error',
	                'message' => $result
	            ));
	        }

	        $logged=false;
	        
	        //revisamos credenciales en bd
	        $valida=$this->model->valida($username, $password);
	       	   
	        if(count($valida) == 1) 
	        {	 
		            sessionController::set("usuarioId", $valida[0]['usuarioId']);	            
		            sessionController::set("username", $valida[0]['username']);	            
		            
		            $logged=true;	           
	        }
	        else {	            	            
	             echo json_encode(array(
	                'status' => 'error',
	                'message' => 'Usuario o contraseña incorrectos'
	             ));
	            $logged=false;
	        }

		return $logged;
		}


	private function _validateLoginFields($username, $password)
	 {    
        $errors = array();
        
        if($username == "")
            $errors[] = 'Introduce el Usuario';
        
        if($password == "")
            $errors[] = "El Password es obligatorio";
        
        return $errors;
    }


    public function _isLoggedIn() {
        if(sessionController::get("usuarioId") == null)
        	return false;
                
        return true;        
    }

     public function logout() {
   		sessionController::destroySession();
   		header('Location: '.SCRIPT_URL.'index.php', TRUE, 302);       
    }


	} // fin de clase