<?php

// Composer's auto-loading functionality
require 'vendor/autoload.php';

include_once("convierte.php");

use Dompdf\Dompdf;

 $convierte   = new NumberToLetterConverter();
 $fecha=isset($_REQUEST['fecha']) ?  $_REQUEST['fecha']: null;
$cuenta=isset($_REQUEST['cuenta']) ?  $_REQUEST['cuenta']: null;
$firma=isset($_REQUEST['firma']) ?  $_REQUEST['firma']: null;
$moneda = isset($_REQUEST['moneda']) ?  $_REQUEST['moneda']: null;
$evento = isset($_REQUEST['evento']) ?  $_REQUEST['evento']: null;
$concepto = isset($_REQUEST['concepto']) ?  $_REQUEST['concepto']: null;
$abono = isset($_REQUEST['abono']) ?  $_REQUEST['abono']: null;
$money= $convierte->to_word(intval($abono), "MXN");


$aux = (string) $abono;
$decimal = substr( $aux, strpos( $aux, "." ) );


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
<p style="text-align: center;">
<img src="assets/img/logo.png" width="300px;">
</p>
<h1 style="text-align:center;"> SOLICITUD DE <strong>CUENTA POR PAGAR</strong></h1>
<hr style="color: gray;" />
<br><br>
<pre style="text-align:left;">
México, D.F. a '.date("Y-M-D").'                              Consecutivo: <strong>FTBR/Afsch/1230/16</strong></pre>
<br/><br/>

<p style="text-align: left;">
  Beneficiario: '.$cuenta.', A.C.
</p>
<br/><br/><br/>
<pre>
Importe: $'.number_format($abono,2).' 
<br>Letra: <strong>'.$money.' '.$decimal.'/100 M.N.</strong>
</pre>
<br><br>
<p>
Evento / Concepto: <strong>'.$evento.'/ '.$concepto.' </strong>
</p>
<br><br>
<pre>
Observaciones:
<br><br><br>
    Factura: <strong>BBM67</strong>                                                             Fecha: <strong>'.$fecha.'</strong>
    <br><br><br><br><br>

_________________________                                  _____________________________
Firma del solicitante                                                                Firma de Vo.Bo.
Lic. Socorro Castillo Puebla                                           '.$firma.'
</pre>

</body>

</html>
';

//generate some PDFs!
$dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("Cuenta.pdf", array("Attachment"=>0));

?>