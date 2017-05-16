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
            $saldo = $saldo? $saldo['saldo'] : 0;
            
            require_once("views/templates/header.php");

            require_once("views/templates/nav.php");
            require_once("views/cargo.php");
            require_once("views/templates/footer.php");
        } else {
            require_once("views/login.php");
        }
    }

    public function nuevoCargo($postData) {
        $result = array();
        $errors = $this->validaDatos($postData);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {

            $idSaldo = $this->realizarCargo($postData['cargo']);
            $postData['saldo'] = $idSaldo;

            $this->model->nuevoCargo($postData);

            $result = array(
                "status" => "success",
                "message" => "Registros exitosos");
        }
        
        return $result;
    }

    private function realizarCargo($cargo = 0){
        $saldo = $this->modelSaldo->getUltimoSaldo();
        $saldo = $saldo? $saldo['saldo'] : 0;
        $nuevoSaldo = $saldo + $cargo;
        $idNuevoSaldo = $this->modelSaldo->nuevoSaldo($nuevoSaldo);

        return $idNuevoSaldo;
    }
    
    public function getCargo() {
        $result = $this->model->getCargo($this->idCargo);
        $fechaDoc = $result['fecha_docto_salida'];
        $result['fecha_docto_salida'] = date('d-m-Y',strtotime($fechaDoc));
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
     $erros = $this->validaDatos($data);
     
     if ($erros) {
         $message = implode("<br>", $erros);
         $result = array(
             "status" => "error",
             "message"=> $message);
     } else {
         
         $currentcargo = $this->model->getCargo($this->idCargo);
         $newData = array();
         
         if ($currentcargo['mes_contable'] != $data['mesContable']) {
             $newData['mes_contable'] = $data['mesContable'];
         }
         $newData['fecha_docto_salida'] = $data['fecha_docSalida'];
         $newData['docto_salida'] = $data['docSalida'];
         $newData['concepto'] = $data['concepto'];
         $newData['cargo'] = $data['cargo'];
         $newData['id_saldo'] = $currentcargo['id_saldo'];

         /* Actualiza saldo */
         $saldo = $this->modelSaldo->getUltimoSaldo();
         $saldo = $saldo? $saldo['saldo'] : 0;
         $NewSaldo = ( $saldo - $currentcargo['cargo']) + $data['cargo'];
         /* Actualiza saldo */
         
         /* Actualiza saldo CAPTURADO */ 
         $saldoArray = array(); 
         $saldoArray['saldo'] = ( $currentcargo['saldo'] - $currentcargo['cargo']) + $data['cargo'];
         /* Actualiza saldo CAPTURADO */

         if($newData){

             $update= $this->model->updateCargo($newData, $this->idCargo);
	          

            if($update){
                 $this->model->update_Saldo($saldoArray, $currentcargo['id_saldo']);
                 $this->modelSaldo->nuevoSaldo($NewSaldo);
                $result = array(
                    "status" => "success",
                    "message" => "Registro actualizado");

                 }else{
                    $result = array(
                    "status" => "error");
                }
            }
        }
         return $result;
    }

    public function deleteCargo(){
        $result = array();
        
        $saldo = $this->modelSaldo->getUltimoSaldo();
        $saldo = $saldo? $saldo['saldo'] : 0;
        
        $currentcargo = $this->model->getCargo($this->idCargo);
        $NewSaldo =   $saldo - $currentcargo['cargo'];
        $idSaldo_cargo = $currentcargo['id_saldo'];
        
        if ($this->model->deleteCargo($this->idCargo)) {
            $this->modelSaldo->deleteSaldo($idSaldo_cargo);
                $this->modelSaldo->nuevoSaldo($NewSaldo);  // Actualizamos saldo --nuevo registro
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
		$mesContable		= $data['mesContable'];
		$fecha_docSalida 		= $data['fecha_docSalida'];
        $docSalida = $data['docSalida'];
        $concepto = $data['concepto'];
        $cargo = $data['cargo'];
    
		if ($this->esVacio($mesContable)) {
			$errors[] = "Mes Contable no puede ser vacío";
		}       
        
            
        if ($this->esVacio($fecha_docSalida) ) {
			$errors[] = "Fecha documento de salida, no puede ser vacía";
		}  
        
        if ($this->esVacio($docSalida) ) {
			$errors[] = "Documento de salida, no puede ser vacío";
		} 
        
        if ($this->esVacio($concepto) ) {
			$errors[] = "El concepto no puede ser vacío";
		} 
        
        if ($this->esVacio($cargo) ) {
			$errors[] = "El cargo no puede ser vacío";
		}
        
        
		return $errors;

	}

    /**
    * funcion para testear al estilo Isma
    **/
    public function test(){
        return $this->model->getCargo(2);
    }
    
    private function esVacio($in)
    {
        if (is_array($in)) {
            return empty($in);
        } elseif ($in == '') {
            return true;
        } else {
            return false;
        }

    }
	
}


