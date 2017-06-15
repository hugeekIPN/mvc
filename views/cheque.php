<?php

// Composer's auto-loading functionality
require 'vendor/autoload.php';
include_once("convierte.php");

use Dompdf\Dompdf;

$convierte   = new NumberToLetterConverter();

$nombre=isset($_REQUEST['nombre']) ?  $_REQUEST['nombre']: null;
$concepto = isset($_REQUEST['concepto']) ?  $_REQUEST['concepto']: null;
$descripcion = isset($_REQUEST['descripcion']) ?  $_REQUEST['descripcion']: null;
$concepto = isset($_REQUEST['concepto']) ?  $_REQUEST['concepto']: null;

if(isset($_REQUEST['abono'])){
    $abono = $_REQUEST['abono'];
    $money= $convierte->to_word(intval($abono), "MXN");
    $aux = (string) $abono;
    $decimal = substr( $aux, strpos( $aux, "." ) );
}else{
    $abono = 0.00;
    $money = null;
    $decimal= null;
}

$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$mes = (int)date("m");
if($mes >0) $mes--;
$fecha = date("d").' de '.$meses[$mes].' del '.date("Y");


$html = '<!DOCTYPE html>
<html lang="es">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <meta name="description" content="Cuenta por pagar" >
    <meta name="author" content="CTIN">

    <title>Solicitud de transferencia electrónica</title>
    <style>
        p, pre{
            font-family: sans-serif;
        }
    </style>
    
</head>
<body>
<p style="font-size:12px; color:gray; float:left;">
<span style="font-size:14px; color:gray; font-weight:bold; float:left;">
</span><br>
<br>
<br>
<br>
</p>
<p style="font-size:12px; color:gray;float:right; ">
<span style="color:red; font-size:16;">&nbsp;</span><br>
FECHA '.$fecha.'<br>
</p>

<br><br><br><br>
<p style="font-size:14px; color:black; float:left;">
<span style="color: gray; font-size:12px;"></span> <br><br>
<span style="float:left;">'.$nombre.'</span>
<span style="float:right;"> $'.$abono.' </span><br><br>
<span style="color: black; font-size:14px;">'.$money.' '.$decimal.'/100 M.N.</span><br>
</p>
<br><br><br><br>

<p style="font-size:12px; color:gray; text-align:center;"></p>
<br><br><br><br><br><br><br><br>
<br><br><br><br>
<br><br>
<table border="0">
    <tr>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <td width="130px"><br><br>19/12/16<br><br></td>
        <td width="400px" style="text-align:center;"><br>'.$concepto.' / '.$descripcion.' </td>
        <td width="180px" style="text-align:right;"><br>$'.$abono.'</td>
    </tr>
<table>
<table border="0" class="codifica">
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <td rowspan="2" height="300px"><br><br><br><br></td>
        <td rowspan="2" ><br><br><br><br> </td>
        <td><br><br><br><br></td>
        <td><br><br><br><br> </td>
    </tr>
    <tr>
        <td height="50px"></td>
        <td><br><br><br></td>
    </tr>
    <tr>    
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    
<table>

</body>

</html>
';

//generate some PDFs!
$dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("Cheque.pdf", array("Attachment"=>0));

?>