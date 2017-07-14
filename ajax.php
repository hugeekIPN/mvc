<?php
require_once "controller/sessionController.php";
require_once "controller/loginController.php";
require_once "controller/usuariosController.php";
require_once "controller/eventoController.php";
require_once "controller/ProveedorController.php";
require_once "controller/programaController.php";
require_once "controller/subprogramaController.php";
require_once "controller/especieController.php";
require_once 'controller/cargoController.php';
require_once 'controller/saldoController.php';
require_once 'controller/apoyoController.php';

sessionController::startSession();

if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die("Valió barriga Sr...!");
}

/*
$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
die("Valió barriga Sr...!");
 */

$action = $_POST['action'];

switch ($action) {
    case 'logearse':
        $login   = new loginController();
        $logeado = $login->login($_POST['username'], $_POST['password']);

        if ($logeado === true) {
            echo json_encode(array(
                'status' => 'success',
                'page'   => 'index.php',
            ));
        }

        break;

    case 'addUsuario':
        $usuario = new usuariosController(null);
        echo json_encode($usuario->nuevoUsuario($_POST));
        break;

    case 'getUsuario':
        $usuario = new usuarioscontroller($_POST['userId']);
        echo json_encode($usuario->getUsuario());
        break;

    case 'updateUsuario':
        $usuario = new usuarioscontroller($_POST['usuarioId']);
        echo json_encode($usuario->updateUsuario($_POST));
        break;

    case 'deleteUsuario':
        $usuario = new usuariosController($_POST['usuarioId']);
        echo json_encode($usuario->deleteUsuario($_POST));
        break;
    case 'getEvento':
        $evento = new eventoController($_POST['eventoId'], null);
        echo json_encode($evento->getEvento());
        break;
    case 'addEvento':
        $evento = new eventoController(null, null);
        echo json_encode($evento->nuevoEvento($_POST));
        break;

    case 'updateEvento':
        $evento = new eventoController($_POST['id_evento'], null);
        echo json_encode($evento->updateEvento($_POST));
        break;

    case 'deleteEvento':
        $evento = new eventoController($_POST['eventoId'], null);
        echo json_encode($evento->deleteEvento($_POST));
        break;

/// CRUD Proveedores
    case 'getProveedor':
        $proveedor = new ProveedorController($_POST['id_proveedor']);
        echo json_encode($proveedor->getProveedor($_POST));
        break;
    case 'addProveedor':
        $proveedor = new ProveedorController(null);
        echo json_encode($proveedor->nuevoProveedor($_POST));
        break;
    case 'updateProveedor':
        $proveedor = new ProveedorController($_POST['id_proveedor']);
        echo json_encode($proveedor->updateProveedor($_POST));
        break;
    case 'deleteProveedor':
        $proveedor = new ProveedorController($_POST['proveedorId']);
        echo json_encode($proveedor->deleteProveedor($_POST));
        break;

    case 'idEstado':
        $proveedor = new ProveedorController(null);
        echo json_encode($proveedor->addEstado($_POST));
        break;  
/// Crud Programas
    case 'addPrograma':
        $programa = new programaController(null);
        echo json_encode($programa->nuevoPrograma($_POST));
        break;

    case 'getPrograma':
        $programa = new programaController($_POST['idPrograma']);
        echo json_encode($programa->getPrograma());
        break;

    case 'updatePrograma':
        $programa = new programaController($_POST['idPrograma']);
        echo json_encode($programa->updatePrograma($_POST));
        break;

    case 'deletePrograma':
        $programa = new programaController($_POST['idPrograma']);
        echo json_encode($programa->deletePrograma($_POST));
        break;

    // CRUD SUBPROGRAMAS
    case 'addSubprograma':
        $subprograma = new subprogramaController(null);
        echo json_encode($subprograma->nuevoSubprograma($_POST));
        break;

    case 'getSubprograma':
        $subprograma = new subprogramaController($_POST['idSubprograma']);
        echo json_encode($subprograma->getSubprograma());
        break;

    case 'updateSubprograma':
        $subprograma = new subprogramaController($_POST['idSubprograma']);
        echo json_encode($subprograma->updateSubprograma($_POST));
        break;

    case 'deleteSubprograma':
        $subprograma = new subprogramaController($_POST['idSubprograma']);
        echo json_encode($subprograma->deleteSubprograma($_POST));
        break;
    // FIN CRUD SUBPROGRAMAS

    // CRUD ESPECIES
    case 'addEspecie':
        $especie = new EspecieController(null);
        echo json_encode($especie->nuevoEspecie($_POST));
        break;

    case 'getEspecie':
        $especie = new EspecieController($_POST['id_especie']);
        echo json_encode($especie->getEspecie());
        break;

    case 'updateEspecie':
        $especie = new EspecieController($_POST['id_especie']);
        echo json_encode($especie->updateEspecie($_POST));
        break;

    case 'deleteEspecie':
        $especie = new EspecieController($_POST['id_especie']);
        echo json_encode($especie->deleteEspecie($_POST));
        break;

    /// FIN CRUD ESPECIES
    
    // CRUD ESPECIES
    case 'addCargo';
        $cargo = new cargoController(null);
        echo json_encode($cargo->nuevoCargo($_POST));
        break;
    case 'getCargo';
        $cargo = new cargoController($_POST['idCargo']);
        echo json_encode($cargo->getCargo($_POST));
        break;
    case 'updateCargo':
        $cargo = new cargoController($_POST['idCargo']);
        echo json_encode($cargo->updateCargo($_POST));
        break;
    case 'deleteCargo':
        $cargo = new cargoController($_POST['idCargo']);
        echo json_encode($cargo->deleteCargo($_POST));
        break;
    
    /// FIN CRUD ESPECIES
    
    case 'addSaldo';
        $saldo = new saldoController(null);
        echo json_encode($saldo->nuevoSaldo($_POST));
        break;
        
    case 'getSaldo':
        $saldo = new saldoController($_POST['idSaldo']);
        echo json_encode($saldo->getSaldo());
        break;        

      /// CRUD APOYOSGASTOS
    case 'addApoyo';
        $apoyo = new ApoyoGastoController(null,null,null);
        //echo json_encode($apoyo->nuevoApoyoGasto($_POST));
        echo json_encode("{'status':'success','message':'hola'}");
        break;
    case 'getApoyo';
        $apoyo = new ApoyoGastoController($_POST['idApoyo'], null,null);
        echo json_encode($apoyo->getApoyoGasto());
        break;
    case 'updateApoyo':
        $apoyo = new ApoyoGastoController($_POST['idApoyo'], null,null);
        echo json_encode($apoyo->updateApoyoGasto($_POST));
        break;
    case 'updateImporteApoyo':
        $apoyo = new ApoyoGastoController($_POST['idApoyo'], null,null);
        echo json_encode($apoyo->updateImporte_ApoyoGasto($_POST));
        break;
    case 'deleteApoyo':
        $apoyo = new ApoyoGastoController($_POST['idApoyo'],null,null);
        echo json_encode($apoyo->deleteApoyoGasto($_POST));
        break;
    case 'getApoyoEventos';
        $apoyo = new ApoyoGastoController(null, null,null);
        echo json_encode($apoyo->getApoyoEventos($_POST));
        break;
        
    default:
        break;
}
