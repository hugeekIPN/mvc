<form id="formulario-captura-apoyos">	

	<div class=" form-group col-xs-12">
		<label for="concepto">Descripcion apoyo</label>
		<input type="text" class="form-control" name="concepto" id="concepto" >
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
				<option value="6">Anual</option>
				<option value="5">Bimestral</option>
				<option value="4">Mensual</option>
				<option value="3">Quincenal</option>
				<option value="2">Semanal</option>
				<option value="1">Único</option>
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
		<label for="fecharecibo">Fecha de referencia</label>
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