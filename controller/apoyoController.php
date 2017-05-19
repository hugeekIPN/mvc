<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_apoyo_gasto.php");
include_once "model/m_evento.php";
include_once("model/m_proveedor.php");
include_once("model/m_saldo.php");

/**
 * 
 */
class ApoyoGastoController {

    private $idApoyo;
    private $idEvento;
    private $idProveedor;
    public $model;
    public $modelEvento;
    public $modelProveedor;
    public $modelSaldo;

    public function __construct($idApoyo, $idEvento, $idProveedor) {
        $this->idApoyo = $idApoyo;
        $this->model = new m_apoyo_gasto;
        $this->idEvento = $idEvento;
        $this->modelEvento = new m_evento();
        $this->idProveedor = $idProveedor;
        $this->modelProveedor = new m_proveedor();
        $this->modelSaldo = new m_saldo();
    }

    public function index() {

        $login = new loginController();

        if ($login->_isLoggedIn()) {
            $usuario = sessionController::get('username');
            $titulo = "Apoyos";
            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/apoyos.php");
            require_once("views/templates/footer.php");
        } else {
            require_once("views/login.php");
        }
    }


    public function viewPage(){
        $usuario = "dummy";
            $titulo = "Apoyos";
          
         $eventos = $this->modelEvento->getAllEventos();
        
         $proveedores = $this->modelProveedor->getAll(1);
         $donatarios = $this->modelProveedor->getAll(2);

         $apoyo =  $this->model->getAllApoyosGastos();

         $saldo = $this->modelSaldo->getUltimoSaldo();
         $saldo = $saldo? $saldo['saldo'] : 0;

            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/apoyos.php"); // Cual es?
            require_once("views/templates/footer.php");
    }

    public function test(){
        $usuario = 'dummy';
        $titulo = "Apoyos";

        $apoyos = array();

        require_once("views/templates/header.php");

        require_once("views/templates/nav.php");
        require_once("views/datepicker.php"); 
        require_once("views/templates/footer.php");        

    }

    public function nuevoApoyoGasto($postData) {
        $result = array();
        $errors = false; //$this->validaDatos($postData);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
            $saldo = $this->modelSaldo->getUltimoSaldo();
            $saldo = $saldo? $saldo['saldo'] : 0;

            $nuevoSaldo = $saldo - $postData['importe'];  /// ABONO

            $idNuevoSaldo = $this->modelSaldo->nuevoSaldo($nuevoSaldo);

            $postData['id_saldo'] = $idNuevoSaldo;

            $this->model->nuevoApoyoGasto($postData);

            $result = array(
                "status" => "success",
                "message" => "Registro exitoso");
        }

        return $result;
    }

    public function getApoyoGasto() {
        return $this->model->getApoyoGasto($this->idApoyo);
    }

    public function updateApoyoGasto($data) {
        $result = array();
        $errors = $this->validaDatos($data);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
            $currentApoyo = $this->model->getApoyoGasto($this->idApoyo);

            $newData = array();


           // if ($currentApoyo['concepto'] != $data['concepto'])
            if (!$this->esVacio($data['id_saldo']))
                $newData['id_saldo'] = $data['id_saldo'];
             if (!$this->esVacio($data['estatus']))
                $newData['estatus'] = $data['estatus'];
             if (!$this->esVacio($data['tipo']))
                $newData['tipo'] = $data['tipo'];
             if (!$this->esVacio($data['concepto']))
                $newData['concepto'] = $data['concepto'];
             if (!$this->esVacio($data['importe']))
                $newData['importe'] = $data['importe'];
             if (!$this->esVacio($data['referencia_anamaria']))
                $newData['referencia_anamaria'] = $data['referencia_anamaria'];
             //if (!$this->esVacio($data['mes_captura_anamaria']))
             //   $newData['mes_captura_anamaria'] = $data['mes_captura_anamaria'];
            // if (!$this->esVacio($data['fecha_captura_anamaria']))
              //  $newData['fecha_captura_anamaria'] = $data['fecha_captura_anamaria'];
             //if (!$this->esVacio($data['mes_contable_anamaria']))
             //   $newData['mes_contable_anamaria'] = $data['mes_contable_anamaria'];
             if (!$this->esVacio($data['folio']))
                $newData['folio'] = $data['folio'];
             if (!$this->esVacio($data['frecuencia']))
                $newData['frecuencia'] = $data['frecuencia'];
             if (!$this->esVacio($data['eventos_id_evento']))
                $newData['eventos_id_evento'] = $data['eventos_id_evento'];
             if (!$this->esVacio($data['id_proveedor']))
                $newData['id_proveedor'] = $data['id_proveedor'];
             if (!$this->esVacio($data['id_donatario']))
                $newData['id_donatario'] = $data['id_donatario'];
             if (!$this->esVacio($data['tipo_apoyo']))
                $newData['tipo_apoyo'] = $data['tipo_apoyo'];
             if (!$this->esVacio($data['pais']))
                $newData['pais'] = $data['pais'];
             if (!$this->esVacio($data['entidad']))
                $newData['entidad'] = $data['entidad'];
             if (!$this->esVacio($data['factura']))
                $newData['factura'] = $data['factura'];
             if (!$this->esVacio($data['moneda']))
                $newData['moneda'] = $data['moneda'];
             if (!$this->esVacio($data['referencia']))
                $newData['referencia'] = $data['referencia'];
             if (!$this->esVacio($data['observaciones']))
                $newData['observaciones'] = $data['observaciones'];
             if (!$this->esVacio($data['descripcion']))
                $newData['descripcion'] = $data['descripcion'];
           //  if (!$this->esVacio($data['mes_contabel_anamaria']))
             //   $newData['mes_contabel_anamaria'] = $data['mes_contabel_anamaria'];
             if (!$this->esVacio($data['fecha_docto_salida']))
                $newData['fecha_docto_salida'] = $data['fecha_docto_salida'];
             if (!$this->esVacio($data['docto_salida']))
                $newData['docto_salida'] = $data['docto_salida'];
             if (!$this->esVacio($data['poliza']))
                $newData['poliza'] = $data['poliza'];


            if ($newData) {
                $this->model->updateApoyoGasto($NewData, $this->idApoyo);
            }

            $result = array(
                "status" => "success",
                "message" => "Registro actualizado");
        }

        return $result;
    }

    /**
     * FALTA VALIDAR RELACIONES
     * */
    public function deleteApoyoGasto() {
        $currentApoyo = $this->model->getApoyoGasto($this->idApoyo);    
        $saldo = $this->modelSaldo->getUltimoSaldo();
            $saldo = $saldo? $saldo['saldo'] : 0;

        $actualizaSaldo = $saldo + $currentApoyo['importe'];
        
          
         $this->modelSaldo->deleteSaldo($currentApoyo['id_saldo']);

        if ($this->model->deleteApoyoGasto($this->idApoyo)) {

                $this->modelSaldo->nuevoSaldo($actualizaSaldo);

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

    private function validaDatos($data) {
        $errors = array();
/*
        $folio                  = $data['folio'];
        $tipo                   = $data['tipo'];
        $cantidad               = $data['cantidad'];
        $unidad                 = $data['unidad'];
        $pais                   = $data['pais'];
        $entidad                = $data['entidad'];
        $descripcion            = $data['descripcion'];
        $moneda                 = $data['moneda'];
        $tipo_cambio            = $data['tipo_cambio'];
        $fcambio                = $data['fcambio'];
        $freferencia            = $data['freferencia'];
        $fcaptura               = $data['fcaptura'];
        $observaciones          = $data['observaciones'];
        $eventos_id_evento      = $data['evento_id_evento'];
        $estado                 = $data['estado'];
*/
        $importe = $data['importe'];


        if ($this->esVacio($importe)) {
            $errors[] = "Debe ingresar un importe";
        }


        // Las validaciones son en caso de que se proporcionen. Hay que definirlo.
        //if ($rfc && (strlen($rfc) != 12))  {
        //	$errors[] = "Formato de rfc no válido";
        //}
        //if($telefono && !preg_match("/^[0-9]{10}$/", $telefono)){
        //	$errors[] = "Formtao de teléfono no válido";
        //}
        //if($cp && !preg_match("/^[0-9]{5}$/", subject)){
        //	$errors[] = "Formato de cp no válido";
        //}
        //if($tipo && !($tipo == 1 || $tipo == 2)){
        //	$errors[] = "Tipo de proveedor no válido";
        //}
        //if($correo_contacto && !filter_var($correo_contacto, FILTER_VALIDATE_EMAIL)){
        //	$errors[] "Formato de correo de contacto incorrecto";
        //}

        return $errors;
    }

    /**
     * Verifica si un arreglo o un string es vacio
     * */
    private function esVacio($in) {
        if (is_array($in))
            return empty($in);
        elseif ($in == '')
            return true;
        else
            return false;
    }

}
