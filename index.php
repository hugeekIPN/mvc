<?php
error_reporting(-1);
ini_set('display_errors', 1);    

require_once("controller/sessionController.php");
require_once("controller/loginController.php");
require_once("controller/usuariosController.php");
require_once("controller/eventoController.php");
require_once("controller/ProveedorController.php");
require_once("controller/programaController.php");

sessionController::startSession(); 
$login        = new loginController();
$user         = new usuariosController(sessionController::get("usuarioId"));

$programa = new programaController(null);

$evento   = new eventoController("1");
$proveedor   = new ProveedorController("1");

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
        $user->especie();
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
        $user->subprogramas();
        break;
          
    default:    
        $login->index();
    break;


  }

?>