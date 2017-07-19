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
        $estados = $this->model->getEstados(0); //estados que no son de EU ni de mex
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

    /**
    * Funcion para obtener detalles de un apoyo
    **/
    public function getApoyoGasto() {
        
        $result = $this->model->getApoyoById($this->idApoyo);

        if($result){
            $result["status"] = "success";
            
        }else{
            $result = array(
                "status" => "error",
                "message" => "No se encontró el apoyo");
        }
        return $result;
    }

    /**
    * Actualiza datos de un apoyo
    **/
    public function updateApoyoGasto($data) {
        $result = array();
        $errors = $this->validaDatos($data);

        if ($errors) {
            $message = implode("<br>", $errors);
            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
            $currentApoyo = $this->model->getApoyoById($this->idApoyo); 
            //campos a actualizar en bd
            $newData = array();
            unset($newData['action']);
            
            if ($currentApoyo['estatus'] != $data['estatus'])
                $newData['estatus'] = $data['estatus']; 

            if($currentApoyo['concepto'] != $data['concepto'])
                $newData['concepto'] = $data['concepto'];

            if($currentApoyo['fechaCaptura'] != $data['fechaCaptura'])
                $newData['fecha_creacion'] = $data['fechaCaptura'];

            if($currentApoyo['idFrecuencia'] != $data['frecuencia'])
                $newData['id_frecuencia'] = $data['frecuencia'];

            if($currentApoyo['idEvento'] != $data['evento'])
                $newData['id_evento'] = $data['evento'];

            //select proveedor o donatario
            if($data['proveedor'])  
                if($currentApoyo['idProveedor'] != $data['proveedor'])
                    $newData['id_proveedor'] = $data['proveedor'];
            else
                if($currentApoyo['idProveedor'] != $data['donatario'])
                    $newData['id_proveedor'] = $data['proveedor'];

            //select especie o importe
            if($data['tipoApoyo']){ //importe
                if($currentApoyo['idEspecie']) //cambia de especie a importe
                    $this->model->deleteEspecieApoyo($this->idApoyo);               
            }else{ //especie
                if($currentApoyo['idEspecie']){//actualiza especie
                    $newEspecieApoyo = array();                    
                    if($data['unidad']==0){ //se seleccionó otra unidad
                       $newEspecieApoyo['id_unidad'] = $this->model->addUnidad($data['otraUnidad']);
                    }else if($currentApoyo['idUnidad'] != $data['unidad'])
                            $newEspecieApoyo['id_unidad'] = $data['unidad'];

                    if($currentApoyo['idEspecie']!= $data['especie'])
                        $newEspecieApoyo['id_especie'] = $data['especie'];

                    if($currentApoyo['cantidad'] != $data['cantidad'])
                        $newEspecieApoyo['cantidad'] = $data['cantidad'];

                    if($newEspecieApoyo){ //actualizamos relacion especie_apooyo
                        $this->model->updateEspecieApoyo($newEspecieApoyo,$this->idApoyo);
                    }

                }else{ // cambia de efectivo a especie
                    //se seleccionó otra unidad
                    if($data['unidad'] == 0){
                        $data['unidad'] = $this->model->addUnidad($data['otraUnidad']);
                    }

                    $newEspecieApoyo =[
                    'idApoyo' => $this->idApoyo,
                    'idEspecie' => $data['especie'],
                    'cantidad' => $data['cantidad'],
                    'idUnidad' => $data['unidad']
                    ];

                    $this->model->deleteEspecieApoyo($this->idApoyo);
                    $this->model->addEspecieApoyo($newEspecieApoyo);

                }

            }

            if($currentApoyo['idEstado'] != $data['estado'])
                $newData['id_estado'] = $data['estado'];

            if($currentApoyo['importe'] != $data['abono'])
                $newData['importe'] = $data['abono'];

            if($currentApoyo['idMoneda'] != $data['moneda'])
                $newData['id_moneda'] = $data['moneda'];

            if($currentApoyo['referencia'] != $data['numeroReferencia'])
                $newData['referencia'] = $data['numeroReferencia'];

            if($currentApoyo['fechaReferencia'] != $data['fechaReferencia'])
                $newData['fecha_referencia'] = $data['fechaReferencia'];

            if($currentApoyo['observaciones'] != $data['observaciones'])
                $newData['observaciones'] = $data['observaciones'];

            if($currentApoyo['mesContable'] != $data['mesContable'])
                $newData['mes_contable'] = $data['mesContable'];

            if($currentApoyo['fechaDoctoSalida'] != $data['fechaDoctoSalida'])
                $newData['fecha_docto_salida'] = $data['fechaDoctoSalida'];

            if($currentApoyo['doctoSalida'] != $data['doctoSalida'])
                $newData['docto_salida'] = $data['doctoSalida'];

            if($currentApoyo['poliza'] != $data['poliza'])
                $newData['poliza'] = $data['poliza'];

            if ($newData) {
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
