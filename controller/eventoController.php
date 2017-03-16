<?php

include_once "sessionController.php";
include_once "loginController.php";
include_once "model/m_evento.php";
include_once "model/m_subprograma.php";
/**
 *
 */
class EventoController
{
    private $idEvento;
    private $idSubprograma;
    public $model;
    public $modelSubprograma;

    public function __construct($idEvento, $idSubprograma)
    {
        $this->idEvento         = $idEvento;
        $this->model            = new m_evento;
        $this->idSubprograma    = $idSubprograma;
        $this->modelSubprograma = new m_subprograma();

    }

    public function index()
    {

        $login = new loginController();

        if ($login->_isLoggedIn()) {
            $usuario = sessionController::get('username');
            $titulo  = "Eventos";

            $eventos      = $this->model->getAllEventos();
            $subprogramas = $this->modelSubprograma->getAllSubprogramas();

            require_once "views/templates/header.php";
            require_once "views/templates/nav.php";
            require_once "views/eventos.php"; // Cual es?
            require_once "views/templates/footer.php";
        } else {
            require_once "views/login.php";
        }
    }

    public function nuevoEvento($postData)
    {
        $result = array();
        $errors = $this->validaDatos($postData);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status"  => "error",
                "message" => $message);
        } else {
            $this->model->nuevoEvento($postData);

            $result = array(
                "status"  => "success",
                "message" => "Registro exitoso");
        }

        return $result;
    }

    public function getEvento()
    {
        return $this->model->getEvento($this->idEvento);
    }

    public function updateEvento($data)
    {
        $result = array();
        $errors = $this->validaEventosUpdate($data);

        if ($errors) {
            $message = implode("<br>", $errors);

            $result = array(
                "status"  => "error",
                "message" => $message);
        } else {
            $currentEvento = $this->model->getEvento($this->idEvento);
            $newData       = array();

            if ($currentEvento['subprogramas_idsubprogramas'] != $data['subprogramas_idsubprogramas']) {
                $newData['subprogramas_idsubprogramas'] = $data['subprogramas_idsubprogramas'];
            }
            if ($currentEvento['id_evento'] != $data['id_evento']) {
                $newData['id_evento'] = $data['id_evento'];
            }
            if ($currentEvento['nombre'] != $data['nombre']) {
                $newData['nombre'] = $data['nombre'];
            }
            if ($currentEvento['descripcion'] != $data['descripcion']) {
                $newData['descripcion'] = $data['descripcion'];
            }

            if ($newData) {

                if ($this->model->updateEvento($newData, $this->idEvento)) {
                    $result = array(
                        "status"  => "success",
                        "message" => "Registros Actualizados");
                } else {
                    $result = array(
                        "status"  => "Error",
                        "message" => "No se pudo actualizar la información");
                }
            } else {
                $result = array(
                    "status"  => "sucess",
                    "message" => "No Hay Cambios por Actualizar");
            }
        }
        return $result;
    }
    private function validaEventosUpdate($data)
    {
        $nombre      = $data['nombre'];
        $descripcion = $data['descripcion'];
        $errors      = array();

        $currentEvento = $this->model->getEvento($this->idEvento);
        //validamos que no exista el id del evento
        if (!$currentEvento) {
            $errors[] = "No existe el evento";
            return $errors;
        }
        //validadmos que exista el id del subprograma al que pertenece el evento
        if (!$this->modelSubprograma->getSubprograma($data['subprogramas_idsubprogramas'])) {
            
            $errors[] ="El subprograma que ha seleccionado no está disponible";
            return $errors;
        }
        $anotherEvento = $this->model->getEventoByName($nombre);
        //validamos que el nombre del evento sea unico
        if ($anotherEvento && $anotherEvento['id_evento'] != $this->idEvento) {
            $errors[] = 'El nombre ya está registrado';
        }
        if ($this->esVacio($nombre)) {
            $errors[] = "El nombre no debe de ser vacío";
        }
        if ($this->esVacio($descripcion)) {
            $errors[] = "Descripción no puede ser vacio";
        }

        return $errors;
    }

    public function deleteEvento()
    {
        $this->model->deleteEvento($this->idEvento);
        return true;
    }

    private function validaDatos($data)
    {
        $errors                      = array();
        $subprogramas_idsubprogramas = $data['subprogramas_idsubprogramas'];
        $descripcion                 = $data['descripcion'];
        $nombre                      = $data['nombre'];

        if ($this->esVacio($subprogramas_idsubprogramas)) {
            $errors[] = "El id del subprograma no puede ser vacío";
        }
        if ($this->esVacio($nombre)) {
            $errors[] = "El nombre no puede ser vacío";
        } else {
            if ($this->model->getEvento($nombre)) {
                $errors[] = "El nombre ya está registrado";
            }
        }
        if ($this->esVacio($descripcion)) {
            $errors[] = "Descripción no puede ser vacío";
        }
        return $errors;}

    //Verificasiunarregloounstringesvacio
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
