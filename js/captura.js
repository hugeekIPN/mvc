var captura = {};
/**
* Capturar inputs vista captura.php
**/
captura.elem ={
    idCaptura:      $("#id-captura"),
    mesContable:    $("#inputMesContable"),
    referencia:     $("#inputReferencia"),
    fecha_docSalida:$("#inputFechaDoctoSalida"),
    docSalida:      $("#inputDoctoSalida"),
    concepto:       $("#inputConcepto"),
    cargo:          $("#inputCargo"),
    saldo:          $("#inputSaldo"),
    formulario:     $("#formulario-captura"),
    cont_datos:     $("#datos-capturas"),
    btn_nuevo:      $("#btn-new"),
    btn_editar:     $("#btn-edit"),
    btn_save:       $("#btn-save"),
    btn_borrar:     $("#btn-delete"),
};

captura.verCapturas = function(idCaptura){
    var elementos = captura.elem;
    //*var action = "getCaptura";
    elementos.idCaptura.val(idCaptura);
    //utilerias.removeErrorMessages();
    
    $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getCaptura",
            //*action: action,
            idCaptura:  idCaptura
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
                
               
                $("#view-id-captura").text(res.idCaptura);
                $("#view-mes-contable").text(res.mesContable);
                $("#view-referencia").text(res.referencia);
                $("#view-FechaDocto-Salida").text(res.fecha_docSalida);
                $("#view-Docto-Salida").text(res.docSalida);
                $("#view-concepto").text(res.concepto);
                $("#view-cargo").text(res.cargo);
                $("#view-saldo").text(res.saldo);
                
                
                elementos.formulario.hide();
                elementos.cont_datos.show();
            }
        }
    })
};

captura.add = function(editMode){
	var data = captura.elem;
	var action = "addCaptura";
    
    var idCaptura = 0;
    var forUpdate = false;
    
    if (editMode == true)
        forUpdate = true;
    
	if(captura.validaDatos(data, forUpdate)){
        
        if ( editMode ) {
            action = "updateCaptura";
            idCaptura = $("#id-captura").val();
        }    
        
		$.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
                    idCaptura:   idCaptura,
                    mesContable:    data.mesContable.val(),
                    referencia:     data.referencia.val(),
                    fecha_docSalida: data.fecha_docSalida.val(),
                    docSalida:      data.docSalida.val(), 
                    concepto:       data.concepto.val(),
                    cargo:          data.cargo.val(),
                    saldo:          data.cargo.val(),
                    action: action
				},
                success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{
                        location.reload();
                    }
                }
		});
	}
};

captura.editCaptura = function () {
    var elementos =  captura.elem;
    var idCaptura = $("#view-id-captura").text();
    
    // utilerias.removeErrorMessages();
    
   $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getCaptura",
            //*action: action,
            idCaptura:  idCaptura
        },
       success: function(result){
                var res = JSON.parse(result);

                if(res.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, res.message);
                }else{
                //mostramos y ocultamos los botones
                elementos.btn_save.attr('onclick','captura.updateCaptura();');
                elementos.btn_save.show();
                elementos.btn_editar.hide();
                
                  
                 elementos.idCaptura.val(res.idCaptura);
                elementos.mesContable.val(res.mesContable);
                elementos.referencia.val(res.referencia);
                elementos.fecha_docSalida.val(res.fecha_docSalida);
                elementos.docSalida.val(res.docSalida);
                elementos.concepto.val(res.concepto);
                elementos.cargo.val(res.cargo);
                elementos.saldo.val(res.saldo);
                
                  elementos.formulario.show();
                elementos.cont_datos.hide();
            }
        }
    });
};

captura.validaDatos = function (data,  forUpdate) {
    var valid = true;
    
    if ($.trim(data.mesContable.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.mesContable,"Se debe ingresar mes contable");
    }
    return valid;
};


captura.deleteCaptura = function () {
    var elementos = captura.elem;
    var idCaptura = elementos.idCaptura.val();
    var c = confirm('Está seguro de realizar la operación');
    if (c) {
        $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                action: "deleteCaptura",
                idCaptura: idCaptura
            },
           success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{
                    location.reload();
                }
            }
        });
    }
};

captura.updateCaptura = function () {
    captura.add(true);
};
