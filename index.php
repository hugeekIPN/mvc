<?php
error_reporting(-1);
ini_set('display_errors', 1);    

require_once("controller/sessionController.php");
require_once("controller/loginController.php");
require_once("controller/usuariosController.php");

sessionController::startSession(); 
$login        = new loginController();
$user         = new usuariosController(sessionController::get("usuarioId"));

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
        $user->proveedores();
    break;
          
    case 'especies':
        $user->especie();
    break;
    
    case 'cap_apoyos':
        $user->cap_apoyos();
    break;

    case 'eventos':
        $user->eventos();
        break;
    case 'programas':
        $user->programas();
        break;
    case 'subprogramas':
        $user->subprogramas();
        break;
          
    default:    
        $login->index();
    break;


  }

?>