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
	<div class=" input form-group col-xs-4">
		<label for="saldo">Saldo capturado:</label>
		<input type="text" class="form-control" name="saldo" id="saldo" value="<?= $saldo; ?>" disabled>
	</div>
</form>