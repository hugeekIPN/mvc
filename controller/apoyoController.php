<?php

include_once("sessionController.php");
include_once("loginController.php");
include_once("model/m_apoyo_gasto.php");

/**
 * 
 */
class ApoyoGastoController {

    private $idApoyo;
    public $model;

    public function __construct($idApoyo) {
        $this->idApoyo = $idApoyo;
        $this->model = new m_apoyo_gasto;
    }

    public function index() {

        $login = new loginController();

        if ($login->_isLoggedIn()) {
            $usuario = sessionController::get('username');
            $titulo = "Apoyos";

            $apoyos = $this->model->getApoyoGasto();

            require_once("views/templates/header.php");

            require_once("views/templates/nav.php");
            require_once("views/apoyos.php"); // Cual es?
            require_once("views/templates/footer.php");
        } else {
            require_once("views/login.php");
        }
    }


    public function viewPage(){
        $usuario = "dummy";
            $titulo = "Apoyos";
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
        $errors = $this->validaDatos($postData);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
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
        $errors = $this->validaDatos($postData);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status" => "error",
                "message" => $message);
        } else {
            $currentApoyo = $this->model->getApoyoGasto($this->idApoyo);

            $newData = array();

            if ($currentApoyo['apoyo-gasto'] != $data['apoyo_gasto'])
                $newData['apoyo_gasto'] = $data['apoyo_gasto'];

            if ($currentApoyo['especies_id_especie'] != $data['especies_id_especie'])
                $newData['especies_id_especie'] = $data['especies_id_especie'];

            if ($currentApoyo['anio'] != $data['anio'])
                $newData['anio'] = $data['anio'];

            if ($currentApoyo['folio'] != $data['folio'])
                $newData['folio'] = $data['folio'];

            if ($currentApoyo['tipo'] != $data['tipo'])
                $newData['tipo'] = $data['tipo'];

            if ($currentApoyo['cantidad'] != $data['cantidad'])
                $newData['cantidad'] = $data['cantidad'];

            if ($currentApoyo['unidad'] != $data['unidad'])
                $newData['unidad'] = $data['unidad'];

            if ($currentApoyo['pais'] != $data['pais'])
                $newData['pais'] = $data['pais'];

            if ($currentApoyo['entidad'] != $data['entidad'])
                $newData['entidad'] = $data['entidad'];

            if ($currentApoyo['descripcion'] != $data['descripcion'])
                $newData['descripcion'] = $data['descripcion'];

            if ($currentApoyo['moneda'] != $data['moneda'])
                $newData['moneda'] = $data['moneda'];

            if ($currentApoyo['tipo_cambio'] != $data['tipo_cambio'])
                $newData['tipo_cambio'] = $data['tipo_cambio'];

            if ($currentApoyo['fcambio'] != $data['fcambio'])
                $newData['fcambio'] = $data['fcambio'];

            if ($currentApoyo['freferencia'] != $data['freferencia'])
                $newData['freferencia'] = $data['freferencia'];

            if ($currentApoyo['fcaptura'] != $data['fcaptura'])
                $newData['fcaptura'] = $data['fcaptura'];

            if ($currentApoyo['observaciones'] != $data['observaciones'])
                $newData['obsevaciones'] = $data['observaciones'];

            if ($currentApoyo['frecuencia'] != $data['frecuencia'])
                $newData['frecuencia'] = $data['frecuencia'];

            if ($currentApoyo['eventos_id_evento'] != $data['eventos_id_eventos'])
                $newData['eventos_id_eventos'] = $data['eventos_id_evento'];

            if ($currentApoyo['estado'] != $data['estado'])
                $newData['estado'] = $data['estado'];

            if ($currentApoyo['fecha_creacion'] != $data['fecha_creacion'])
                $newData['fecha_creacion'] = $data['fecha_creacion'];

            if ($currentApoyo['ultima_modificacion'] != $data['ultima_modificacion'])
                $newData['ultima_modificacion'] = $data['ultim_modificacion'];

            if ($newData) {
                $this->model->updateApoyoGasto($newData, $this->idApoyo);
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
        $this->model->deleteApoyoGasto($this->idApoyo);
        return true;
    }

    private function validaDatos($data) {
        $errors = array();

        $apoyo_gasto            = $data['apoyo_gasto'];
        $especies_id_especies   = $data['especies_id_especies'];
        $anio                   = $data['anio'];
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
        $fecha_creacion         = $data['fecha_creacion'];
        $ultima_modificacion    = $data['ultima_modificacion'];

        if ($this->esVacio($apoo_gasto)) {
            $errors[] = "ApoyoGasto no puede ser vacío";
        }
        if ($this->esVacio($especies_id_especies)) {
            $errors[] = "Especie no puede ser vacío";
        }
        if ($this->esVacio($anio)) {
            $errors[] = "Año no puede ser vacío";
        }
        if ($this->esVacio($folio)) {
            $errors[] = "Folio no puede ser vacío";
        }
        if ($this->esVacio($tipo)) {
            $errors[] = "Tipo no puede ser vacío";
        }
        if ($this->esVacio($cantidad)) {
            $errors[] = "Cantidad no puede ser vacío";
        }
        if ($this->esVacio($unidad)) {
            $errors[] = "Unidad no puede ser vacío";
        }
        if ($this->esVacio($pais)) {
            $errors[] = "País no puede ser vacío";
        }
        if ($this->esVacio($entidad)) {
            $errors[] = "Entidad no puede ser vacío";
        }
        if ($this->esVacio($descripcion)) {
            $errors[] = "Descripción no puede ser vacío";
        }
        if ($this->esVacio($moneda)) {
            $errors[] = "Moneda no puede ser vacío";
        }
        if ($this->esVacio($tipo_cambio)) {
            $errors[] = "Tipo_Cambio no puede ser vacío";
        }
        if ($this->esVacio($fcambio)) {
            $errors[] = "fcambio no puede ser vacío";
        }
        if ($this->esVacio($freferencia)) {
            $errors[] = "freferencia no puede ser vacío";
        }
        if ($this->esVacio($evento_id_evento)) {
            $errors[] = "evento_id_evento no puede ser vacío";
        }
        if ($this->esVacio($estado)) {
            $errors[] = "Estado no puede ser vacío";
        }
        if ($this->esVacio($fecha_creacion)) {
            $errors[] = "fecha de cccreación no puede ser vacío";
        }
        if ($this->esVacio($ultima_modificacion)) {
            $errors[] = "última modificación no puede ser vacío";
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
