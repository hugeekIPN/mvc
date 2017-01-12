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

    default:    
        $login->index();
    break;
  }

?>