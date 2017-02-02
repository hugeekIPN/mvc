<div class="container container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
	<div class="form-group col-md-6 izq">
	        <div class="col-md-8 ">
	           <!-- <form action="" class="search-form">
	                <div class="form-group has-feedback">
	            		<input type="text" class="form-control" name="search" id="search" placeholder="Buscar...">
	              		<span class="glyphicon glyphicon-search form-control-feedback"></span>
	            	</div>
	            </form> -->
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
	<div class="form-group col-md-6 der">
		<div class="datos col-md-10">
			<div class="datos-bancarios col-md-6" >
				<p ><small><strong>ID</strong></small></p>
				<p class="id-datos id " id="estado"><strong><?php echo $user['id_usuario'] ?></strong></p>
				<p><small><strong>Nombre:</strong></small></p>
				<p class="id-datos nombre"><strong><?php echo $user['nombre'] ?></strong></p>	
				<h3>Datos Generales</h3>
				<br>
                                          
            <form id="form-add-usuario">
                <input type="hidden" name="usuarioId" id="usuarioId">
                <label for="username">Nombre de usuario</label>
                <input type="text" class="form-control" name="username" id="username" value="">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                <label for="password-confirm">Confirmar password</label>
                <input type="password" class="form-control" name="password-confirm" id="password-confirm" value="">
                   
                                                                    
                                                                    

			</div>
		</div>
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button id="btn-add-user">
					<img src="assets/iconos/Recurso 11.png" alt="Nuevo">
					<small >Nuevo</small>
				</button>
			</section>
			<section>
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
				<button>
			</section>
           </form>
		</div>
	</div>
</div>
                                                                       
                                                                       
<!-- estilo con datatable de bootstrap -->

<table>
	<tr>
		<th>Id</th>
		<th>Nombre de usuario</th>
		<th>Acci&oacute;n</th>
		<th>Acci&oacute;n</th>
	</tr>

	<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo $user['id_usuario'] ?></td>
			<td><?php echo $user['email'] ?></td>
			<td><button onclick="usuarios.editUser(<?php echo $user['id_usuario']; ?>);">Editar</button></td>
			<td><button onclick="usuarios.deleteUser(<?php echo $user['id_usuario'] ?>);">Eliminar</button></td>
		</tr>
	<?php endforeach; ?>
	
</table>







