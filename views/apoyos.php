
<!-- contenedor principal -->
<div class="container col-xs-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
	<div class="row col-xs-12 opciones_apoyos ">
		<div class="iconos_h col-xs-2">
			<section class="nuevo ">
					<button id="btn-add-apoyo" onclick="">
						<img src="assets/iconos/Recurso 11.png" alt="Agregar un nuevo apoyo">
						<small>Nuevo</small>
					</button>
			</section>
		</div>
		<section class="filtros col-xs-3 radios ">
			<label class="radio-inline"><input type="radio" name="optradio">En espera</label>
			<label class="radio-inline"><input type="radio" name="optradio">Activo</label>
			<label class="radio-inline"><input type="radio" name="optradio">Cancelado</label>
		</section>
		<section class="filtros col-xs-5 fechas">
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
	<div class="form-group col-xs-12 margin_top">
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

	<!-- fin contenedor de tabla -->


	<!-- cotenedor para el form de apoyos-->
	<div class="form-group col-xs-12 contenedor_apoyos">

		<!-- contenedor formulario y datos -->
		<div class="datos col-xs-12" id="">
			<!-- para errores del back  -->
			<div class="input">
				<div id="mensajes-server"></div>
			</div>   
			<!-- contenedor formulario -->
			<div id="cont-formulario">
			<h1 class="titulo_centrado">Capturar Apoyos</h1>
				<!-- formulario -->
				<form id="formulario-libreto-ana-maria">
			
					<div class="input form-group col-xs-4">
						<label for="mescontable">Mes Contable</label>
						<input type="text" class="form-control" name="mescontable" id="mescontable" >
					</div>
					
					<div class="input form-group col-xs-4">
						<label for="concepto">Concepto</label>
						<input type="text" class="form-control" name="concepto" id="concepto" >
					</div>

					<div class="input form-group col-xs-4">
						<label for="abono">Abono</label>
						<input type="text" class="form-control" name="abono" id="abono" >
					</div class="form-group">
					<h3>1.- Libreta Ana María</h3> 
					<div class=" input form-group">
						<label for="reflibretaana">Referencia Libreta Ana Maria</label>
						<input type="text" class="form-control" name="reflibretaana" id="reflibretaana" value="">
					</div>

				</form>

				<form id="formulario-captura-apoyo">
					<h3>2.- Captura Apoyos</h3>
					<div class="input form-group">
						<label for="mescontable">Mes Contable</label>
						<input type="text" class="form-control" name="mescontable" id="mescontable" >
					</div>
					
					<div class="input form-group">
						<label for="concepto">Concepto</label>
						<input type="text" class="form-control" name="concepto" id="concepto" >
					</div>

					<div class="input form-group">
						<label for="abono">Abono</label>
						<input type="text" class="form-control" name="abono" id="abono" >
					</div class="form-group">
					 
					<div class=" input form-group">
						<label for="reflibretaana">Referencia Libreta Ana Maria</label>
						<input type="text" class="form-control" name="reflibretaana" id="reflibretaana" value="">
					</div>
				</form>

				<form id="formulario-captura-apoyo">
					<h3>3.- Libreta Flujo </h3>
					<div class="input form-group">
						<label for="fechareferencia">Fecha Referencia</label>
						<input type="text" class="form-control" name="fechareferencia" id="fechareferencia" >
					</div>
					
					<div class="input form-group">
						<label for="referenciasflujo">Referencia Flujo</label>
						<input type="text" class="form-control" name="referenciasflujo" id="referenciasflujo" >
					</div>

					<div class="input form-group">
						<label for="fechadoctosalida">Fecha de documento de salida</label>
						<input type="text" class="form-control" name="fechadoctosalida" id="fechadoctosalida" >
					</div class="form-group">
					 
					<div class=" input form-group">
						<label for="reflibretoana">Referencia Libreto Ana Maria</label>
						<input type="text" class="form-control" name="reflibretoana" id="reflibretoana" value="">
					</div>
				</form>
			</div>
			<!-- fin formulario -->

			<!-- contenedor para visualizar datos de usuario -->
			
		<!-- fin iconos editar,eliminar.... -->
	</div>
	<!-- fin contenedor derecho -->

</div>
<!-- fin contenedor principal -->


