<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<title>LOGIN FUNDACIÓN TELMEX</title>
	<!--  Importa los estilos-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<!--  Importa los JavaScript-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
 	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
</head>
<body>
		<div class="row pantalla">
			<div class="col-md-6 logo">				
				<img class="pull-right" src="img/logo.png" alt="Logo Fundación TELMEX">
			</div>
			
			<div class="col-md-6 formulario">
				<form action=""	method="" class="form-horizontal">
				  <div class="form-group">
				    <label for="usuario" class="col-sm-2 control-label">Usuario:</label>
				    <div class="col-sm-6">
				   	 	<input type="email" class="form-control" id="usuario" placeholder="Email o Nombre" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="nip" class="col-sm-2 control-label">NIP:</label>
				    <div class="col-sm-6">
				    	<input type="password" class="form-control" id="nip" placeholder="Password" required>
				    </div>
				  </div>
				  <div class="form-group">
   					 <div class="col-sm-offset-2 col-sm-10 ">
      					<button type="submit" class="btn btn-primary btn-sm">Entrar</button>

    				 </div>
  				  </div>
				</form>
			</div>
		</div>
		<p id="importante"><b>Importante: </b>El acceso a la Intranet de las <b>FILIALES</b>, está sujeto a las condiciones generales y particulares contenidas en el contrato de prestaciones de servicios informáticos suscrito por el usuario y por la empresa.</p>
	
</body>
</html>