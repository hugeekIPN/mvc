<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_captura.php");

class capturaController {
    private $idCaptura;
    private $model;

    public function __construct($idCaptura) {
        $this->idCaptura= $idCaptura;
	$this->model = new m_captura();
    }

    public function index() {

        $login = new loginController();


        if ($login->_isLoggedIn()) {
            $usuario = sessionController::get('username');
            $titulo = "Capturas";

            $captura = $this->model->getAllCapturas();

            require_once("views/templates/header.php");

            require_once("views/templates/nav.php");
            require_once("views/captura.php");
            require_once("views/templates/footer.php");
        } else {
            require_once("views/login.php");
        }
    }

    public function nuevaCaptura($postData) {
        $result = array();
        $result = true;
        //$result = $this->validaDatos(true);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
            $this->model->nuevaCaptura($postData);

            $result = array(
                "status" => "success",
                "message" => "Registros exitosos");
        }

        return $result;
    }
    
    public function getCaptura() {
        $result = $this->model->getCaptura($this->idCaptura);
        if ($result) {
            $result['status'] = "success";
        } else {
            $result = array(
                "status" => "error",
                "message" => "El id Captura no existe");
        }

        return $result;
    }
    
    public function updateCaptura(){
     $result = array();
     $result = true;
     //$erros = $this->validaDstosUpdate($data);
     
     if ($erros) {
         $message = implode("<br>", $erros);
         $result = array(
             "statua" => "error",
             "message"=> $message);
     } else {
         $currentCaptura = $this->model->getCaptura($this->idCaptura);
         $newData = array();
         if ($currentCaptura['nombre'] != $data['nombre']) {
             $newData['nombre'] = $data['nombre'];
         }
         if($newData){
             $newData['ultima_modi'] = date("Y-m-d H:i:s");
             $this->model->updateCaptura($newData, $this->idCaptura);
	}
        $result = array(
	"status" => "success",
	"message" => "Registro actualizado");
        
         }
         return $result;
    }

    public function deleteCaptura(){
        $result = array();
        if ($this->model->deleteCaptura($this->idCaptura)) {
            $result = array(
                "status" => "success",
                "message"=> "Registros eliminados");
        }else{
            $result = array(
                "status" => "error",
                "message"=> "No se pudo realizar la operación");
        }
        return $result;
    }
}
