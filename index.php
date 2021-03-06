<?php
error_reporting(-1);
ini_set('display_errors', 1);    

require_once("controller/sessionController.php");
require_once("controller/loginController.php");
require_once("controller/usuariosController.php");
require_once("controller/eventoController.php");
require_once("controller/ProveedorController.php");
require_once("controller/programaController.php");
require_once("controller/subprogramaController.php");
require_once("controller/especieController.php");
require_once("controller/apoyoController.php");
require_once ("controller/cargoController.php");


sessionController::startSession(); 
$login        = new loginController();
$user         = new usuariosController(sessionController::get("usuarioId"));

$programa = new programaController(null);
$subprograma = new subprogramaController(null);

$evento   = new eventoController("2", "1");
$proveedor   = new ProveedorController("1");
$especie= new EspecieController(null);
$apoyo = new ApoyoGastoController(null, null, null);

$cargo = new cargoController(null);

$option=isset($_REQUEST['op']) ?  $_REQUEST['op']: null;

  switch($option)
  {
    case 'logout':
      $login->logout();
    break;

    case 'users':
    	$user->index();
    break;
    
    case 'proveedores':
        $proveedor->index();
    break;
          
    case 'especies':
        $especie->index();
    break;
    
    case 'cap_apoyos':
        $user->cap_apoyos();
    break;

    case 'eventos':
        $evento->index();
        break;
    case 'programas':
        $programa->index();
        break;
        
    case 'subprogramas':
        $subprograma->index();
        break;
          
    case 'poliza':
        $proveedor->poliza();
        break;
    case 'solicitud':
        $proveedor->solicitud();
        break;
    case 'cuenta':
        $proveedor->cuenta();
        break;      
    case 'cheque':
        $proveedor->cheque();
        break;   
    case 'apoyos':
        $apoyo->index();
        break;

    // json con todos los apoyos, es para el dataTable
    case 'getApoyos':
        echo json_encode($apoyo->getApoyosForTable());
        break;
        
    case 'cargos' :
        $cargo -> index();
        break;

    default:    
        $login->index();
    break;


  }