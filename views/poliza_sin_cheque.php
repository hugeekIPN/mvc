<?php

// Composer's auto-loading functionality
require 'vendor/autoload.php';
include_once("convierte.php");

use Dompdf\Dompdf;

 $convierte   = new NumberToLetterConverter();

$donatario=isset($_REQUEST['donatario']) ?  $_REQUEST['donatario']: null;
$proveedor=isset($_REQUEST['proveedor']) ?  $_REQUEST['proveedor']: $donatario;
$concepto = isset($_REQUEST['concepto']) ?  $_REQUEST['concepto']: null;

$abono = isset($_REQUEST['abono']) ?  $_REQUEST['abono']: 0;
$money= $convierte->to_word(intval($abono), "MXN");


$aux = (string) $abono;
$decimal = substr( $aux, strpos( $aux, "." ) );


$html = '<!DOCTYPE html>
<html lang="us">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    
    <meta name="description" content="Póliza Sin Cheque" >
    <meta name="author" content="CTIN">

    <title>Solicitud de transferencia electrónica</title>
</head>

<body>
<p style="text-align: center;">
<img src="assets/img/logo.png" width="300px;">
</p>
<hr style="color: gray;" />
<br><br>
<h1 style="text-align:center;"> POLIZA SIN CHEQUE </h1><br/><br/>
<p style="text-align: right;">México, D.F. a '.strftime("%A, %d de %B de %Y")  .' </p>
<br/><br/>

<p style="text-align: center;">
    '.strtoupper($proveedor).', A.C. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $'.number_format($abono,2).' <br/>
    ('.$money.' '.$decimal.'/100 M.N.) <br/>
    
</p>
<br/><br/><br/>
<h3 style="text-align:center;"> CONCEPTO </h3>
<hr style="color: gray;" />
<p style="text-align: center; margin: 0px; padding: 0px;">'.$proveedor.'/ '.$concepto.' </p>
<hr style="color: gray;" />


</body>

</html>
';

//generate some PDFs!
$dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("Poliza.pdf", array("Attachment"=>0));

?>