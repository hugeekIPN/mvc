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

	} // fin de clase