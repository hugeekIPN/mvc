<form id="formulario-captura-apoyos">	

	<div class=" form-group col-xs-10">
		<label for="concepto">Descripcion apoyo</label>
		<input type="text" class="form-control" name="concepto" id="concepto" >
	</div>

	<div class="form-group col-xs-2">
		<label for="status">Estatus</label>
		<select type="text" class="form-control" name="status" id="status" >
			<option value="0" selected>Activo</option>
			<option value="1">Cancelado</option>		
		</select>		
	</div>
	
		
	<div class="row">

		<div class=" form-group col-xs-2">
			<label for="folio_apoyo">Folio</label>
			<input type="text" class="form-control" name="folio_apoyo" id="folio_apoyo" >
		</div>

		<div class="form-group col-xs-2">
			<label for="fechacaptura">Fecha de Captura</label>
			<input type="text" id="fechacaptura" name="fechacaptura" class="form-control" placeholder="Fecha">
		</div>

		<div class=" form-group col-xs-2">
			<label for="frecuencia">Frecuencia</label>
			<select type="text" class="form-control" name="frecuencia" id="frecuencia" >
				<?php foreach($frecuencia as $f): ?>
				<option value="<?= $f['id_frecuencia_apoyo']; ?>"><?= $f['nombre']?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class=" form-group col-xs-2">
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
	</div>


	<div class=" form-group col-xs-2">
		<label for="tipo_apoyo">Tipo de Apoyo</label>
		<select type="text" class="form-control" name="Tipodeapoyo" id="tipo_apoyo">
			<option value="0">Especie</option>
			<option selected value="1">Importe</option>
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
		<?php foreach($unidades as $unidad): ?>
			<option value="<?= $unidad['id_unidad']; ?>"><?= $unidad['nombre']; ?></option>
		<?php endforeach; ?>
			<option value="0">Otro</option>
		</select>
	</div >
	<div class=" form-group col-xs-2" id="otra_especie_div">
		<label for="otro">Otro:</label>
		<input type="text" class="form-control" name="otra_especie" id="otra_especie">
	</div>

	<div class=" form-group col-xs-1">
		<label for="paises">País</label>
		<select type="text" class="form-control" name="paises" id="paises" onchange="apoyo.pais();" >			
			<?php foreach($paises as $pais):?>
				<option value="<?= $pais['id_pais']; ?>"><?=$pais['nombre'];?></option>
			<?php endforeach; ?>
			<option value="0">otro</option>
		</select>

		<input type="hidden" class="form-control" name="otro_text" id="otro_text" >

	</div >

	<div class=" form-group col-xs-3">
		<label for="estadooregion">Estado o Región</label>
		<select type="text" class="form-control" name="estadooregion" id="estadooregion" >
			<?php foreach($estadosMex as $estado): ?>
				<option value="<?= $estado['id_estado']; ?>"><?= $estado['nombre'];?></option>
			<?php endforeach; ?>
		</select>

		<input type="hidden" class="form-control" name="estado" id="estado" >
	</div >

	<div class="form-group col-xs-3">
		<label for="estadosEua">Estado o Región</label>
		<select class="form-control" id="estadosEua">
			<?php foreach($estadosEua as $estado): ?>
				<option value="<?= $estado['id_estado']; ?>"><?= $estado['nombre'];?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class=" form-group col-xs-2">
		<label for="numerodefactura">Número de referencia</label>
		<input type="text" class="form-control" name="numerodefactura" id="numerodefactura" >
	</div>
	<div class=" form-group col-xs-2">
		<label for="apoyo">Importe</label>
		<input type="text" onblur="apoyo.abono();" class="form-control" name="abono" id="abono" value="0.00" >
	</div>
	<div class=" form-group col-xs-2">
		<label for="moneda_apoyo">Moneda</label>
		<select type="text" class="form-control" name="moneda_apoyo" id="moneda_apoyo" >
			<option value="1">Moneda Nacional</option>
			<option value="2">Dólares Americanos</option>
			<option value="3">Euro</option>
		</select>
	</div >
	
	<div class=" form-group col-xs-3">
		<label for="fecha_referencia">Fecha de referencia</label>
		<input type="text" id="fecha_referencia" class="form-control" placeholder="Click">
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
</form>

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
		<button onclick="apoyo.verCheque();">
			<figure><img src="assets/iconos/Recurso 15.png" alt="Cheque"></figure>

			<p>Cheque</p>
		</button>
	</div>
</div><!-- Fin de imprimibles -->




<!-- LIBRETA FLUJO FORM -->

<form id="formulario-libretaflujo">
	<h3 class="h3form">Libreta Flujo </h3>
	
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
</form>