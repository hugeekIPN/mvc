<?php

// Composer's auto-loading functionality
require 'vendor/autoload.php';

use Dompdf\Dompdf;

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
<br><br>
<h1 style="text-align:center;"> POLIZA SIN CHEQUE </h1><br/><br/>
<p style="text-align: right;">México, D.F. a '.strftime("%A, %d de %B de %Y")  .' </p>
<br/><br/>

<p style="text-align: center;">
    BEST BUDDIES DE MÉXICO, A.C. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $658,990.88 <br/>
    (SEISCIENTOS CINCUENTA Y OCHO MIL NOVECIENTOS NOVENTA PESOS 88/100 M.N.)
</p>
<br/><br/><br/>
<h3 style="text-align:center;"> CONCEPTO </h3>
<hr style="color: gray;" />
<p style="text-align: center; margin: 0px; padding: 0px;">Best Buddies / Donativo para gastos  del mes de Noviembre 2016. "AMISTAD" </p>
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