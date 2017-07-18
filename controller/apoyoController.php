<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_apoyo_gasto.php");
include_once "model/m_evento.php";
include_once("model/m_proveedor.php");
include_once("model/m_especie.php");
include_once("model/m_frecuencia.php");

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
    public $modelFrecuencia;

    public function __construct($idApoyo, $idEvento, $idProveedor) {
        $this->idApoyo = $idApoyo;
        $this->model = new m_apoyo_gasto;
        $this->idEvento = $idEvento;
        $this->modelEvento = new m_evento();
        $this->modelEspecie = new m_especie();
        $this->idProveedor = $idProveedor;
        $this->modelProveedor = new m_proveedor();
        $this->modelFrecuenca = new m_frecuencia();
    }


    /**
    * Carga la pagina de apoyos
    **/
    public function index(){
        $usuario = sessionController::get('username');;
        $titulo = "Apoyos";
          
        $eventos = $this->modelEvento->getAllEventos();
        $frecuencia = $this->modelFrecuenca->getFrecuencia();

        $proveedores = $this->modelProveedor->getAll(0);
        $donatarios = $this->modelProveedor->getAll(1);
        $especies = $this->modelEspecie->getAllEspecies();
        $unidades = $this->modelEspecie->getUnidad();
        $paises = $this->model->getPaises();
        $estadosMex = $this->model->getEstados(1);
        $estadosEua = $this->model->getEstados(2);
        $monedas = $this->model->getMonedas();
        
        $login = new loginController();
        $saldo=0;

        if($login->_isLoggedIn()){
            require_once("views/templates/header.php");
            require_once("views/templates/nav.php");
            require_once("views/apoyos.php"); // Cual es?
            require_once("views/templates/footer.php");
        }else
            require_once("views/login.php");
    }


    /**
    * Funcion para obtener todos los apoyos
    * sirve para poblar el datatable mediante ajax, en el ajax se envía como json
    * @return array con todos los apoyos registrados
    **/
    public function getApoyosForTable(){
        /*
        Se obtienen los sig datos del model:
         id_apoyo
         concepto
         referencia (es lo mismo que numero de referencia)
         nombre del evento
         razon social proveedor
         fecha de captura
         estatus (activo,cancelado)
        */
        return [ "data" => $this->model->getApoyosForTable() ];
    }



    /**
    * Funcion para agregar un nuevo apoyo
    **/
    public function nuevoApoyoGasto($postData) {
        $result = array();
        $errors = $this->validaDatos($postData);        

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {      

            $idApoyo = $this->model->addApoyoGasto($postData);

            //se seleccionó apoyo en especie
            if($postData['tipoApoyo'] == 0){
                //se seleccionó otra unidad
                if($postData['unidad'] == 0){
                    $postData['unidad'] = $this->model->addUnidad($postData['otraUnidad']);
                }

                $newData =[
                'idApoyo' => $idApoyo,
                'idEspecie' => $postData['especie'],
                'cantidad' => $postData['cantidad'],
                'idUnidad' => $postData['unidad']
                ];

                $this->model->addEspecieApoyo($newData);
            }

            $result = array(
                "status" => "success",
                "message" => "Registro exitoso");
        }

        return $result;
    }

    
    public function getApoyoGasto() {
        
        $result = $this->model->getApoyoById($this->idApoyo);

        if($result){
            $result["status"] = "success";
            if($result['id_especie_apoyo']){
                $especie = $this->model->getEspecie($result['id_especie_apoyo']);
                $result['especie_descripcion'] = $especie['descripcion'];
            }
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

    /**
    * Valida datos para agregar un nuevo apoyo
    **/
    private function validaDatos($data) {
        $errors = array();
        $estatus = $data['estatus'];        
        $concepto = $data['concepto'];
        $fechaCaptura = $data['fechaCaptura'];
        $frecuencia = $data['frecuencia'];
        $evento = $data['evento'];
        $proveedor = $data['proveedor'];
        $donatario = $data['donatario'];
        $tipoApoyo = $data['tipoApoyo'];
        $especie = $data['especie'];
        $cantidad = $data['cantidad'];
        $unidad = $data['unidad'];
        $otraUnidad = $data['otraUnidad'];
        $pais = $data['pais'];
        $estado = $data['estado'];
        $abono = $data['abono'];
        $moneda = $data['moneda'];
        $numeroReferencia = $data['numeroReferencia'];
        $fechaReferencia = $data['fechaReferencia'];
        $observaciones = $data['observaciones'];
        //campos libreta flujo
        $mesContable = $data['mesContable'];
        $fechaDoctoSalida = $data['fechaDoctoSalida'];
        $doctoSalida = $data['doctoSalida'];
        $poliza = $data['poliza'];

        if (!$data['concepto']) 
            $errors[] = "Se debe proporcionar una descripcion";
        
        if($estatus<0 || $estatus>1) $errors[] = "Estatus no válido";

        if($fechaCaptura &&  !$this->isValidDate($fechaCaptura))
            $errors[] = "Formato de fecha de captura incorrecto";

        if(!$frecuencia)
            $errors[] = "Frecuencia no válida";

        if (!$evento) 
            $errors[] = "Debe ingresar un evento";

        if(!($proveedor xor $donatario))
            $errors[] = "Debes seleccionar o un proveedor o un donatario";

        if($tipoApoyo == 0){
            if(!$especie)
                $errors[] = "Especie no válida";

            if(!($cantidad>0))
                $errors[] = "Cantidad no válida";

            if($unidad == 0 && !$otraUnidad)
                $errors[] = "Debe especificar una unidad";
        }
        
        if(!$pais) $errors[] = "Pais no válido";

        if(!$estado) $errors[] = "Estado no válido";

        if(!($abono>=0)) $errors[] = "Importe no válido";

        if(!$moneda) $errors = "Tipo de moneda no válida";

        if($fechaDoctoSalida && !$this->isValidDate($fechaDoctoSalida))
            $errors[] = "Fecha de documento de salida no válido";

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


    /**
    * verifica si una fecha es válida,
    * @param String "YYYY-MM-DD" representa una fecha
    **/
    private function isValidDate($date){
        $temp = explode('-',$date);
        return checkdate($temp[1], $temp[2], $temp[1]);
    }

    

}
