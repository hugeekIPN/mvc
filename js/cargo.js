var cargo = {};
/**
* cargor inputs vista cargo.php
**/
cargo.elem ={
    idCargo:      $("#id-cargo"),
    mesContable:    $("#inputMesContable"),
    fechaDoctoSalida:$("#inputFechaDoctoSalida"),
    doctoSalida:      $("#inputDoctoSalida"),
    concepto:       $("#inputConcepto"),
    cargo:          $("#inputCargo"),    
    formulario:     $("#formulario-cargo"),
    btnAdd:      $("#btn-new"),
    btnUpdate:     $("#btn-edit"),
    btnSave:       $("#btn-save"),
    btnCancel:     $("#btn-delete"),
};

/**
** Guardar y actualizar cargo
**/
cargo.add = function(editMode){
	var data = cargo.elem;
	var action = "addCargo";    
    var idCargo = 0;
    var forUpdate = false;
    
    if (editMode == true)
        forUpdate = true;   
    if((cargo.validaDatos(data))){
        data.btnSave.prop('disabled','true');          
        if ( editMode ) {
            action = "updateCargo";
        }   
        
        $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                idCargo : data.idCargo.val(),
                mesContable:    data.mesContable.val(),
                fechaDoctoSalida: data.fechaDoctoSalida.val(),
                doctoSalida:      data.doctoSalida.val(), 
                concepto:       data.concepto.val(),
                cargo:          data.cargo.val(),
                action: action
            },
            success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage($("#mensajes-server"), result.message);
                }else{                      
                  utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
                  location.reload();
              }
              data.btnSave.prop('disabled','false');
          }
      });
    }
};

/**
** Funcion para ver detalles de cargo
**/
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
                elementos.btnSave.attr('onclick','cargo.updateCargo();');
                elementos.btnSave.show();
                elementos.btn_editar.hide();
                elementos.idCargo.val(res.id_cargo);
                elementos.mesContable.val(res.mes_contable);
                elementos.fechaDoctoSalida.val(res.fecha_docto_salida);
                elementos.doctoSalida.val(res.docto_salida);
                elementos.concepto.val(res.concepto);
                elementos.cargo.val(res.cargo);
                elementos.saldo.val(res.saldo);
                
                elementos.formulario.show();
                elementos.cont_datos.hide();
            }
        }
    });
};

/**
** valida datos
**/
cargo.validaDatos = function (data) {
    var valid = true;
    utilerias.removeErrorMessages();
    
    if ($.trim(data.mesContable.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.mesContable,"Se debe ingresar mes contable");
    }
    if (!utilerias.isValidDate(data.fechaDoctoSalida.val())) {
        valid = false;
        utilerias.displayErrorMessage(data.fechaDoctoSalida,"Fecha no válida");
    }
    if ($.trim(data.concepto.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.concepto,"Se debe ingresar Concepto");
    }
    if (isNaN(data.cargo.val())) {
        valid = false;
        utilerias.displayErrorMessage(data.cargo,"Cargo no válido");
    }
    return valid;
};

/**
** Al dar click en nuevo
**/
cargo.nuevo = function(){
    cargo.elem.formulario[0].reset();
    cargo.elem.fechaDoctoSalida.val($.datepicker.formatDate('yy-mm-dd', new Date()));
    cargo.elem.btnAdd.hide();
    cargo.elem.btnUpdate.hide();
    cargo.elem.btnSave.show();
    utilerias.removeErrorMessages();
    $("#contenedorTabla").hide();
    $("#contenedorForm").show();
}

/**
** Click en cancelar para volver  a ver la tabla
**/
cargo.ocultarForm = function(){
    $("#contenedorTabla").show();
    $("#contenedorForm").hide();    
}

