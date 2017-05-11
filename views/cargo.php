<div class="container col-xs-12 container-proveedor "onload="oCurrentValue.innerText = estado.isContentEditable;">
    <div class="form-group col-xs-8 izq">
        <div class="col-xs-12 registros">
            <div class="cont">
                <table id="example3" class="display" cellspacing="0" width="100%" class="table-hover">
                    <thead>
                        <tr>
                            <th>ID Cargo</th>
                            <th>Mes Contable</th>
                            <th>Fecha Docto.Salida</th>
                            
                            <th>Concepto</th>
                            <th>Cargo</th>
                       
                        </tr>
                    </thead>
                   <tbody>
                    <?php foreach ($cargo as $cargos): ?>
                        <tr onclick="cargo.verCargos(<?=$cargos['id_cargo']; ?>);">
                            <td><?= $cargos['id_cargo']; ?></td>
                            <td><?= $cargos['mes_contable']; ?></td>
                            <td><?= date('d-m-Y',strtotime($cargos['fecha_docto_salida'])); ?></td>
                            
                            <td><?= $cargos['concepto']; ?></td>
                            <td>$<?= $cargos['cargo']; ?></td>
                  
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
            <form id="formulario-cargo" class="formulario" >
                <input type="hidden" name="id-cargo" id="id-cargo" class="titulos">
                <div class="input form-group">
                    <label class="control-label titulos" for="inputMesContable" >Mes Contable:</label>
                    <input required type="text" class="form-control" id="inputMesContable" autofocus="">
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputFechaDoctoSalida">Fecha Docto Salida:</label>
                    <input type="text" class="form-control" id="inputFechaDoctoSalida" >
                </div> 
                <div class="input form-group">
                    <label class="control-label titulos" for="inputDoctoSalida">Docto. Salida:</label>
                    <input  type="text" class="form-control" id="inputDoctoSalida" placeholder="Documento Salida">
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputConcepto">Concepto:</label>
                    <textarea required type="text" class="form-control" id="inputConcepto" placeholder="Ingrese Concepto"></textarea>
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputCargo">Cargo:</label>
                    <input required="" type="number" class="form-control" id="inputCargo" placeholder="Ingrese Cargo $0.0" min="0" onblur="cargo.getCargo();">
                </div>
                <div class="input form-group">
                    <label class="control-label titulos" for="inputSaldo">Saldo:</label>
                    <input type="number" class="form-control" value="<?php  echo $saldo ?>" id="inputSaldo" placeholder="Saldo" min="0" disabled required>
                </div>
            </form>
            <!-- fin formulario -->

            <!-- datos a mostrar en texto plano -->
            <div id="datos-cargos" hidden>
                <p class="titulos"><strong>ID cargo</strong></p>		
                <p class="id-cargo id" id="view-id-cargo"></p>

                <p class="titulos">Mes Contable</p>	
                <p id="view-mes-contable"></p>
                
                
                <p class="titulos">Fecha Docto. Salida</p>	
                <p id="view-FechaDocto-Salida"></p>
                
                 <p class="titulos">Docto. Salida</p>	
                <p id="view-Docto-Salida"></p>
                
                <p class="titulos">Concepto</p>	
                <p id="view-concepto"></p>
                
                <p class="titulos">Cargo</p>
                <p id="view-cargo"></p>
                <p class="titulos">Saldo Capturado</p>
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
                <button id="btn-edit" onclick="cargo.editCargo();" hidden >
                    <img src="assets/iconos/Recurso 7.png" alt="Editar">
                    <small >Editar</small>
                </button>
            </section>
            <section >
                <button id="btn-save" onclick="cargo.add();"  >
                    <img src="assets/iconos/Recurso 8.png" alt="Guardar">
                    <small>Guardar</small>
                </button>
            </section>
            <section >
                <button  id="btn-delete" onclick="cargo.deleteCargo();" hidden>
                    <img src="assets/iconos/Recurso 9.png" alt="Borrar">
                    <small>Borrar</small>
                </button>
            </section>

        </div>
    </div>
</div>