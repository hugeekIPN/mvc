<div class="container col-xs-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
    <div class="form-group col-xs-8 izq">
        <div class="col-xs-12 registros">
            <div class="cont">
                <table id="example3" class="display" cellspacing="0" width="100%" class="table-hover">
                    <thead>
                        <tr>
                            <th>ID Captura</th>
                            <th>Mes Contable</th>
                            <th>Referencia</th>
                            <th>Fecha Docto.Salida</th>
                            <th>Docto.Salida</th>
                            <th>Concepto</th>
                            <th>Cargo</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                   <tbody>
                    <?php foreach ($captura as $capturas): ?>
                        <tr onclick="captura.verCapturas(<?=$capturas['idCaptura']; ?>);">
                            <td><?= $capturas['idCaptura']; ?></td>
                            <td><?= $capturas['mesContable']; ?></td>
                            <td><?= $capturas['referencia']; ?></td>
                            <td><?= $capturas['fecha_docSalida']; ?></td>
                            <td><?= $capturas['docSalida']; ?></td>
                            <td><?= $capturas['concepto']; ?></td>
                            <td><?= $capturas['cargo']; ?></td>
                            <td><?= $capturas['saldo']; ?></td>
                        </tr>	
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- contenedor derecho -->
    <div class="form-group col-xs-4 der">
        <!-- contenedor formulario y visualizacion de datos en texto plano  -->
        <div class="datos datos2 col-xs-10 eventos">
            <div class="input">
                <div id="mensajes-server"></div>
            </div>

            <!-- formulario -->
            <form id="formulario-captura" class="formulario" >
                <input type="hidden" name="id-captura" id="id-captura" class="titulos">
                <div class="input form-group">
                    <label class="control-label titulos" for="inputMesContable" >Mes Contable:</label>
                    <input required type="month" class="form-control" id="inputMesContable" min="2014-01-01" autofocus="">
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputReferencia">Referencia:</label>
                    <input required type="number" class="form-control" id="inputReferencia" min="0" placeholder="N&uacute;mero referencia">
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputFechaDoctoSalida">Fecha Docto Salida:</label>
                    <input required type="date" class="form-control" id="inputFechaDoctoSalida" min="2014-01-01">
                </div> 
                <div class="input form-group">
                    <label class="control-label titulos" for="inputDoctoSalida">Docto. Salida:</label>
                    <input required type="text" class="form-control" id="inputDoctoSalida" placeholder="Documento Salida">
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputConcepto">Concepto:</label>
                    <textarea required type="text" class="form-control" id="inputConcepto" placeholder="Ingrese Concepto"></textarea>
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputCargo">Cargo:</label>
                    <input required="" type="number" class="form-control" id="inputCargo" placeholder="Ingrese Cargo $0.0" min="0">
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputSaldo">Saldo:</label>
                    <input type="number" class="form-control" id="inputSaldo" placeholder="Saldo" min="0" disabled required >
                </div>
            </form>
            <!-- fin formulario -->

            <!-- datos a mostrar en texto plano -->
            <div id="datos-capturas" hidden>
                <p class="titulos"><strong>ID Captura</strong></p>		
                <p class="id-captura id" id="view-id-captura"></p>

                <p class="titulos">Mes Contable</p>	
                <p id="view-mes-contable"></p>
                
                <p class="titulos">Referencia</p>	
                <p id="view-referencia"></p>
                
                <p class="titulos">Fecha Docto. Salida</p>	
                <p id="view-FechaDocto-Salida"></p>
                
                 <p class="titulos">Docto. Salida</p>	
                <p id="view-Docto-Salida"></p>
                
                <p class="titulos">Concepto</p>	
                <p id="view-concepto"></p>
                
                <p class="titulos">Cargo</p>
                <p id="view-cargo"></p>
                <p class="titulos">Saldo</p>
                <p id="view-saldo"></p>
<!--                
                <p class="titulos">Saldo</p>
                <p id="view-saldo"></p>-->
            </div>
            <!-- fin datos a mostrar para programas -->					
        </div>
        <!-- fin contenedor formulario y datos -->

        <!-- contenedor iconos -->
        <div class="iconos col-xs-2" style="margin-top: 35%" >
            <section class="nuevo">
                <button id="btn-new" onclick="location.reload();">
                    <img src="assets/iconos/Recurso 11.png" alt="Editar">
                    <small >Nuevo</small>
                </button>
            </section>
            <section >
                <button id="btn-edit" onclick="captura.editCaptura();" hidden >
                    <img src="assets/iconos/Recurso 7.png" alt="Editar">
                    <small >Editar</small>
                </button>
            </section>
            <section >
                <button id="btn-save" onclick="captura.add();"  >
                    <img src="assets/iconos/Recurso 8.png" alt="Guardar">
                    <small>Guardar</small>
                </button>
            </section>
            <section >
                <button  id="btn-delete" onclick="captura.deleteCaptura();" hidden>
                    <img src="assets/iconos/Recurso 9.png" alt="Borrar">
                    <small>Borrar</small>
                </button>
            </section>

        </div>
    </div>
</div>