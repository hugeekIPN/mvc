<?php

// Composer's auto-loading functionality
require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$var = "Soy una variable";
$fecha= date("Y-m-d H:i:s");   
$html = '<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="es_ES.UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="Especialidad de electronica de ESIME Zacatenco" >
    <meta name="author" content="Esteban Cureño">

    <title>Solicitud de transferencia electrónica</title>
</head>

<body>
<img src="assets/img/logo.png" width="200px">
<hr style="color: gray;" />
<span style="text-align: center;">Parque Vía No. 198, Col. Cuahtémoc, Delegación Cuauhtémoc, C.P. 06599, México, D.F.</span>
<hr style="color: gray;" />
<p>México, D.F. a '.strftime("%A, %d de %B de %Y")  .' </p>
<p>Ref: FT/1230/16 </p>

<strong>GERENCIA DE TESORERÍA</strong><br/>
<strong>PRESENTE.</strong>

<p>
Por medio de la presente solicitamos se realice la siguiente <strong>Transferencia Electrónica de Fondos Vía Pago Interbancario</strong> con cargo a la cuenta No. 011 03600 0017 a nombre de Fundación Telmex, A.C. por la Cantidad de:
</p>

<p><strong>$658,990.88 (SEISCIENTOS CINCUENTA Y OCHO MIL NOVECIENTOS NOVENTA PESOS 88/100 M.N.)</strong></p>

<p>
a favor de: <br/>

BENEFICIARIO.- BEST BUDDIES DE MÉXICO, A.C. <br/>

CUENTA NO.- 036 180 11274080011 9<br/>
BANCO.- INBURSA<br/>
SUCURSAL.- Palmas<br/>
PLAZA.- 01<br/>
CONCEPTO.- Donativo para gastos del mes de Noviembre 2016. "AMISTAD"<br/>
<span style="text-decoration: underline;">NOTA: CON FECHA VALOR IGUAL A LA FECHA DE RECEPCIÓN POR EL BANCO</span><br/>

Agradecemos gentilmente la atención que se sirva brindar a este asunto<br/>

Atentamente,<br/>


SRA. GABRIELA BLASQUEZ DE CARDENAS<br/>
SRA. JAQUELINE VINAY DE RAMÍREZ OTERO<br/>
Coordinadoras Fundación Telmex, A.C.<br/>
</p>

</body>

</html>
';

//generate some PDFs!
$dompdf = new DOMPDF();  //if you use namespaces you may use new \DOMPDF()
$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("sample.pdf", array("Attachment"=>0));





/*

require_once '../autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landsce');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//$dompdf->stream();

*/

?>