
<!-- contenedor principal -->
<div class="container container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">

	<!-- contenedor izquierdo  -->
	<div class="form-group col-md-6 izq">
		<div class="col-md-8 ">
	        <!-- 
	           <form action="" class="search-form">
	                <div class="form-group has-feedback">
	            		<input type="text" class="form-control" name="search" id="search" placeholder="Buscar...">
	              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
	            	</div>
	            </form> 
	        -->
	    </div>
	    <div class="col-md-12 registros">
	    	<div class="cont">
	    		<table id="example" class="display" cellspacing="0" width="100%"" class="table-hover">
	    			<thead>
	    				<tr>
	    					<th>ID</th>
	    					<th>Registros</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				<?php foreach ($users as $user): ?>
	    					<tr>
	    						<td><a href="#"><?php echo $user['id_usuario'] ?></a></td>
	    						<td><a href="#" onclick="usuarios.verUser(<?php echo $user['id_usuario']; ?>);"><?php echo $user['email'] ?></a></td>
	    					</tr>
	    				<?php endforeach; ?>
	    			</tbody>
	    		</table>
	    	</div>
	    </div>
	</div>

	<!-- fin contenedor izquierdo -->


	<!-- conenedor derecho -->
	<div class="form-group col-md-6 der">

		<!-- contenedor datos usuario -->
		<div class="datos col-md-10">
			<h3>Datos Generales</h3>  
			
			<!-- para errores del back  -->
			<div class="input">
				<div id="mensajes-server"></div>
			</div>          

			<form id="formulario-usuario">
				<input type="hidden" name="usuarioId" id="usuarioId">
				
				<div class="input form-group">
					<label for="username">Nombre de usuario</label>
					<input type="text" class="form-control" name="username" id="username" value="">
				</div>

				<div class="input form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control" name="email" id="email" value="">
				</div>

				<div class="input form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" value="">
				</div class="form-group">

				<div class=" input form-group">
					<label for="password-confirm">Confirmar password</label>
					<input type="password" class="form-control" name="password-confirm" id="password-confirm" value="">
				</div>

			</form>
		</div>
		<!-- fin contenedor datos usuario -->		

		<!-- iconos editar,nuevo, eliminar -->
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button id="btn-add-user" onclick="usuarios.addUser();">
					<img src="assets/iconos/Recurso 11.png" alt="Agregar un usuario nuevo">
					<small >Agregar</small>
				</button>
			</section>
			<section hidden>
				<button onclick="usuarios.editUser();">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button id="btn-submit" type="submit">
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button onclick="usuarios.deleteUser();">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>  
		</div>
		<!-- fin iconos editar,eliminar.... -->
	</div>
	<!-- fin contenedor derecho -->

</div>
<!-- fin contenedor principal -->


<!-- contenedor para visualizar datos de usuario -->
<div hidden>

</div>
<!-- fin contenedor para visualizar datos de usuario -->