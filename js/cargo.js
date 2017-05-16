var cargo = {};
/**
* cargor inputs vista cargo.php
**/
cargo.elem ={
    idCargo:      $("#id-cargo"),
    mesContable:    $("#inputMesContable"),
   fecha_docSalida:$("#inputFechaDoctoSalida"),
    docSalida:      $("#inputDoctoSalida"),
    concepto:       $("#inputConcepto"),
    cargo:          $("#inputCargo"),
    saldo:          $("#inputSaldo"),
    formulario:     $("#formulario-cargo"),
    cont_datos:     $("#datos-cargos"),
    btn_nuevo:      $("#btn-new"),
    btn_editar:     $("#btn-edit"),
    btn_save:       $("#btn-save"),
    btn_borrar:     $("#btn-delete"),
};

cargo.verCargos = function(idCargo){
    var elementos = cargo.elem;
    //*var action = "getcargo";
    elementos.idCargo.val(idCargo);
    //utilerias.removeErrorMessages();
    $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getCargo",
            //*action: action,
            idCargo:  idCargo
        },
        success: function(result){
			var res = JSON.parse(result);
            
			if(res.status == "error"){
				utilerias.displayErrorServerMessage(elem.msj_server, res.message);
			}else{
                //mostramos y ocultamos los botones
                elementos.btn_editar.show();
                elementos.btn_save.hide();
                elementos.btn_borrar.show();
                
                $("#view-id-cargo").text(res.id_cargo);
                $("#view-mes-contable").text(res.mes_contable);
                $("#view-FechaDocto-Salida").text(res.fecha_docto_salida);
                $("#view-Docto-Salida").text(res.docto_salida);
                $("#view-concepto").text(res.concepto);
                $("#view-cargo").text(res.cargo);
                $("#view-saldo").text(res.saldo);
          
                elementos.formulario.hide();
                elementos.cont_datos.show();
            }
        }
    });
    
};

cargo.add = function(editMode){
	var data = cargo.elem;
	var action = "addCargo";
    
    var idCargo = 0;
    var forUpdate = false;
    
    if (editMode == true)
        forUpdate = true;
    
    
    
	if((cargo.validaDatos(data))){
        data.btn_save.attr('onclick',''); // Deshabilita 
        
        if ( editMode ) {
            action = "updateCargo";
            idCargo = $("#id-cargo").val();
        }    
        
		$.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                    idCargo : data.idCargo.val(),
                    mesContable:    data.mesContable.val(),
                    fecha_docSalida: data.fecha_docSalida.val(),
                    docSalida:      data.docSalida.val(), 
                    concepto:       data.concepto.val(),
                    cargo:          data.cargo.val(),
                    action: action
                },
                success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{  
                        data.btn_save.attr('onclick','cargo.add();');
                        utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
                        location.reload();
                     }
                }
        });
	}
};

cargo.editCargo = function () {
    var elementos =  cargo.elem;
    var idCargo = $("#view-id-cargo").text();
    
    // utilerias.removeErrorMessages();
    
   $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getCargo",
            //*action: action,
            idCargo:  idCargo
        },
       success: function(result){
                var res = JSON.parse(result);

                if(res.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, res.message);
                }else{
                //mostramos y ocultamos los botones
                elementos.btn_save.attr('onclick','cargo.updateCargo();');
                elementos.btn_save.show();
                elementos.btn_editar.hide();
                elementos.idCargo.val(res.id_cargo);
                elementos.mesContable.val(res.mes_contable);
                elementos.fecha_docSalida.val(res.fecha_docto_salida);
                elementos.docSalida.val(res.docto_salida);
                elementos.concepto.val(res.concepto);
                elementos.cargo.val(res.cargo);
                elementos.saldo.val(res.saldo);
                
                  elementos.formulario.show();
                elementos.cont_datos.hide();
            }
        }
    });
};


cargo.validaDatos = function (data) {
    var valid = true;
    utilerias.removeErrorMessages();
    
    if ($.trim(data.mesContable.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.mesContable,"Se debe ingresar mes contable");
    }
    if ($.trim(data.fecha_docSalida.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.fecha_docSalida,"Se debe ingresar Fecha Doc. Salida");
    }
    if ($.trim(data.docSalida.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.docSalida,"Se debe ingresar Doc. Salida");
    }
    if ($.trim(data.concepto.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.concepto,"Se debe ingresar Concepto");
    }
    if ($.trim(data.cargo.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.cargo,"Se debe ingresar Cargo");
    }
    return valid;
};


cargo.deleteCargo = function () {
    var elementos = cargo.elem;
    var idCargo = elementos.idCargo.val();
    var c = confirm('Está seguro de realizar la operación');
    if (c) {
        $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                action: "deleteCargo",
                idCargo: idCargo
            },
           success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{
                    utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
                    location.reload();
                }
           }
        });
    }
};

cargo.updateCargo = function () {
    cargo.add(true);
};
