<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_cargo.php");
include_once("model/ReportesModel.php");

class cargoController {
    private $idCargo;
    private $modelSaldo;
    private $model;
    private $reportesModel;

    public function __construct($idCargo) {
        $this->idCargo= $idCargo;
        $this->model = new m_cargo();
        $this->reportesModel = new ReportesModel();
        
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
            
            
            $saldo = $this->reportesModel->getSaldo();
            
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
         
         $currentCargo = $this->model->getCargo($this->idCargo);
         $newData = array();
         
         if ($currentCargo['mesContable'] != $data['mesContable']) {
             $newData['mes_contable'] = $data['mesContable'];
         }
         if($currentCargo['fechaDoctoSalida']!= $data['fechaDoctoSalida'])
            $newData['fecha_docto_salida'] = $data['fechaDoctoSalida'];
        if($currentCargo['doctoSalida']!=$data['doctoSalida'])
            $newData['id_documento_salida'] = $data['doctoSalida'];
         
        if($currentCargo['concepto']!=$data['concepto'])
            $newData['concepto'] = $data['concepto'];

        if($currentCargo['cargo']!= $data)
            $newData['cargo'] = $data['cargo'];         


         if($newData){
            $this->model->updateCargo($newData, $this->idCargo);
            }
            $result = array(
                "status" => "success",
                "message" => "Registro actualizado");

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


