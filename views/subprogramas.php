<div class="container container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
	<div class="form-group col-md-6 izq">
	       
	        <div class="col-md-12 registros">
	        	<div class="cont">
					<table id="example" class="display" cellspacing="0" >
					   <thead>
					      <tr>
					      	 <th>ID</th>
					         <th>Subprograma</th>
					         <th>Programa</th>
					      </tr>
					   </thead>
					   <tbody>					      
					   		<?php foreach ($subprogramas as $subprograma): ?>
					   		<tr onclick="subprogramas.verSubprograma(<?php echo $subprograma['id_subprograma']; ?>);">
					   			<td> <?php echo $subprograma['id_subprograma']; ?>
					   			</td>

					   			<td>
					   				<?php echo $subprograma['nombre']; ?>
					   			</td>
					   			<td>
					   				<?php echo $subprograma['nombre_programa']; ?>
					   			</td>
					   		</tr>	
					   		<?php endforeach ?>
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
				<form id="formulario-subprogramas">
					<input type="hidden" name="id-subprograma" id="id-subprograma">

					<div class="input form-group">
						<label class="control-label" for="selectPrograma">Programa:</label>
						<select name="selectPrograma" id="selectPrograma" class="form-control">
							<?php foreach ($programas as $programa): ?>
								<option value="<?php echo $programa['id_programa']; ?>"><?php echo $programa['nombre']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>

					<div class="input form-group">
					  <label class="control-label" for="inputNombreSubprogramas">Nombre:</label>
					  <input required type="text" class="form-control" id="inputNombreSubprogramas">
					</div>
					<div class="input form-group">
					  <label class="control-label" for="inputDescripcionSubprogramas">Descripción:</label>
					  <textarea  class="form-control" id="inputDescripcionSubprogramas" cols="2" ></textarea>
					</div>

				</form>
				<!-- fin formulario -->

				<!-- datos a mostrar en texto plano -->
				<div hidden id="datos-subprogramas">
					<p><strong>ID</strong></p>		
					<p class="id-datos id" id="view-id-subprograma"></p>

					<p>Nombre del programa al que pertenece</p>
					<p id="view-nombre-programa"></p>

					<p>Nombre del subprograma</p>	
					<p id="view-nombre-subprograma"></p>

					<p>Descripcion</p>
					<p id="view-descripcion-subprograma"></p>
				</div>
				<!-- fin datos a mostrar para subprogramas -->					
		</div>
		<!-- fin contenedor formulario y datos -->

		<!-- contenedor iconos -->
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button id="btn-add-subprograma" onclick="location.reload();">
					<img src="assets/iconos/Recurso 11.png" alt="Editar">
					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button onclick="subprogramas.editSubprograma();" hidden id="btn-edit">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button id="btn-save" onclick="subprogramas.add();"  >
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button onclick="subprogramas.deleteSubprograma();" hidden id="btn-delete">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>
			
		</div>
	</div>
</div>