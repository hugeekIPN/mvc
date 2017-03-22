<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<title>LOGIN FUNDACIÓN TELMEX</title>
    

	<!--  Importa los estilos-->
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="assets/css/non-responsive.css">
	<!--  Importa los JavaScript-->
	<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
 	
</head>
<body>
		<div class="row pantalla">
			<div class="col-md-6 logo">				
				<img class="pull-right" src="assets/img/logo.png" alt="Logo Fundación TELMEX">
			</div>
			
			<div class="col-md-6 formulario">
                <div id="errores"></div>
				<form id="login-form" method="post" class="form-horizontal formulario" >
				  <div class="form-group">
				    <label for="username" class="col-sm-2 control-label">Usuario:</label>
				    <div class="col-sm-6">
				   	 	<input type="text" class="form-control" id="login-username" name="username" placeholder="Email o Nombre" required>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="password" class="col-sm-2 control-label">NIP:</label>
				    <div class="col-sm-6">
				    	<input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
				    </div>
				  </div>
				  <div class="form-group">
   					 <div class="col-sm-offset-2 col-sm-10 ">
      					<button type="submit" class="btn btn-primary btn-sm" id="btn-login">Entrar</button>

    				 </div>
  				  </div>
				</form>
                
                  <script type="text/javascript" src="js/utilerias.js"></script>            
    <script type="text/javascript" src="js/login.js"></script>
      
			</div>
		</div>
		<p id="importante"><b>Importante: </b>El acceso a la Intranet de las <b>FILIALES</b>, está sujeto a las condiciones generales y particulares contenidas en el contrato de prestaciones de servicios informáticos suscrito por el usuario y por la empresa.</p>
    
            
	
</body>
   
</html>