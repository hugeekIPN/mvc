<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_cargo.php");
include_once("model/m_saldo.php");

class cargoController {
    private $idCargo;
    private $modelSaldo;
    private $model;

    public function __construct($idCargo) {
        $this->idCargo= $idCargo;
        $this->model = new m_cargo();

        $this->modelSaldo = new m_saldo();
        
    }

    public function index() {

        $login = new loginController();


        if ($login->_isLoggedIn()) {
            $usuario = sessionController::get('username');
            $titulo = "cargos";

            $cargo = $this->model->getAllCargos();
            
            
            $saldo = $this->modelSaldo->getUltimoSaldo();
            
            require_once("views/templates/header.php");

            require_once("views/templates/nav.php");
            require_once("views/cargo.php");
            require_once("views/templates/footer.php");
        } else {
            require_once("views/login.php");
        }
    }

    public function nuevaCargo($postData) {
        $result = array();
        $errors = false; // $this->validaDatos($postData);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
            $this->model->nuevoCargo($postData);

            $result = array(
                "status" => "success",
                "message" => "Registros exitosos");
        }
        
        return $result;
    }
    
    public function getCargo() {
        $result = $this->model->getCargo($this->idCargo);
        if ($result) {
            $result['status'] = "success";
        } else {
            $result = array(
                "status" => "error",
                "message" => "El id cargo no existe");
        }

        return $result;
    }
    
    public function updateCargo($data){
     $result = array();
     $result = true;
     $erros = false; //$this->validaDatosUpdate($data);
     
     if ($erros) {
         $message = implode("<br>", $erros);
         $result = array(
             "statua" => "error",
             "message"=> $message);
     } else {
         $currentcargo = $this->model->getCargo($this->idCargo);
         $newData = array();
         
         if ($currentcargo['mesContable'] != $data['mesContable']) {
             $newData['mesContable'] = $data['mesContable'];
         }
         $newData['referencia'] = $data['referencia'];
         $newData['fecha_docSalida'] = $data['fecha_docSalida'];
         $newData['docSalida'] = $data['docSalida'];
         $newData['concepto'] = $data['concepto'];
         $newData['cargo'] = $data['cargo'];
         $newData['saldo'] = $data['saldo'];
         
         if($newData){
             $newData['ultima_modi'] = date("Y-m-d H:i:s");
             
             $this->model->updateCargo($newData, $this->idCargo);
	     } 
        $result = array(
	"status" => "success",
	"message" => "Registro actualizado");
        
         }
         return $result;
    }

    public function deletecargo(){
        $result = array();
        
        if ($this->model->deleteCargo($this->idCargo)) {
            $result = array(
                "status" => "success",
                "message"=> "Registro eliminado");
        }else{
            $result = array(
                "status" => "error",
                "message"=> "No se pudo realizar la operación");
        }
        return $result;
    }
    
    private function validaDatos($data){
        
		$errors = array();
        $idCargo		= $data['idCargo'];
		$mesContable		= $data['mesContable'];
		$referencia 		= $data['referencia'];
    
		if ($this->esVacio($mesContable)) {
			$errors[] = "Mes Contable no puede ser vacío";
		}       
        
            
        if ($this->esVacio($referencia) ) {
			$errors[] = "Referencia no puede ser vacío";
		}        
        
        
		return $errors;

	}

    /**
    * funcion para testear al estilo Isma
    **/
    public function test(){
        return $this->model->getCargo(2);
    }
	
}


