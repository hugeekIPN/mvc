<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_cargo.php");

class cargoController {
    private $idCargo;
    private $modelSaldo;
    private $model;

    public function __construct($idCargo) {
        $this->idCargo= $idCargo;
        $this->model = new m_cargo();
        
    }

    /**
    ** Carga la pagina de cargos
    **/
    public function index() {

        $login = new loginController();


        if ($login->_isLoggedIn()) {
            $usuario = sessionController::get('username');
            $titulo = "cargos";

            $cargos = $this->model->getAllCargos();
            $doctoSalida = $this->model->getDoctoSalida();
            
            
            $saldo = 0;
            
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

            $this->model->nuevoCargo($postData);

            $result = array(
                "status" => "success",
                "message" => "Registro exitoso");
        }
        
        return $result;
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
         $newData['fecha_docto_salida'] = $data['fechaDoctoSalida'];
         $newData['docto_salida'] = $data['doctoSalida'];
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

    private function validaDatos($data){        
		$errors = array();
		$mesContable		= $data['mesContable'];
		$fechaDoctoSalida 		= $data['fechaDoctoSalida'];
        $doctoSalida = $data['doctoSalida'];
        $concepto = $data['concepto'];
        $cargo = $data['cargo'];
    
		if (!trim($mesContable)) {
			$errors[] = "Mes contable no puede ser vacío";
		}
            
        if (!$this->isValidDate($fechaDoctoSalida) ) {
			$errors[] = "Fecha documento de salida, no puede ser vacía";
		}          
        if ($doctoSalida<5) {
			$errors[] = "Documento de salida no válido";
		}
        
        if (!trim($concepto) ) {
			$errors[] = "El concepto no puede ser vacío";
		}         
        if (!is_numeric($cargo) ) {
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
    
    /**
    * verifica si una fecha es válida,
    * @param String "YYYY-MM-DD" representa una fecha
    **/
    private function isValidDate($date){
        $temp = explode('-',$date);
        return checkdate($temp[1], $temp[2], $temp[1]);
    }

	
}


