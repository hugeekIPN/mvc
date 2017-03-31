<?php

// Composer's auto-loading functionality
require 'vendor/autoload.php';

use Dompdf\Dompdf;

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
  Beneficiario: BEST BUDDIES DE MÉXICO, A.C.
</p>
<br/><br/><br/>
<pre>
Importe: $658,990.88   
<br>Letra: <strong>seicientos cincuenta y ocho mil novecientos noventa pesos 88/100 M.N.</strong>
</pre>
<br><br>
<p>
Evento / Concepto: <strong>Best Buddies / Donativo para gastos del mes de Noviembre 2016. "AMISTAD" </strong>
</p>
<br><br>
<pre>
Observaciones:
<br><br><br>
    Factura: <strong>BBM67</strong>                                                             Fecha: <strong>09/06/2916</strong>
    <br><br><br><br><br>

_________________________                                  _____________________________
Firma del solicitante                                                                Firma de Vo.Bo.
C.P Mario Pérez Tejeda Rojas                                             Lic. Arturo Elías Ayub
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