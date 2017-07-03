
<!DOCTYPE html>
<html lang="es">
<head>
	
	<meta charset="UTF-8">
	<title>SGI - TELMEX</title>
	<!--  Importa los estilos-->
	<link rel="stylesheet" href="assets/css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/DataTables/datatables.css">
    <link rel="stylesheet" href="assets/css/non-responsive.css">

	<!--  Importa los JavaScript-->

	<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/DataTables/datatables.js"></script>	
    <script type="text/javascript" src="assets/js/jquery.toaster.js"></script>

    <script>
	 	$(document).ready(function(){
		    $('#example').DataTable();
		});
		
	</script>	
	
 	
</head>
<body>
	<!--<nav class="navbar header">
	  <div class="container-fluid">
	    <div class="navbar-header col-xs-4 header1 ">
	      <a class="navbar-brand" href="#">
	      	<div class=" logo2">				
                <a href="index.php"><img class="pull-left imagenindex" src="assets/img/logo.png" alt="Logo Fundación TELMEX"></a>
			</div></a>
	    </div>

	    <div class="col-xs-4 header2">
	    	<p class="">Usuario:</p>
	    	<p class="nombre-u"><strong><?php echo $usuario; ?></strong></p>
	    </div>
	    <div class="col-xs-4 header3">
	    	<p class=""><?php echo date("d / m / Y"); ?></p>
	    </div>

	    
	  </div>
	</nav>
 -->

<!-- banner (logo, usuario y fecha)-->