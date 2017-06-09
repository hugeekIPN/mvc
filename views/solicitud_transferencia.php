<?php

// Composer's auto-loading functionality
require 'vendor/autoload.php';

include_once("convierte.php");

use Dompdf\Dompdf;

 $convierte   = new NumberToLetterConverter();

$carta=isset($_REQUEST['carta']) ?  $_REQUEST['carta']: null;
$firma=isset($_REQUEST['firma']) ?  $_REQUEST['firma']: null;
$tipo = isset($_REQUEST['tipo']) ?  $_REQUEST['tipo']: null;
$mostrar = isset($_REQUEST['mostrar']) ?  $_REQUEST['mostrar']: null;
$concepto = isset($_REQUEST['concepto']) ?  $_REQUEST['concepto']: null;
$cuenta = isset($_REQUEST['cuenta']) ?  $_REQUEST['cuenta']: null;
$plaza = isset($_REQUEST['plaza']) ?  $_REQUEST['plaza']: null;
$banco = isset($_REQUEST['banco']) ?  $_REQUEST['banco']: null;
$sucursal = isset($_REQUEST['sucursal']) ?  $_REQUEST['sucursal']: null;

if($tipo == "Interbancario") $texto = "Transferencia Electrónica de Fondos Vía Pago
Interbancario";
if($tipo== "SPEUA")  $texto =  "Transferencia Electrónica de Fondos Vía SPEUA";
if($tipo== "Traspaso de Fondos")  $texto =  "Traspaso de Fondos";

if(isset($_REQUEST['abono'])){
	$abono = $_REQUEST['abono'];
	$money= $convierte->to_word(intval($abono), "MXN");
	$aux = (string) $abono;
	$decimal = substr( $aux, strpos( $aux, "." ) );
}else{
	$abono = null;
	$money = null;
	$decimal= null;
}




$html = '<!DOCTYPE html>
<html lang="us">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <meta name="description" content="Solicitud de transferencia electrónica" >
    <meta name="author" content="CTIN">

    <title>Solicitud de transferencia electrónica</title>
</head>

<body>
<p style="text-align: center;">
<img src="assets/img/logo.png" width="300px;">
</p>
<hr style="color: gray;" />
<p style="text-align: center; margin: 0px; padding: 0px;">Parque Vía No. 198, Col. Cuahtémoc, Delegación Cuauhtémoc, C.P. 06599, México, D.F.</p>
<hr style="color: gray;" />
<p style="text-align: right;">México, D.F. a '.strftime("%A, %d de %B de %Y")  .' </p>
<p style="text-align: right;">Ref: FT/1230/16 </p>
<br/><br/>
<strong>GERENCIA DE TESORERÍA</strong><br/>
<strong>PRESENTE.</strong>
<br/><br/>
<p>
Por medio de la presente solicitamos se realice la siguiente <strong>'.$texto.'</strong> con cargo a la cuenta No. 011 03600 0017 a nombre de Fundación Telmex, A.C. por la Cantidad de:
</p>

<p><strong>$'.number_format($abono,2).' ('.$money.' '.$decimal.'/100 M.N.)</strong></p>

<p>
a favor de: <br/><br/>

BENEFICIARIO.- '.$carta.', A.C. <br/><br/>

CUENTA NO.- '.$cuenta.'<br/><br/>
BANCO.- '.$banco.'<br/><br/>
SUCURSAL.- '.$sucursal.'<br/><br/>
PLAZA.- '.$plaza.'<br/><br/>
CONCEPTO.- '.$concepto.'<br/><br/>
<span style="text-decoration: underline;">NOTA: CON FECHA VALOR IGUAL A LA FECHA DE RECEPCIÓN POR EL BANCO</span><br/><br/>

Agradecemos gentilmente la atención que se sirva brindar a este asunto<br/><br/>

Atentamente,<br/><br/><br/>


'.$firma.'<br/>
Coordinadoras Fundación Telmex, A.C.<br/>
</p>

</body>

</html>
';

//generate some PDFs!
$dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("Solicitud.pdf", array("Attachment"=>0));




?>