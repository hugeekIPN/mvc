
<!-- contenedor principal -->


<div class="container col-xs-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
<div id="datable">
	<div class="row col-xs-12 opciones_apoyos ">
		<div class="iconos_h col-xs-2">
			<section class="nuevo ">
					<button id="btn-add-apoyo" onclick="apoyo.nuevo();">
						<img src="assets/iconos/Recurso 11.png" alt="Agregar un nuevo apoyo">
						<small>Nuevo</small>
					</button>
			</section>
		</div>
		<section class="filtros col-xs-4 radios " >
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
	    		<table id="example7" class="display" cellspacing="0" class="table-hover" >
	    			<thead>
	    				<tr>
	    					<th>Folio</th>
	    					<th>Concepto</th>
	    					<th>Evento</th>
	    					<th>Factura</th>
	    				</tr>
	    			</thead>
	    			<?php foreach ($apoyo as $apoyos): ?>
                        <tbody>
	    					<tr onclick="apoyo.verApoyo(<?php echo $apoyos['id_apoyo']; ?>);">
	    						<td><?= $apoyos['id_apoyo']; ?></td>
	    						<td><?= $apoyos['concepto']; ?></td>
	    						<td><?= $apoyos['nombre']; ?></td>
	    						<td><?= $apoyos['factura']; ?></td>
	    					</tr>
	    				</tbody>
                    <?php endforeach; ?>
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

			<h1 class="titulo_centrado">Capturar Apoyos <SPAN style="font-size: 16px;">SALDO ACTUAL:<?= number_format($saldo,2); ?></SPAN><span class=" form-group col-xs-2">
			
						<input type="hidden" name="tipo" id="tipo" value="1">

						<select type="text" class="form-control" name="status" id="status" >
							<option value="1">Activo</option>
							<option value="2">Espera</option>
							<option value="3">Cancelado</option>
							<option value="4">Finalizado</option>
														
						</select>
					</span>
				<button class="btn btn-sm btn-danger pull-right" id="close">X</button>
				<span class="pull-right margin_left"><button  onclick="apoyo.deleteApoyo();" class="btn btn-primary" id="btn-delete">Eliminar</button></span>
				<span class="pull-right margin_left"><button onclick="apoyo.add();" class="btn btn-primary" id="btn-save">Guardar</button></span>
				<span class="pull-right margin_left"><button id="btn-new" onclick="apoyo.nuevo();" class="btn btn-primary">Nuevo</button></span>
				
				 
				</h1>

				<!-- formularios -->
				<form id="formulario-libreto-ana-maria">
			
					<input type="hidden" class="form-control" name="id-apoyo" id="id-apoyo" >

					<div class=" form-group col-xs-6">
						<label for="concepto">Concepto</label>
						<input type="text" class="form-control" name="concepto" id="concepto" >
					</div>

					<div class=" form-group col-xs-6">
						<label for="abono">Abono</label>
						<input type="text" onblur="apoyo.abono();" class="form-control" name="abono" id="abono" value="0.00" >
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
					 <input type="text" id="fechacaptura" name="fechacaptura" class="form-control" placeholder="Fecha">
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
							<option value="6">Anual</option>
							<option value="5">Bimestral</option>
							<option value="4">Mensual</option>
							<option value="3">Quincenal</option>
							<option value="2">Semanal</option>
							<option value="1">Único</option>
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
						<label for="donatario">Donatario</label>
						<select type="text" class="form-control" name="donatario" id="donatario" >
							<?php foreach ($donatarios as $donatario): ?>
								<option value="<?=$donatario['id_proveedor'];?>"><?php echo $donatario['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
					</div >
					 
					
					<div class=" form-group col-xs-2">
						<label for="Tipodeapoyo">Tipo de Apoyo</label>
						<select type="text" class="form-control" name="Tipodeapoyo" id="Tipodeapoyo" >
							<option value="2">Especie</option>
							<option value="1">Importe</option>
						</select>
					</div >
					<div class=" form-group col-xs-1">
						<label for="paises">País</label>
						<select type="text" class="form-control" name="paises" id="paises" onchange="apoyo.pais();" >
							<option value="">Lista de paises</option>
							<option value="México">México</option>
							<option value="EUA">EUA</option>
							<option value="Otro">Otro</option>
						</select>

							<input type="hidden" class="form-control" name="otro_text" id="otro_text" >

					</div >

					<div class=" form-group col-xs-3">
						<label for="estadooregion">Estado o Región</label>
						<select type="text" class="form-control" name="estadooregion" id="estadooregion" >
							<option value="">Listado de estados y regiones</option>
							<option value="Aguascalientes">Aguascalientes</option>
	                        <option value="Baja California">Baja California</option>
	                        <option value="Baja California Sur">Baja California Sur</option>
	                        <option value="Campeche">Campeche</option>
	                        <option value="Chiapas">Chiapas</option>
	                        <option value="Chihuahua">Chihuahua</option>
	                        <option value="Coahuila">Coahuila</option>
	                        <option value="Colima">Colima</option>
	                        <option value="Ciudad de México" selected>Ciudad de México</option>
	                        <option value="Durango">Durango</option>
	                        <option value="Estado de México">Estado de México</option>
	                        <option value="Guanajuato">Guanajuato</option>
	                        <option value="Guerrero">Guerrero</option>
	                        <option value="Hidalgo">Hidalgo</option>
	                        <option value="Jalisco">Jalisco</option>
	                        <option value="Michoacán">Michoacán</option>
	                        <option value="Morelos">Morelos</option>
	                        <option value="Nayarit">Nayarit</option>
	                        <option value="Nuevo León">Nuevo León</option>
	                        <option value="Oaxaca">Oaxaca</option>
	                        <option value="Puebla">Puebla</option>
	                        <option value="Querétaro">Querétaro</option>
	                        <option value="Quintana Roo">Quintana Roo</option>
	                        <option value="San Luis Potosí">San Luis Potosí</option>
	                        <option value="Sinaloa">Sinaloa</option>
	                        <option value="Sonora">Sonora</option>
	                        <option value="Tabasco">Tabasco</option>
	                        <option value="Tamaulipas">Tamaulipas</option>
	                        <option value="Tlaxcala">Tlaxcala</option>
	                        <option value="Veracruz">Veracruz</option>
	                        <option value="Yucatán">Yucatán</option>
	                        <option value="Zacatecas">Zacatecas</option>
						</select>

						<input type="hidden" class="form-control" name="estado" id="estado" >
					</div >
					
					<div class=" form-group col-xs-2">
						<label for="numerodefactura">Número de Factura</label>
						<input type="text" class="form-control" name="numerodefactura" id="numerodefactura" >
					</div>
					<div class=" form-group col-xs-2">
						<label for="importe_apoyo">Importe</label>
						<input type="text" class="form-control" name="importe_apoyo" id="importe_apoyo" disabled="">
					</div>
					<div class=" form-group col-xs-2">
						<label for="moneda_apoyo">Moneda</label>
						<select type="text" class="form-control" name="moneda_apoyo" id="moneda_apoyo" >
							<option value="1">Moneda Nacional</option>
							<option value="2">Dólares Americanos</option>
							<option value="3">Euro</option>
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
						<button onclick="window.location.href='index.php?op=cuenta'">
							<figure><img src="assets/iconos/Recurso 13.png" alt="Cuentas por pagar"></figure>
							<p>Cuenta por pagar</p>
						</button>
						
					</div>
					<div class=" input form-group col-xs-2">
						<button onclick="window.location.href='index.php?op=poliza'">
							<figure><img src="assets/iconos/Recurso 16.png" alt="Póliza sin cheque"></figure>
							<p>Póliza sin cheque</p>
						</button>
						
					</div>
					<div class=" input form-group col-xs-2">
						<button onclick="window.location.href='index.php?op=solicitud'">
							<figure><img src="assets/iconos/Recurso 17.png" alt="transferencia"></figure>
						
						<p>Transferencia</p>
						</button>
					</div>
					<div class=" input form-group col-xs-2">
						<button onclick="window.location.href='index.php?op=cheque'">
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
						<input type="text" id="fechadoctosalida" class="form-control" placeholder="Click">
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
						<label for="abono">Abono</label>
						<input type="text" class="form-control" name="abono2" id="abono2" value="" disabled="">
					</div>
					<div class=" input form-group col-xs-4">
						<label for="saldo">Saldo capturado:</label>
						<input type="text" class="form-control" name="saldo" id="saldo" value="<?= $saldo; ?>" disabled>
					</div>
				</form>
					<button onclick="apoyo.add();" class="btn btn-primary pull-right" id="btn-save2">Guardar</button>
				
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
					<form id="formArchivos" enctype="multipart/form-dat" method="post"> 
						<div class=" center">
						<label for="archivo_up_pdf" class="cargar  btn-success"> Nuevo PDF</label>
						<input class="inputfile" type="file" id="archivo_up_pdf" accept=".pdf" name="archivo_pdf">
						<label for="archivo_up_xml" class="cargar btn-success"> Nuevo XML</label>
						<input class="inputfile" type="file" id="archivo_up_xml" accept=".xml" name="archivo_xml">	
						</div>
						<input class="input" type="hidden" id="id_apoyo_gasto"  name="id_apoyo_gasto" value="">





						
						<input class="submit" type="submit" id="submitArchivos"  name="submitArchivos" >	
					</form>
					<div id="mensaje"></div>
					
				<!-- Fin de subir archivos -->

			</div>
			<!-- fin formulario -->

	</div>

</div>
<!-- fin contenedor principal -->


