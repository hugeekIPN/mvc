<?php
require_once("controller/sessionController.php");
require_once("controller/loginController.php");
require_once("controller/usuariosController.php");

sessionController::startSession(); 

if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') 
    die("Valió barriga Sr...!");

$url = parse_url( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
if( !isset( $url['host']) || ($url['host'] != $_SERVER['SERVER_NAME']))
    die("Valió barriga Sr...!");

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

	default:		
		break;
}

