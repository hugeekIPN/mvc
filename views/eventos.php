<div class="container col-md-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
	<div class="form-group col-md-6 izq">
	        <div class="col-md-12 registros">
	        	<div class="cont">
					<table id="example" class="display" cellspacing="0" >
					   <thead>
					      <tr>
					      	 <th>ID</th>
					         <th>Nombre del Evento</th>
					         <th>Subprograma</th>
					      </tr>
					   </thead>
					   <tbody>
                           <?php foreach ($eventos as $evento): ?>
					   		<tr onclick="eventos.verEvento(<?php echo $evento['id_evento']; ?>);">
					   			<td><?=$evento['id_evento'];?></td>
					   			<td><?=$evento['nombre'];?></td>
					   			<td><?php echo $evento['nombre_subprograma']; ?></td>
                            </tr>
					   		<?php endforeach;?>
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
				<form  class="formulario-eventos" action="" id="eventos">
					<input type="hidden" name="id-subprograma" id="id-subprograma">
                    	<div class="input form-group">
						<label class="control-label" for="selectSubprograma">SubPrograma:</label>
						<select name="selectSubprograma" id="selectSubprograma" class="form-control">
							<?php foreach ($subprogramas as $subprograma): ?>
								<option value="<?=$subprograma['id_subprograma'];?>"><?php echo $subprograma['nombre']; ?></option>
							<?php endforeach;?>
						</select>
					</div>
					<div class="input form-group">
					  <label class="control-label" for="inputNombreEventos">Nombre:</label>
					  <input required type="text" class="form-control" id="inputNombreEventos">
					</div>
					<div class="input form-group">
					  <label class="control-label" for="inputDescripcionEventos">Descripción:</label>
					  <textarea  class="form-control" id="inputDescripcionEventos" cols="2" ></textarea>
					</div>

				</form>
				<!-- fin formulario -->

				<!-- datos a mostrar en texto plano -->
				<div hidden id="datos-evento">
					<p><strong>ID</strong></p>
					<p class="id-datos id" id="vista-id"></p>
					<p>SubPrograma</p>
					<p id="vista-subProgId"></p>
					<p>Nombre del Evento</p>
					<p id="vista-nombre"></p>
					<p>Descripci&oacute;n</p>
					<p id="vista-desc"></p>
				</div>
				<!-- fin datos a mostrar para subprogramas -->
		</div>
		<!-- fin contenedor formulario y datos -->

		<!-- contenedor iconos -->
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button id="btn-add-evento" onclick="location.reload();">
					<img src="assets/iconos/Recurso 11.png" alt="Editar">
					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button onclick="eventos.editEvento();" hidden id="btn-edit-evento">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button id="btn-update-evento" onclick="eventos.addEvento();"  >
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button onclick="eventos.deleteEvento();" hidden id="btn-delete-evento">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>

		</div>
	</div>
</div>
