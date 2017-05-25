<?php
// Array POST 
//print_r($_POST);
//echo "<br/><br/>";
// Array de los archivos:

if(($_FILES['archivo_pdf']['tmp_name'])!=""){
	print_r($_FILES);

	$rutaEnServidor='../archivos/pdf';
	$rutaTemporal=$_FILES['archivo_pdf']['tmp_name'];
	$nombreImagen=$_FILES['archivo_pdf']['name'];
	$rutaDestino=$rutaEnServidor.'/'.$nombreImagen;

	move_uploaded_file($rutaTemporal, $rutaDestino);

}

?>

