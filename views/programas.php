<div class="container col-md-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
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
					<table id="example3" class="display" cellspacing="0" width="100%"" class="table-hover">
					   <thead>
					      <tr>
					      	 <th>ID</th>
					         <th>Nombre del Programa</th>
					      </tr>
					   </thead>
					   <tbody>
					   		<?php foreach ($programas as $programa): ?>
					   		<tr onclick="programas.verPrograma(<?php echo $programa['id_programa']; ?>);">
					   			<td> <?php echo $programa['id_programa']; ?>
					   			</td>

					   			<td>
					   				<?php echo $programa['nombre']; ?>
					   			</td>
					   		</tr>	
					   		<?php endforeach; ?>
					   </tbody>
					</table>
	        	</div>
	        </div>
		
	</div>

	<!-- contenedor derecho -->
	<div class="form-group col-md-6 der">

		<!-- contenedor formulario y visualizacion de datos en texto plano  -->
		<div class="datos datos2 col-md-10 eventos">
			

				<div class="input">
					<div id="mensajes-server"></div>
				</div>
				
				<!-- formulario -->
				<form id="formulario-programas" class="formulario" >
					<input type="hidden" name="id-programa" id="id-programa">

					<div class="input form-group">
					  <label class="control-label" for="inputNombreProgramas">Nombre:</label>
					  <input required type="text" class="form-control" id="inputNombreProgramas">
					</div>
					<div class="input form-group">
					  <label class="control-label" for="inputDescripcionProgramas">Descripción:</label>
					  <textarea  class="form-control" id="inputDescripcionProgramas" cols="2" ></textarea>
					</div>

				</form>
				<!-- fin formulario -->

				<!-- datos a mostrar en texto plano -->
				<div hidden id="datos-programas">
					<p><strong>ID</strong></p>		
					<p class="id-datos id" id="view-id-programa"></p>

					<p>Nombre</p>	
					<p id="view-nombre-programa"></p>

					<p>Descripcion</p>
					<p id="view-descripcion-programa"></p>
				</div>
				<!-- fin datos a mostrar para programas -->					
		</div>
		<!-- fin contenedor formulario y datos -->

		<!-- contenedor iconos -->
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button id="btn-add-programa" onclick="location.reload();">
					<img src="assets/iconos/Recurso 11.png" alt="Editar">
					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button onclick="programas.editPrograma();" hidden id="btn-edit">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button id="btn-save" onclick="programas.add();"  >
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button onclick="programas.deletePrograma();" hidden id="btn-delete">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>
			
		</div>
	</div>
</div>