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
   
        table{
            border-radius: 10px 10px 10px 10px;
            -moz-border-radius: 10px 10px 10px 10px;
            -webkit-border-radius: 10px 10px 10px 10px;
            border: 1px solid #000000;
            width: 100%;
            text-align:center;

        }
    </style>
    
</head>

<body>
<p style="font-size:12px; color:gray; float:left;">
<span style="font-size:14px; color:gray; font-weight:bold; float:left;">FUNDACIÓN TELMEX A. C.</span><br>
PARQUE VIA No. 198 COL. CUAHTEMOC<br>
DELEGACION CUAUHTEMOC, C.P. 06599<br>
R.F.C. FTE-951227-NS5<br>
</p>
<p style="font-size:12px; color:gray;float:right; ">
CHEQUE No. <span style="color:red; font-size:16;">0006330</span><br>
FECHA '.date("Y-M-D").'<br>
</p>

<br><br><br><br>
<p style="font-size:14px; color:black; float:left;">
<span style="color: gray; font-size:12px;">PAGUESE POR ESTE CHEQUE A:</span> <br><br>
<span style="float:left;">TELEFONOS DE MEXICO S.A. DE C.V.</span>
<span style="float:right;"> $ 709,491.68 </span><br><br>
<span style="color: black; font-size:14px;">SETESCIENTOS NUEVE MIL CUATROCIENTOS NOVENTA Y UN PESO 68/100 M.N.</span><br>
</p>
<br><br><br><br>

<p style="font-size:12px; color:gray; text-align:center;">SUPLICAMOS DESPRENDER ESTE TALON ANTES DE PRESENTAR EL CHEQUE</p>

<span style="font-size:14px; color:gray; font-weight:bold; float:left;">FUNDACIÓN TELMEX, A.C. </span><span  style="float:right; color:red; font-size:16;">0006330</span>

<br><br>
<table border="1">
    <tr>
        <th>FECHA</th>
        <th>CONCEPTO</th>
        <th>CANTIDAD</th>
    </tr>
    <tr>
        <td><br><br>19/12/16<br><br></td>
        <td>Beca Digital / Servicios Infinitum del mes de Noviembre de 2016 </td>
        <td>$709,491.68</td>
    </tr>
<table>
<table border="1" class="codifica">
    <tr>
        <th>No. DE CUENTA</th>
        <th>CODIFICACION</th>
        <th>DEBE</th>
        <th>HABER</th>
    </tr>
    <tr>
        <td rowspan="2" height="300px"><br><br><br><br></td>
        <td rowspan="2" ><br><br><br><br> </td>
        <td><br><br><br><br></td>
        <td><br><br><br><br> </td>
    </tr>
    <tr>
        <td height="50px">TOTAL: </td>
        <td><br><br><br></td>
    </tr>
    <tr>    
        <td>HECHO POR:</td>
        <td>REVISO:</td>
        <td>AUTORIZO:</td>
        <td>CONTABILIZO:</td>
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