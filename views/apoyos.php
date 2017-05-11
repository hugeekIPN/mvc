
<!-- contenedor principal -->
<div class="container col-xs-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
<div id="datable">
	<div class="row col-xs-12 opciones_apoyos ">
		<div class="iconos_h col-xs-2">
			<section class="nuevo ">
					<button id="btn-add-apoyo" onclick="">
						<img src="assets/iconos/Recurso 11.png" alt="Agregar un nuevo apoyo">
						<small>Nuevo</small>
					</button>
			</section>
		</div>
		<section class="filtros col-xs-4 radios ">
			<label class="radio-inline"><input type="radio" name="optradio">En espera</label>
			<label class="radio-inline"><input type="radio" name="optradio">Activo</label>
			<label class="radio-inline"><input type="radio" name="optradio">Cancelado</label>
		</section>
		<section class="filtros col-xs-4 fechas">
			<span class="rango_fechas pull-left">Rango de Fechas</span>
			<div class="form-group col-xs-3">
			 <input type="text" id="datepicker" class="form-control" placeholder="Inicio">
			</div>
			<div class="form-group col-xs-3">
			 <input type="text" id="datepicker2" class="form-control" placeholder="Fin">
			</div>

		</section>
		<section class="filtros col-xs-2">
			<button type="button" class="btn btn-primary btn-lg">Buscar</button>
		</section>
	</div>
	<!-- contenedor de tabla  -->
	<div class="form-group col-xs-12 margin_top" >
			<div class="cont">
	    		<table id="example7" class="display" cellspacing="0" class="table-hover">
	    			<thead>
	    				<tr>
	    					<th>Folio</th>
	    					<th>Concepto</th>
	    					<th>Evento</th>
	    					<th>Factura</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    					<tr>
	    						<td>1</td>
	    						<td>unos</td>
	    						<td>unos2</td>
	    						<td>dato</td>
	    					</tr>
	    					
	    			</tbody>
	    		</table>	
	    	</div>   
	</div>
	<section class="div_reportes">
			<h4 class="generar_reportes col-xs-4"> Rango de fechas para generar reporte:</h4>
			
			<div class="form-group col-xs-3">
			 <input type="text" id="datepicker3" class="form-control" placeholder="Inicio">
			</div>
			<div class="form-group col-xs-3">
			 <input type="text" id="datepicker4" class="form-control" placeholder="Fin">
			</div>
			<div class="reporte form-group col-xs-2">
				<button class="btn btn-primary"> Generar reporte</button>
			</div>
		</section>
</div>
	<!-- fin contenedor de tabla -->


	<!-- cotenedor para el form de apoyos-->
	<div class="form-group col-xs-12 contenedor_apoyos" id="contenedor-apoyos">

			<!-- para errores del back  -->
			<div class="">
				<div id="mensajes-server"></div>
			</div>   
			<!-- contenedor formulario -->
			<div id="cont-formulario-apoyo" class="form_apoyos">

			<h1 class="titulo_centrado">Capturar Apoyos<span class=" form-group col-xs-2">
						<select type="text" class="form-control" name="frecuencia" id="frecuencia" >
							<option value="activo">Activo</option>
							<option value="espera">Espera</option>
							<option value="cancelado">Cancelado</option>
							<option value="finalizado">Finalizado</option>
														
						</select>
					</span>
				<button class="btn btn-sm btn-danger pull-right" id="close">X</button>
				 <span class="pull-right"><button class="btn btn-primary">Guardar</button></span>
				</h1>

				<!-- formularios -->
				<form id="formulario-libreto-ana-maria">
			
					
					<div class=" form-group col-xs-6">
						<label for="concepto">Concepto</label>
						<input type="text" class="form-control" name="concepto" id="concepto" >
					</div>

					<div class=" form-group col-xs-6">
						<label for="abono">Abono</label>
						<input type="text" class="form-control" name="abono" id="abono" >
					</div >
					<h3 class="h3form">1.- Libreta Ana María</h3> 
					<div class=" input form-group col-xs-3">
						<label for="reflibretaana">Referencia Libreta Ana Maria</label>
						<input type="text" class="form-control" name="reflibretaana" id="reflibretaana" value="" disabled>
					</div>
					<div class=" input form-group col-xs-3">
						<label for="mescaptura">Mes de Captura</label>
						<input type="text" class="form-control" name="mescaptura" id="mescaptura" value="" >

					</div>
					<div class="form-group col-xs-3">
					<label for="fechacaptura">Fecha de Captura</label>
					 <input type="text" id="datepicker5" name="fechacaptura" class="form-control" placeholder="Fecha">
					</div>
					<div class="form-group col-xs-3">
					<label for="mescontableana">Mes contable</label>
					 <input type="text" id="mescontableana" name="mescontableana" class="form-control" >
					</div>

				</form>
				<div>
				<form id="formulario-captura-apoyos">
					<h3 class="h3form">2.- Captura Apoyos</h3>
					<div class=" form-group col-xs-2">
						<label for="folio_apoyo">Folio</label>
						<input type="text" class="form-control" name="folio_apoyo" id="folio_apoyo" >
					</div>
					<div class=" form-group col-xs-2">
						<label for="frecuencia">Frecuencia</label>
						<select type="text" class="form-control" name="frecuencia" id="frecuencia" >
							<option value="anual">Anual</option>
							<option value="bimestral">Bimestral</option>
							<option value="mensual">Mensual</option>
							<option value="quincenal">Quincenal</option>
							<option value="semanal">Semanal</option>
							<option value="unico">Único</option>
						</select>
					</div>
					
					<div class=" form-group col-xs-3">
						<label for="evento">Evento</label>
						<select type="text" class="form-control" name="evento" id="evento" >
							<?php foreach ($eventos as $evento): ?>
								<option value="<?=$evento['id_evento'];?>"><?php echo $evento['nombre']; ?></option>
							<?php endforeach;?>
						</select>
					</div>

					<div class=" form-group col-xs-2">
						<label for="proveedor">Proveedor</label>
						<select type="text" class="form-control" name="proveedor" id="proveedor" >
							<?php foreach ($proveedores as $proveedor): ?>
								<option value="<?=$proveedor['id_proveedor'];?>"><?php echo $proveedor['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
					</div >
					 
					
					<div class=" form-group col-xs-2">
						<label for="Tipodeapoyo">Tipo de Apoyo</label>
						<select type="text" class="form-control" name="Tipodeapoyo" id="Tipodeapoyo" >
							<option value="especie">Especie</option>
							<option value="importe">Importe</option>
						</select>
					</div >
					<div class=" form-group col-xs-1">
						<label for="paises">País</label>
						<select type="text" class="form-control" name="paises" id="paises" >
							<option value="">Lista de paises</option>
						</select>
					</div >

					<div class=" form-group col-xs-3">
						<label for="estadooregion">Estado o Región</label>
						<select type="text" class="form-control" name="estadooregion" id="estadooregion" >
							<option value="">Listado de estados y regiones</option>
						</select>
					</div >
					
					<div class=" form-group col-xs-2">
						<label for="numerodefactura">Número de Factura</label>
						<input type="text" class="form-control" name="numerodefactura" id="numerodefactura" >
					</div>
					<div class=" form-group col-xs-2">
						<label for="importe_apoyo">Importe</label>
						<input type="text" class="form-control" name="importe_apoyo" id="importe_apoyo" >
					</div>
					<div class=" form-group col-xs-2">
						<label for="moneda_apoyo">Moneda</label>
						<select type="text" class="form-control" name="moneda_apoyo" id="moneda_apoyo" >
							<option value="">Moneda Nacional</option>
							<option value="">Dólares Americanos</option>
							<option value="">Euro</option>
						</select>
					</div >
					<div class=" form-group col-xs-2">
						<label for="referencia_apoyo">Referencia</label>
						<input type="text" class="form-control" name="referencia_apoyo" id="referencia_apoyo" >
					</div>
					<div class=" form-group col-xs-6">
						<label for="observaciones">Observaciones</label>
						<textarea rows="1" type="text" class="form-control" name="observaciones" id="observaciones" >
						</textarea>
					</div>
					<div class=" input form-group col-xs-6">
						<label for="descripcionapoyo">Descripción de Apoyo</label>
						<textarea   rows="1" class="form-control" name="descripcionapoyo" id="descripcionapoyo" >
						</textarea>
					</div>
					

				</form>
				</div>
				<!--INICIO IMPRIMIBLES -->
				<div class="row imprimibles">
					<div class=" input form-group col-xs-2">
						<button>
							<figure><img src="assets/iconos/Recurso 13.png" alt="Cuentas por pagar"></figure>
							<p>Cuenta por pagar</p>
						</button>
						
					</div>
					<div class=" input form-group col-xs-2">
						<button>
							<figure><img src="assets/iconos/Recurso 16.png" alt="Póliza sin cheque"></figure>
							<p>Póliza sin cheque</p>
						</button>
						
					</div>
					<div class=" input form-group col-xs-2">
						<button>
							<figure><img src="assets/iconos/Recurso 17.png" alt="transferencia"></figure>
						
						<p>Transferencia</p>
						</button>
					</div>
					<div class=" input form-group col-xs-2">
						<button>
							<figure><img src="assets/iconos/Recurso 15.png" alt="Cheque"></figure>
						
						<p>Cheque</p>
					</button>
					</div>
				</div><!-- Fin de imprimibles -->
				<form id="formulario-libretaflujo">
					<h3 class="h3form">3.- Libreta Flujo </h3>
					
					<div class="form-group col-xs-3">
					<label for="mescontableflujo">Mes contable</label>
					 <input type="text" id="mescontableflujo" name="mescontableflujo" class="form-control" >
					</div>
					<div class=" form-group col-xs-3">
						<label for="fechadoctosalida">Fecha de documento de salida</label>
						<input type="text" id="datepicker6" class="form-control" placeholder="Click">
					</div >
					 
					<div class=" input form-group col-xs-3">
						<label for="documentosalida">Documento Salida</label>
						<input type="text" class="form-control" name="documentosalida" id="documentosalida" value="">
					</div>
					<div class=" input form-group col-xs-3">
						<label for="poliza">Póliza</label>
						<input type="text" class="form-control" name="poliza" id="poliza" value="">
					</div>
					<div class=" input form-group col-xs-4">
						<label for="cargo">Cargo</label>
						<input type="text" class="form-control" name=cargo" id="cargo" value="">
					</div>
					<div class=" input form-group col-xs-4">
						<label for="poliza">Abono</label>
						<input type="text" class="form-control" name="poliza" id="poliza" value="">
					</div>
					<div class=" input form-group col-xs-4">
						<label for="poliza">Saldo</label>
						<input type="text" class="form-control" name="poliza" id="poliza" value="" disabled>
					</div>
				</form>
					<button class="btn btn-primary pull-right">Guardar</button>
				
				<!--Subir archivos -->
				<div class="row subir-archivos">
					<h3>Subir Archivos PDF y XML</h3>
					<table class="table table-striped center">
						<thead>
							<td>Núm.</td>
							<td>PDF</td>
							<td>XML</td>
							<td>Eliminar</td>
						</thead>
						<tbody>
						  <tr class="success">
						  	<td  id="id_upload">1</td>
						  	<td id="u_pdf"><button class="btn btn-primary">Subir</button></td>
						  	<td id="u_xml"><a href="#">Archivo.xml</a></td>
						  	<td id="borrar_fila_u"><button class="btn btn-danger">Eliminar</button></td>
						  </tr>
						  
						  <tr class="warning">
						  	<td id="id_upload">2</td>
						  	<td id="u_pdf"><a href="#">Archivo.pdf</a></td>
						  	<td id="u_xml"><button class="btn btn-primary">Subir</button></td>
						  	<td id="borrar_fila_u"><button class="btn btn-danger">Eliminar</button></td>
						  </tr>
						  <tr class="success">
						  	<td  id="id_upload">3</td>
						  	<td id="u_pdf">
								<label for="archivo_pdf" class="btn-primary cargar"> Subir</label>
								<input class="inputfile" type="file"  accept=".pdf" name="archivo_pdf">	
						  	</td>
						  	<td id="u_xml"><a href="#">Archivo.xml</a></td>
						  	<td id="borrar_fila_u"><button class="btn btn-danger">Eliminar</button></td>
						  </tr>
						  
						  <tr class="warning">
						  	<td id="id_upload">4</td>
						  	<td id="u_pdf"><a href="#">Archivo.pdf</a></td>
						  	<td id="u_xml">
						  		<label for="archivo_xml" class="btn-primary cargar"> Subir</label>
								<input class="inputfile" type="file"  accept=".xml" name="archivo_xml">	
							</td>
						  	<td id="borrar_fila_u"><button class="btn btn-danger">Eliminar</button></td>
						  </tr>
						  
						</tbody>
					</table>
					<div class=" center">
						<label for="archivo_up_pdf" class="cargar  btn-success"> Nuevo PDF</label>
						<input class="inputfile" type="file" id="archivo_up_pdf" accept=".pdf" name="archivo_pdf">
						<label for="archivo_up_xml" class="cargar btn-success"> Nuevo XML</label>
						<input class="inputfile" type="file" id="archivo_up_xml" accept=".xml" name="archivo_xml">	
					</div>
					
				<!-- Fin de subir archivos -->

			</div>
			<!-- fin formulario -->

	</div>

</div>
<!-- fin contenedor principal -->


