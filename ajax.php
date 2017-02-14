<?php
require_once("controller/sessionController.php");
require_once("controller/loginController.php");
require_once("controller/usuariosController.php");
require_once("controller/eventoController.php");
require_once("controller/ProveedorController.php");
require_once("controller/programaController.php");
sessionController::startSession(); 

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
    die("Valió barriga Sr...!");
/*
$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
    die("Valió barriga Sr...!");
*/

$action = $_POST['action'];

switch ($action) {
	case 'logearse':
		$login = new loginController();
		$logeado = $login->login($_POST['username'], $_POST['password']);

        if($logeado === true)
            echo json_encode(array(
                'status' => 'success',
                'page'   => 'index.php'
            ));
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
        $evento = new eventoController($_POST['eventoId']);
        echo json_encode($evento->getEvento());
        break;
     case 'addEvento':
        $evento = new eventoController(null);
        echo json_encode($evento->nuevoEvento($_POST));
        break;
     case 'updateEvento':
        $evento = new eventoController($_POST['id_evento']);
        echo json_encode($evento->updateEvento($_POST));
        break;
     case 'deleteEvento':
        $evento = new eventoController($_POST['eventoId']);
        echo json_encode($evento->deleteEvento($_POST));
        break;
        
/// CRUD Proveedores
     case 'getProveedor':
        $proveedor = new ProveedorController($_POST['id_proveedor']);
        echo json_encode($proveedor->getProveedor($_POST));
        break;
     case 'addProveedor':
       $proveedor= new ProveedorController(null);
        echo json_encode($proveedor->nuevoProveedor($_POST));
        break;
     case 'updateProveedor':
       $proveedor= new ProveedorController($_POST['id_proveedor']);
        echo json_encode($proveedor->updateProveedor($_POST));
        break;
     case 'deleteProveedor':
        $proveedor = new ProveedorController($_POST['proveedorId']);
        echo json_encode($proveedor->deleteProveedor($_POST));
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
       $programa = new programaController(null);
       echo json_encode($programa->nuevoPrograma($_POST));
       break; 

    case 'getSubPrograma':
        $programa = new programaController($_POST['idSubPrograma']);
        echo json_encode($programa->getPrograma());
        break; 

    case 'updateSubPrograma':
        $programa = new programaController($_POST['idSubPrograma']);
        echo json_encode($programa->updatePrograma($_POST));
        break;    

    case 'deleteSubPrograma':
        $programa = new programaController($_POST['idSubPrograma']);
        echo json_encode($programa->deletePrograma($_POST));
        break;         
    // FIN CRUD SUBPROGRAMAS

	default:		
		break;
}

