<p class="titulos" style="margin-left:20%; margin-top: 20px; margin-bottom: 10px;">Saldo actual: $ <?php  echo number_format($saldo, 2); ?>  M.N.</p>

<div id="contenedorTabla">
    <div class="iconos_h col-xs-2">
        <section class="nuevo ">
            <button id="btn-add-apoyo" onclick="cargo.nuevo();">
                <img src="assets/iconos/Recurso 11.png" alt="Agregar un nuevo apoyo">
                <small>Nuevo</small>
            </button>
        </section>
    </div>

    <div class="col-xs-12">
        <div class="cont">
            <table id="example3" class="display" cellspacing="0" width="100%" class="table-hover">
                <thead>
                    <tr>
                        <th>Id Cargo</th>
                        <th>Mes Contable</th>
                        <th>Fecha Docto.Salida</th>
                        <th>Concepto</th>
                        <th>Fecha Captura</th>
                        <th>Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cargos as $cargo): ?>
                        <tr onclick="cargo.verCargos(<?=$cargo['idCargo']; ?>);">
                            <td><?= $cargo['idCargo']; ?></td>
                            <td><?= $cargo['mesContable']; ?></td>
                            <td><?= $cargo['fechaDoctoSalida']; ?></td>
                            <td><?= $cargo['concepto']; ?></td>
                            <td><?= $cargo['fechaCaptura']; ?></td>
                            <td>$<?= $cargo['cargo']; ?></td>

                        </tr>	
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- contenedor form e iconos -->
<div class="col-xs-12 der" id="contenedorForm" hidden>
    <!-- contenedor formulario y visualizacion de datos en texto plano  -->
    <div class="datos datos2 col-xs-10 eventos">
        <div class="input">
            <div id="mensajes-server"></div>
        </div>

        <!-- formulario -->
        <form id="formulario-cargo" class="formulario" >
            <input type="hidden" name="id-cargo" id="id-cargo" class="titulos">
            <div class="input form-group">
                <label class="control-label titulos" for="inputMesContable" >Mes Contable:</label>
                <input required type="text" class="form-control" id="inputMesContable" autofocus="">
            </div>
            <div class="input form-group">
                <label class="control-label titulos" for="inputFechaDoctoSalida">Fecha Docto Salida:</label>
                <input type="text" class="form-control datepicker" id="inputFechaDoctoSalida" >
            </div> 
            <div class="input form-group">
                <label class="control-label titulos" for="inputDoctoSalida">Docto. Salida:</label>
                <select type="text" class="form-control" name="documentosalida" id="inputDoctoSalida" >
                    <option value="0">Seleccionar</option>
                    <?php foreach($doctoSalida as $docto): ?>
                        <option value="<?= $docto['id_documento_salida']; ?>"><?= $docto['nombre'];?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input form-group">
                <label class="control-label titulos" for="inputConcepto">Concepto:</label>
                <textarea required type="text" class="form-control" id="inputConcepto" placeholder="Ingrese Concepto"></textarea>
            </div>
            <div class="input form-group">
                <label class="control-label titulos" for="inputCargo">Cargo:</label>
                <input type="text" class="form-control" id="inputCargo" value="0">
            </div>
        </form>
    </div>
    <!-- fin contenedor formulario y datos -->

    <!-- contenedor iconos -->
    <div class="iconos col-xs-2" style="margin-top: 35%" >
        <section class="nuevo">
            <button id="btnAdd" onclick="cargo.add();">
                <img src="assets/iconos/Recurso 11.png" alt="Editar">
                <small >Agregar</small>
            </button>
        </section>
        <section >
            <button id="btnUpdate" onclick="cargo.add(true);" hidden >
                <img src="assets/iconos/Recurso 7.png" alt="Editar">
                <small >Actualizar</small>
            </button>
        </section>
        <section >
            <button id="btnSave" onclick="cargo.add();"  >
                <img src="assets/iconos/Recurso 8.png" alt="Guardar">
                <small>Guardar</small>
            </button>
        </section>
        <section >
            <button id="btnCancel" onclick="cargo.ocultarForm();">
                <img src="assets/iconos/Recurso 8.png" alt="Guardar">
                <small>Cancelar</small>
            </button>
        </section>
    </div>
</div>