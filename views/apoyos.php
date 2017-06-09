
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
							<option value="0" selected>---Seleccione un proveedor------</option>
							<?php foreach ($proveedores as $proveedor): ?>
								<option value="<?=$proveedor['id_proveedor'];?>"><?php echo $proveedor['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
					</div >

					<div class=" form-group col-xs-2">
						<label for="donatario">Donatario</label>
						<select type="text" class="form-control" name="donatario" id="donatario" >
							<option value="0" selected>---Seleccione un donatario------</option>
							<?php foreach ($donatarios as $donatario): ?>
								<option value="<?=$donatario['id_proveedor'];?>"><?php echo $donatario['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
					</div >

					
					<div class=" form-group col-xs-2">
						<label for="Tipodeapoyo">Tipo de Apoyo</label>
						<select type="text" class="form-control" name="Tipodeapoyo" id="Tipodeapoyo" onchange="apoyo.tipoApoyo();">
							<option value="2">Especie</option>
							<option value="1">Importe</option>
						</select>
					</div >

					<div class=" form-group col-xs-2" id="especie_div">
						<label for="especie">Especie</label>
						<select type="text" class="form-control" name="id_especie" id="id_especie">
							<?php foreach ($especies as $especie): ?>
								<option value="<?=$especie['id_especie'];?>"><?php echo $especie['descripcion']; ?></option>
							<?php endforeach;?>
						</select>
					</div >

					<div class=" form-group col-xs-2" id="cantidad_div">
						<label for="cantidad">Cantidad:</label>
						<input type="number" class="form-control" name="cantidad" id="cantidad">
					</div>

					<div class=" form-group col-xs-2" id="unidad_div">
						<label for="unidad">Unidad</label>
						<select type="text" class="form-control" name="unidad" id="unidad" onchange="apoyo.otro();">
							<option value="Otro">otro</option>
							<option value="1">bolsa</option>
							<option value="2">caja</option>
							<option value="3">gr.</option>
							<option value="4">kg.</option>
							<option value="5">lts.</option>
							<option value="6">pza.</option>
							<option value="7">ton.</option>
						</select>
					</div >
					<div class=" form-group col-xs-2" id="otra_especie_div">
						<label for="otro">Otro:</label>
						<input type="text" class="form-control" name="otra_especie" id="otra_especie">
					</div>
					
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
					<div class=" form-group col-xs-3">
						<label for="fecharecibo">Fecha de recibo</label>
						<input type="text" id="fecharecibo" class="form-control" placeholder="Click">
					</div >
					<div class=" form-group col-xs-6">
						<label for="observaciones">Observaciones</label>
						<textarea rows="1" type="text" class="form-control" name="observaciones" id="observaciones" >
						</textarea>
					</div>

					<div class=" form-group col-xs-2">
						<label for="anio_filtro">Año:</label>
						<select type="text" class="form-control" name="anio" id="anio" onchange="apoyo.filtro();">
						 	<?php $anio= date("Y"); 
						 		for($a=2000; $a<=$anio; $a++)
						 		  { ?>
									<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
							<?php } ?>
						</select>
					</div >
					
					<button onclick="apoyo.add();" class="btn btn-primary pull-right" id="btn-save3">Agregar >></button>
				</form>
				</div>
				<!--INICIO IMPRIMIBLES -->
				<div class="row imprimibles">
					<div class=" input form-group col-xs-2">
						<button  data-toggle="modal" data-target="#myModal">
							<figure><img src="assets/iconos/Recurso 13.png" alt="Cuentas por pagar"></figure>
							<p>Cuenta por pagar</p>
						</button>
						
					</div>
					<div class=" input form-group col-xs-2">
						<button onclick="apoyo.verPolizaSinCheque();">
							<figure><img src="assets/iconos/Recurso 16.png" alt="Póliza sin cheque"></figure>
							<p>Póliza sin cheque</p>
						</button>
						
					</div>
					<div class=" input form-group col-xs-2">
						<button data-toggle="modal" data-target="#modal_transf">
							<figure><img src="assets/iconos/Recurso 17.png" alt="transferencia"></figure>
						
						<p>Transferencia</p>
						</button>
					</div>
					<div class=" input form-group col-xs-2">
						<button onclick=apoyo.verCheque();">
							<figure><img src="assets/iconos/Recurso 15.png" alt="Cheque"></figure>
						
						<p>Cheque</p>
					</button>
					</div>
				</div><!-- Fin de imprimibles -->

				<div class="form-group col-xs-12 margin_top" id="tabla_eventos_div">
							<div class="cont">
					    		<table id="tabla_eventos" class="display" cellspacing="0" class="table-hover" >
					    			<thead>
					    				<tr>
					    					<th>Folio</th>
					    					<th>Concepto</th>
					    					<th>Evento</th>
					    					<th>Factura</th>
					    				</tr>

					    			</thead>
					    			<tbody id="tbodyid_eventos">

                              		</tbody>
					    		</table>	
					    	</div>   
				</div>


				<form id="formulario-libretaflujo">
					<h3 class="h3form">3.- Libreta Flujo </h3>
					
					<div class="form-group col-xs-3">
					<label for="mescontableflujo">Mes contable</label>
					 <input type="text" id="mescontableflujo" name="mescontableflujo" class="form-control" >
					</div>
					<div class=" form-group col-xs-3">
						<label for="
						">Fecha de documento de salida</label>
						<input type="text" id="fechadoctosalida" name="fechadoctosalida" class="form-control" placeholder="Click">
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
						<input type="text" class="form-control" name="abono2" id="abono2" value="" disabled="" value="0">
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
					<table class="table table-striped center" id="tabla-archivos">
						<thead>
							<td>Núm.</td>
							<td>PDF</td>
							<td>XML</td>
							<td>Eliminar</td>
						</thead>
						<tbody id="tbodyid">
						
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
						<button onclick="apoyo.addArchivos();" class="btn btn-primary" id="submit_archivos" type="submit">Guardar</button>
					</form>
					<div id="mensaje"></div>
					
				<!-- Fin de subir archivos -->

			</div>
			<!-- fin formulario -->

	</div>

</div>
<!-- fin contenedor principal -->


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cuenta por pagar</h4>
      </div>
      <div class="modal-body">
      
					
					<form id="formArchivos" enctype="multipart/form-dat" method="post"> 
						<div class=" center">
						<label for="cuenta_nombre" > Cuenta a nombre de: </label>
						<select type="text" class="form-control" name="cuenta_nombre" id="cuenta_nombre" >
							<option value="0" selected>---Seleccione un proveedor------</option>
							<?php foreach ($proveedores as $proveedor): ?>
								<option value="<?=$proveedor['id_proveedor'];?>"><?php echo $proveedor['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
						<br/>
						<label for="tipo_cambio"> Tipo de cambio: </label>
						<input class="input" type="text" id="tipo_cambio" name="tipo_cambio">	
						a <select type="text" class="form-control" name="moneda_modal" id="moneda_modal" >
							<option value="1">Moneda Nacional</option>
							<option value="2">Dólares Americanos</option>
							<option value="3">Euro</option>
						   </select>
						</div>
						<br/>
						<label for="fecha_cambio"> Fecha de cambio: </label>
						<input class="input" type="text" id="fecha_cambio" name="fecha_cambio">	
						<br/>
						<label for="fecha_cambio"> Firma: </label>
						
						<select type="text" class="form-control"  type="text" id="firma_cambio" name="firma_cambio">
							<option value="Lic. Arturo Elías Ayub">Lic. Arturo Elías Ayub</option>
						</select>
						</div>


						
					</form>
     
      <div class="modal-footer">
        <button onclick="apoyo.verCuenta();" class="btn btn-primary" id="submit_archivos" type="submit">Aceptar</button>
      </div>
    </div>

  </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cuenta por pagar</h4>
      </div>
      <div class="modal-body">
      
					
					<form id="formArchivos" enctype="multipart/form-dat" method="post"> 
						<div class=" center">
						<label for="cuenta_nombre" > Cuenta a nombre de: </label>
						<select type="text" class="form-control" name="cuenta_nombre" id="cuenta_nombre" >
							<option value="0" selected>---Seleccione un proveedor------</option>
							<?php foreach ($proveedores as $proveedor): ?>
								<option value="<?=$proveedor['id_proveedor'];?>"><?php echo $proveedor['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
						<br/>
						<label for="tipo_cambio"> Tipo de cambio: </label>
						<input class="input" type="text" id="tipo_cambio" name="tipo_cambio">	
						a <select type="text" class="form-control" name="moneda_modal" id="moneda_modal" >
							<option value="1">Moneda Nacional</option>
							<option value="2">Dólares Americanos</option>
							<option value="3">Euro</option>
						   </select>
						</div>
						<br/>
						<label for="fecha_cambio"> Fecha de cambio: </label>
						<input class="input" type="text" id="fecha_cambio" name="fecha_cambio">	
						<br/>
						<label for="fecha_cambio"> Firma: </label>
						
						<select type="text" class="form-control"  type="text" id="firma_cambio" name="firma_cambio">
							<option value="Lic. Arturo Elías Ayub">Lic. Arturo Elías Ayub</option>
						</select>
						</div>


						
					</form>
     
      <div class="modal-footer">
        <button onclick="apoyo.verTransf();" class="btn btn-primary" id="submit_archivos" type="submit">Aceptar</button>
      </div>
    </div>

  </div>
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cuenta por pagar</h4>
      </div>
      <div class="modal-body">
      
					
					<form id="formArchivos" enctype="multipart/form-dat" method="post"> 
						<div class=" center">
						<label for="cuenta_nombre" > Cuenta a nombre de: </label>
						<select type="text" class="form-control" name="cuenta_nombre" id="cuenta_nombre" >
							<option value="0" selected>---Seleccione un proveedor------</option>
							<?php foreach ($proveedores as $proveedor): ?>
								<option value="<?=$proveedor['id_proveedor'];?>"><?php echo $proveedor['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
						<br/>
						<label for="tipo_cambio"> Tipo de cambio: </label>
						<input class="input" type="text" id="tipo_cambio" name="tipo_cambio">	
						a <select type="text" class="form-control" name="moneda_modal" id="moneda_modal" >
							<option value="1">Moneda Nacional</option>
							<option value="2">Dólares Americanos</option>
							<option value="3">Euro</option>
						   </select>
						</div>
						<br/>
						<label for="fecha_cambio"> Fecha de cambio: </label>
						<input class="input" type="text" id="fecha_cambio" name="fecha_cambio">	
						<br/>
						<label for="fecha_cambio"> Firma: </label>
						
						<select type="text" class="form-control"  type="text" id="firma_cambio" name="firma_cambio">
							<option value="Lic. Arturo Elías Ayub">Lic. Arturo Elías Ayub</option>
						</select>
						</div>						
					</form>
     
      <div class="modal-footer">
        <button onclick="apoyo.verCuenta();" class="btn btn-primary" id="submit_archivos" type="submit">Aceptar</button>
      </div>
    </div>

  </div>
</div>

<div id="modal_transf" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Carta de transferencia</h4>
      </div>
      <div class="modal-body">
      
					
					<form id="formArchivos" enctype="multipart/form-dat" method="post"> 
						<div class=" center">
						<label for="cuenta_nombre" > Carta a nombre de: </label>
						<select type="text" class="form-control" name="carta_nombre" id="carta_nombre" >
							<option value="0" selected>---Seleccione un proveedor------</option>
							<?php foreach ($proveedores as $proveedor): ?>
								<option value="<?=$proveedor['id_proveedor'];?>"><?php echo $proveedor['razon_social']; ?></option>
							<?php endforeach;?>
						</select>
						<br/>
						<label for="tipo_transf"> Tipo de transferencia: </label>
						 <select type="text" class="form-control" name="tipo_transf" id="tipo_transf" >
							<option value="1">Interbancario</option>
							<option value="2">SPEUA</option>
							<option value="3">Traspaso de Fondos</option>
						   </select>
						</div>
						<br/>

						<label for="mostrar_transf"> Mostrar: </label>
						 <select type="text" class="form-control" name="mostrar_transf" id="mostrar_transf" >
							<option value="1">Concepto</option>
							<option value="2">Referencia</option>
						   </select>
						</div>
						<br/>
						<label for="fecha_cambio"> Firma: </label>
						
						<select type="text" class="form-control"  type="text" id="firma_transf" name="firma_transf">
							<option value="Sra. Gabriela Blasquez y/o Sra. Jaqueline Vinay">Sra. Gabriela Blasquez y/o Sra. Jaqueline Vinay </option>
							<option value="Lic. Arturo Elías Ayub">Lic. Arturo Elías Ayub</option>
						</select>

						</div>					
					</form>

      <div class="modal-footer">
        <button onclick="apoyo.verTransf();" class="btn btn-primary" id="submit_archivos" type="submit">Aceptar</button>
      </div>
    </div>

  </div>
</div>