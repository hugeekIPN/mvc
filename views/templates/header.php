<!DOCTYPE html>
<html lang="es">
<head>
	
	<meta charset="UTF-8">
	<title>SGI - TELMEX</title>
	<!--  Importa los estilos-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<!--  Importa los JavaScript-->

    <link rel="stylesheet" href="assets/DataTables/datatables.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/datatables.js"></script>
	<script>
	 	$(document).ready(function(){
		    $('#example').DataTable();
		});
	</script>
	<script>
		function edicion() {
	    currentState = estado.isContentEditable;
	    newState = !currentState;
	    estado.contentEditable = newState;
	    oCurrentValue.innerText = newState;
	    newState==false ? editext.innerText="Editar" :
	        editext.innerText="Editando";
	}
	</script>
	<script>
	$(function () {
   
	    $('.dropdown-toggle').dropdownHover(options);
	});
	});
		
	</script>
	
	
 	
</head>
<body>
	<nav class="navbar header">
	  <div class="container-fluid">
	    <div class="navbar-header col-md-4 header1 ">
	      <a class="navbar-brand" href="#">
	      	<div class=" logo2">				
				<img class="pull-left" src="assets/img/logo.png" alt="Logo Fundación TELMEX">
			</div></a>
	    </div>

	    <div class="col-md-4 header2">
	    	<p class="">Usuario:</p>
	    	<p class="nombre-u"><strong>Castillo Puebla Socorro</strong></p>
	    </div>
	    <div class="col-md-4 header3">
	    	<p class="">Miercoles, 11 de Enero del 2017 </p>
	    </div>

	    
	  </div>
	</nav>


<!-- banner (logo, usuario y fecha)-->