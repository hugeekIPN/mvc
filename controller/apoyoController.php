<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_apoyo_gasto.php");
include_once "model/m_evento.php";
include_once("model/m_proveedor.php");
include_once("model/m_saldo.php");
include_once("model/m_archivos.php");
include_once("model/m_especie.php");

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
    public $modelArchivo;
    public $modelEspecie;

    public function __construct($idApoyo, $idEvento, $idProveedor) {
        $this->idApoyo = $idApoyo;
        $this->model = new m_apoyo_gasto;
        $this->idEvento = $idEvento;
        $this->modelEvento = new m_evento();
        $this->modelEspecie = new m_especie();
        $this->idProveedor = $idProveedor;
        $this->modelProveedor = new m_proveedor();
        $this->modelSaldo = new m_saldo();
        $this->modelArchivo = new m_archivo();
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

    /**
    * funcion para obtener todos los apoyos.
    * sirve para poblar el datatable mediante ajax, en el ajax se envía como json
    * @return array con todos los apoyos registrados
    **/
    public function getApoyos(){
        /*
        Se obtienen los sig datos del model:
        .id_apoyo
         ,a.tipo
         ,a.estatus
         ,a.concepto
         ,a.importe
         ,a.importe_ext
         ,a.tipo_cambio
         ,a.folio
         ,a.observaciones
         ,a.referencia
         ,a.mes_contable
         ,a.docto_salida
         ,a.poliza
         ,a.fecha_referencia
         ,a.fecha_docto_salida
         ,a.fecha_creacion
         ,a.ultima_modificacion
         ,p.id_proveedor
         ,p.tipo as tipo_proveedor
         ,p.razon_social
        */
        return [ "data" => $this->model->getApoyosForTable() ];
    }


    public function viewPage(){
        $usuario = sessionController::get('username');;
        $titulo = "Apoyos";
          
         $eventos = $this->modelEvento->getAllEventos();
        
         $proveedores = $this->modelProveedor->getAll(1);
         $donatarios = $this->modelProveedor->getAll(2);

         $apoyo =  $this->model->getAllApoyosGastos_type(1);
         $gasto =  $this->model->getAllApoyosGastos_type(2);

         $especies = $this->modelEspecie->getAllEspecies();

         $saldo = $this->modelSaldo->getUltimoSaldo();
         $saldo = $saldo? $saldo['saldo'] : 0;
         
        

            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/apoyos.php"); // Cual es?
            require_once("views/templates/footer.php");
    }


    public function nuevoApoyoGasto($postData) {
        $result = array();
        $errors = $this->validaDatos($postData);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {

            if(!($postData['importe']))          
                $postData['importe'] = 0;
            if(!($postData['id_proveedor']))          
                $postData['id_proveedor'] = 0;
            if(!($postData['id_donatario']))          
                $postData['id_donatario'] = 0;
            

               $saldo = $this->modelSaldo->getUltimoSaldo();
                $saldo = $saldo? $saldo['saldo'] : 0;

                $nuevoSaldo = $saldo - $postData['importe'];  /// ABONO
                $idNuevoSaldo = $this->modelSaldo->nuevoSaldo($nuevoSaldo);
                $postData['id_saldo'] = $idNuevoSaldo;


            $idUltimoApoyo = $this->model->getUltimoApoyo();
            $ultimaRef = $idUltimoApoyo?  $idUltimoApoyo['referencia_anamaria'] : 0;
            $idUltimoApoyo = $idUltimoApoyo? $idUltimoApoyo['id_apoyo'] : 0;
            
            $postData['referencia_anamaria'] = $ultimaRef +1;


            $this->model->nuevoApoyoGasto($postData);

            $result = array(
                "status" => "success",
                "message" => "Registro exitoso");
        }

        return $result;
    }

    public function getApoyoGasto() {
        $archivos = $this->modelArchivo-> getAllArchivos($this->idApoyo);
        $result = $this->model->getApoyoGasto($this->idApoyo);

        if($result){
            $result["status"] = "success";
            $result["archivos"] = $archivos;
        }else{
            $result = array(
                "status" => "error",
                "message" => "No se encontró el apoyo");
        }

        return $result;
    }


    public function getApoyoEventos($data) {
        $result = $this->model-> getApoyoEventos($data['id_evento'], $data['anio']);

        if(!$result){
            $result = array(
                "status" => "error",
                "message" => "No se encontró el evento");
        }
        return $result;
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
            $saldo = $this->modelSaldo->getUltimoSaldo();
            $saldo = $saldo? $saldo['saldo'] : 0;
            $importe = (float) $data['importe'];
            $actualizaSaldo = ($saldo + $currentApoyo['importe']) - $importe;

            $currentSaldo = $this->modelSaldo->getSaldo($currentApoyo['id_saldo']);

            $saldoCapturado= ($currentSaldo['saldo'] + $currentApoyo['importe']) - $importe ;

            $updateDataSaldo = array();
            $updateDataSaldo['saldo'] = $saldoCapturado;


            $newData = array();
           unset($newData['action']);

            
             if (!$this->esVacio($data['estatus']))
                $newData['estatus'] = $data['estatus'];
             if (!$this->esVacio($data['tipo']))
                $newData['tipo'] = $data['tipo'];
             if (!$this->esVacio($data['concepto']))
                $newData['concepto'] = $data['concepto'];
             if (!$this->esVacio($data['importe']))
                $newData['importe'] = $importe;
             if (!$this->esVacio($data['importe_ext']))
                $newData['importe_ext'] = $data['importe_ext'];
            if (!$this->esVacio($data['mes_captura_anamaria']))
                $newData['mes_captura_anamaria'] = $data['mes_captura_anamaria'];
            if (!$this->esVacio($data['fecha_captura_anamaria']))
                $newData['fecha_captura_anamaria'] = $data['fecha_captura_anamaria'];
             if (!$this->esVacio($data['mes_contable_anamaria']))
                $newData['mes_contable_anamaria'] = $data['mes_contable_anamaria'];
             if (!$this->esVacio($data['folio']))
                $newData['folio'] = $data['folio'];
             if (!$this->esVacio($data['frecuencia']))
                $newData['frecuencia'] = $data['frecuencia'];
             if (!$this->esVacio($data['id_especie']))
                $newData['id_especie'] = $data['id_especie'];
             if (!$this->esVacio($data['id_evento']))
                $newData['id_evento'] = $data['id_evento'];
             if (!$this->esVacio($data['id_proveedor']))
                $newData['id_proveedor'] = $data['id_proveedor'];
             if (!$this->esVacio($data['id_donatario']))
                $newData['id_donatario'] = $data['id_donatario'];   
             if (!$this->esVacio($data['tipo_apoyo']))
                $newData['tipo_apoyo'] = $data['tipo_apoyo'];
            if (!$this->esVacio($data['unidad']))
                $newData['unidad'] = $data['unidad'];
            if (!$this->esVacio($data['cantidad']))
                $newData['cantidad'] = $data['cantidad'];
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
            if (!$this->esVacio($data['fecha_recibo']))
                $newData['fecha_recibo'] = $data['fecha_recibo'];
             if (!$this->esVacio($data['observaciones']))
                $newData['observaciones'] = $data['observaciones'];
             if (!$this->esVacio($data['mes_contabel_libretaflujo']))
                $newData['mes_contabel_libretaflujo'] = $data['mes_contabel_libretaflujo'];
             if (!$this->esVacio($data['fecha_docto_salida']))
                $newData['fecha_docto_salida'] = $data['fecha_docto_salida'];
             if (!$this->esVacio($data['docto_salida']))
                $newData['docto_salida'] = $data['docto_salida'];
             if (!$this->esVacio($data['poliza']))
                $newData['poliza'] = $data['poliza'];



            if ($newData) {

                $this->modelSaldo->updateSaldo($updateDataSaldo, $currentApoyo['id_saldo']);
                $this->modelSaldo->nuevoSaldo($actualizaSaldo);

                $this->model->updateApoyoGasto($newData, $this->idApoyo);
            }

            $result = array(
                "status" => "success",
                "message" => "Registro actualizado");
        }

        return $result;
    }

 public function updateImporte_ApoyoGasto($data) {
        $result = array();
        $errors = false;

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
            $currentApoyo = $this->model->getApoyoGasto($this->idApoyo);   
            $saldo = $this->modelSaldo->getUltimoSaldo();
            $saldo = $saldo? $saldo['saldo'] : 0;

            $tipo = (float) $data['tipo_cambio'];

            $newData = array();
            unset($newData['action']);

            $importe =  $tipo * $currentApoyo['importe_ext'];
            $actualizaSaldo = $saldo - $importe;
            $newData['importe'] = $importe;
            $newData['moneda']  = $data['moneda'];
            $newData['tipo_cambio'] = $data['tipo_cambio'];
            $newData['fecha_cambio'] = $data['fecha_cambio'];    

           

            $currentSaldo = $this->modelSaldo->getSaldo($currentApoyo['id_saldo']);

            $updateDataSaldo = array();
            $updateDataSaldo['saldo'] = $actualizaSaldo;


            


            if ($newData) {

                $this->modelSaldo->updateSaldo($updateDataSaldo, $currentApoyo['id_saldo']);
                $this->modelSaldo->nuevoSaldo($actualizaSaldo);

                $this->model->updateApoyoGasto($newData, $this->idApoyo);
            }

            $result = array(
                "status" => "success",
                "importe" => $importe,
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
          $idSaldoCapturado = $currentApoyo['id_saldo']; 
         $this->modelArchivo-> deleteArchivo_Apoyo($this->idApoyo);

        if ($this->model->deleteApoyoGasto($this->idApoyo)) {

                $this->modelSaldo->nuevoSaldo($actualizaSaldo);
                $this->modelSaldo->deleteSaldo($idSaldoCapturado);

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

        $importe = $data['importe'];
        $concepto = $data['concepto'];
        $proveedor = $data['id_proveedor'];
        $donatario = $data['id_donatario'];
        $evento = $data['id_evento'];

        if ($this->esVacio($concepto)) {
            $errors[] = "Debe ingresar un concepto";
        }


        if ($this->esVacio($donatario) && $this->esVacio($proveedor)) {
            $errors[] = "Debe ingresar un proveedor o un donatario";
        }

        if ($this->esVacio($evento)) {
            $errors[] = "Debe ingresar un evento";
        }

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
