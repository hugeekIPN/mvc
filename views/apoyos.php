
<!-- contenedor principal -->	
<div class="container container-proveedor">
</div>

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
			<label class="radio-inline"><input type="radio" name="optradio">Todos</label>
			<label class="radio-inline"><input type="radio" name="optradio">Activo</label>
			<label class="radio-inline"><input type="radio" name="optradio">Cancelado</label>
		</section>

		<section class="filtros col-xs-4">
			<span> Folio:</span>
			<input type="text" id="folio" name="">
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
	<br/>
	<div class="row col-xs-12">
		<div class="col-xs-2">
			<label for="anio_filtro">Filtro Activo:</label>
		</div>
		<div class="form-group col-xs-2">			
			<select type="text" class="form-control" name="anio" id="anio" onchange="apoyo.filtro();">
				<?php $anio= date("Y"); 
				for($a=2000; $a<=$anio; $a++)
					{ ?>
				<option value="<?php echo $a; ?>"><?php echo $a; ?></option>
				<?php } ?>
			</select>		
		</div>
	</div>
	<!-- contenedor de tabla  -->
	<div class="form-group col-xs-12" >
			<div class="cont">
	    		<table id="tabla-apoyos" class="display" cellspacing="0" class="table-hover" >
	    			<thead>
	    				<tr>
	    					<th>Folio</th>
	    					<th>Concepto</th>
	    					<th>Referencia</th>
	    					<th>Evento</th>
	    					<th>Proveedor/donador</th>
	    					<th>Fecha captura</th>
	    					<th>Estatus</th>
	    				</tr>
	    			</thead>
	    			<tfoot>
	    				<tr>
	    					<th>Folio</th>
	    					<th>Concepto</th>
	    					<th>Referencia</th>
	    					<th>Evento</th>
	    					<th>Proveedor/donador</th>
	    					<th>Fecha captura</th>
	    					<th>Estatus</th>
	    				</tr>
	    			</tfood>
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
	<div class="contenedor_apoyos" id="contenedor-apoyos">

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
				<?php include 'forms/capturaForm.php'; ?>

				<?php include 'forms/libretaFlujoForm.php'; ?>	

							
				

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


				
					<button onclick="apoyo.add();" class="btn btn-primary pull-right" id="btn-save2">Guardar</button>

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