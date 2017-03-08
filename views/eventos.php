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
					<table id="example2" class="display" cellspacing="0" width="100%"" class="table-hover">                                                                               
                                                                                                         
					   <thead>
					      <tr>
					      	 <th>ID</th>
					         <th>Nombre del Evento</th>
					         <th>Proveedor</th>
					      </tr>
					   </thead>
					   <tbody>
                        <?php foreach ($eventos as $evento): ?>                    
					       <tr onclick="eventos.verEvento(<?php echo $evento['id_evento']; ?>);">
					      	 <td><?php echo $evento['id_evento'] ?></td>
					         <td><a href="#" ><?php echo $evento['nombre'] ?> </a></td>
					         <td><a href=""><?php echo $evento['subprogramas_idsubprogramas'] ?> </a></td>
                            </tr>
                        <?php endforeach; ?>
					   </tbody>
					</table>
	        	</div>
	        </div>
		
	</div>
	<div class="form-group col-md-6 der ">
		<div class="datos datos2 col-md-10 eventos">
			<div class="datos-bancarios col-md-10 evento" >
				
				<form  class="formulario" action="" id="eventos">
					<div class="form-group">
					  <label class="control-label" for="inputIDEventos">ID:</label>
					  <input required type="text" class="form-control" id="inputIDEventos">
					  <span class="help-block"></span>
					</div>
					<div class="form-group ">
					  <label class="control-label" for="inputIDSubEventos">ID Subprograma:</label>
					  <input required type="text" class="form-control" id="inputIDSubEventos">
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputNombreEventos">Nombre:</label>
					  <input required type="text" class="form-control" id="inputNombreEventos">
					</div>
					<div class="form-group">
					  <label class="control-label" for="inputDescripcionEventos">Descripción:</label>
					  <textarea  class="form-control" id="inputDescripcionEventos" cols="2" ></textarea>
					</div>
					<div class="col-md-12">
						<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label" for="inputPaisEventos">País:</label>
							  <input  class="form-control" id="inputPaisEventos"  ></input>
							</div>
							<div class="form-group">
							  <label class="control-label" for="inputCiudadEventos">Ciudad:</label>
							  <input type="text"  class="form-control" id="inputCiudadEventos" ></input>
							</div>
							<!-- div class="form-group">
							  <label class="control-label" for="inputEntidadEventos">Entidad:</label>
							  <select class="form-control" id="inputEntidadEventos" >
							  	<option value="uno">México</option>
							  </select> 
							</div -->
						</div>
						<div class="col-md-6">
							<div class="form-group">
							  <label class="control-label" for="inputEntidadEventos">Estado:</label>
							  <select class="form-control" id="inputEntidadEventos" >
									  	<option value="uno">México</option>
									  	<option value="uno">Mérida</option>
									  	<option value="uno">Guanajuato</option>
									  	<option value="uno">Michoacán</option>
									  </select> 
							</div>
							<div class="form-group">
							  <input type="hidden" class="form-control" id="inputFechaCreacionEventos" " value="<?php echo date("Y-m-d H:i:s"); ?>" ></input>
							</div>
						</div>
					</div>
					
					

				</form>
			</div>
            <!-- contenedor para visualizar datos de usuario -->
			<div hidden id="datos-evento" >
				<p ><strong>ID</strong></p>
				<p class="id-datos id " id="vista-id"><strong></strong></p>
                <p>Subprograma</p>
				<p id="vista-subProgId"></p>
				<p>Nombre</p>
				<p id="vista-nombre"></p>
                
				<p>Descripción</p>
				<p id="vista-desc"></p>
                <p>Pais</p>
				<p id="vista-pais"></p>
                <p>Ciudad</p>
				<p id="vista-ciudad"></p>
                <p>Estado</p>
				<p id="vista-entidad"></p>
                <p>Entidad</p>
				<p id="vista-estado"></p>
                <p>Fecha:</p>
				<p id="vista-fecha"></p>
			</div>
			<!-- fin contenedor para visualizar datos de usuario -->

			
		</div>
		<div class="iconos col-md-2">
			<section class="nuevo">
				<button id="btn-add-evento" onclick="eventos.verFormularioVacio();" >
					<img src="assets/iconos/Recurso 11.png" alt="Editar">
					<small >Nuevo</small>
				</button>
			</section>
			<section >
				<button hidden onclick="eventos.editEvento();" id="btn-edit-evento">
					<img src="assets/iconos/Recurso 7.png" alt="Editar">
					<small >Editar</small>
				</button>
			</section>
			<section >
				<button id="btn-update-evento" type="submit" onclick="eventos.addEvento();">
					<img src="assets/iconos/Recurso 8.png" alt="Guardar">
					<small>Guardar</small>
				</button>
			</section>
			<section >
				<button id="btn-delete-evento" onclick="eventos.deleteEvento();">
					<img src="assets/iconos/Recurso 9.png" alt="Borrar">
					<small>Borrar</small>
				</button>
			</section>
			
		</div>
	</div>
</div>