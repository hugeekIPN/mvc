
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
	    		<table id="example1" class="display" cellspacing="0" class="table-hover">
	    			<thead>
	    				<tr>
	    					<th>Folio</th>
	    					<th>Nombre</th>
	    					<th>Fecha</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    					<tr>
	    						<td>1</td>
	    						<td>unos</td>
	    						<td>unos2</td>
	    					</tr>
	    					<tr>
	    						<td>1</td>
	    						<td>unos</td>
	    						<td>unos2</td>
	    					</tr>
	    					<tr>
	    						<td>1</td>
	    						<td>unos</td>
	    						<td>unos2</td>
	    					</tr>
	    					<tr>
	    						<td>1</td>
	    						<td>unos</td>
	    						<td>unos2</td>
	    					</tr>
	    			</tbody>
	    		</table>	
	    	</div>   
	</div>
</div>
	<!-- fin contenedor de tabla -->


	<!-- cotenedor para el form de apoyos-->
	<div class="form-group col-xs-12 contenedor_apoyos" id="contenedor-apoyos">

			<!-- para errores del back  -->
			<div class="">
				<div id="mensajes-server"></div>
			</div>   
			<!-- contenedor formulario -->
			<div id="cont-formularios-apoyo" class="form_apoyos">

			<h1 class="titulo_centrado">Capturar Apoyos <button class="btn btn-sm btn-danger pull-right" id="close">X</button></h1>

				<!-- formularios -->
				<form id="formulario-libreto-ana-maria">
			
					<div class=" form-group col-xs-4">
						<label for="mescontable">Mes Contable</label>
						<input type="text" class="form-control" name="mescontable" id="mescontable" >
					</div>
					
					<div class=" form-group col-xs-4">
						<label for="concepto">Concepto</label>
						<input type="text" class="form-control" name="concepto" id="concepto" >
					</div>

					<div class=" form-group col-xs-4">
						<label for="abono">Abono</label>
						<input type="text" class="form-control" name="abono" id="abono" >
					</div >
					<h3 class="h3form">1.- Libreta Ana María</h3> 
					<div class=" input form-group">
						<label for="reflibretaana">Referencia Libreta Ana Maria</label>
						<input type="text" class="form-control" name="reflibretaana" id="reflibretaana" value="">
					</div>

				</form>
				<div>
				<form id="formulario-captura-apoyos">
					<h3 class="h3form">2.- Captura Apoyos</h3>
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
							<option value="">Desplegar eventos</option>
						</select>
					</div>

					<div class=" form-group col-xs-3">
						<label for="proveedor">Proveedor</label>
						<select type="text" class="form-control" name="proveedor" id="proveedor" >
							<option value="">Desplegar proveedores</option>
						</select>
					</div >
					 
					
					<div class=" form-group col-xs-2">
						<label for="Tipodeapoyo">Tipo de Apoyo</label>
						<select type="text" class="form-control" name="Tipodeapoyo" id="Tipodeapoyo" >
							<option value="especie">Especie</option>
							<option value="importe">Importe</option>
						</select>
					</div >
					<div class=" form-group col-xs-2">
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
					
					<div class=" form-group col-xs-3">
						<label for="numerodefactura">Número de Factura</label>
						<input type="text" class="form-control" name="numerodefactura" id="numerodefactura" >
					</div>
					<div class=" form-group col-xs-3">
						<label for="importe_apoyo">Importe</label>
						<input type="text" class="form-control" name="importe_apoyo" id="importe_apoyo" >
					</div>
					<div class=" form-group col-xs-3">
						<label for="moneda_apoyo">Moneda</label>
						<select type="text" class="form-control" name="moneda_apoyo" id="moneda_apoyo" >
							<option value="">Moneda Nacional</option>
							<option value="">Dólares Americanos</option>
							<option value="">Euro</option>
						</select>
					</div >
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
				<form id="formulario-libretaflujo">
					<h3 class="h3form">3.- Libreta Flujo </h3>
					<div class=" form-group col-xs-6">
						<label for="fechareferencia">Fecha Referencia</label>
						<input type="text" class="form-control" name="fechareferencia" id="fechareferencia" >
					</div>
					
					<div class=" form-group col-xs-6">
						<label for="referenciasflujo">Referencia Flujo</label>
						<input type="text" class="form-control" name="referenciasflujo" id="referenciasflujo" >
					</div>

					<div class=" form-group col-xs-4">
						<label for="fechadoctosalida">Fecha de documento de salida</label>
						<input type="text" class="form-control" name="fechadoctosalida" id="fechadoctosalida" >
					</div >
					 
					<div class=" input form-group col-xs-4">
						<label for="documentosalida">Documento Salida</label>
						<input type="text" class="form-control" name="documentosalida" id="documentosalida" value="">
					</div>
					<div class=" input form-group col-xs-4">
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
						<input type="text" class="form-control" name="poliza" id="poliza" value="">
					</div>
				</form>
			</div>
			<!-- fin formulario -->
	</div>

</div>
<!-- fin contenedor principal -->


