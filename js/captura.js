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
    formulario:     $("#formulario-captura"),
    cont_datos:     $("#datos-capturas"),
    btn_nuevo:      $("#btn-new"),
    btn_editar:     $("#btn-edit"),
    btn_save:       $("#btn-save"),
    btn_borrar:     $("#btn-delete")
};

captura.verCapturas = function(idCaptura){
    var elementos = captura.elem;
    //*var action = "getCaptura";
    elementos.idCaptura.val(idCaptura);
    utilerias.removeErrorMessages();
    
    $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getCaptura",
            //*action: action,
            idCaptura:  idCaptura
        },
        sucess: function(result)
        {
            var res = JSON.parse(result);
            
            if(res.status == "error"){
                utilerias.displayErrorServerMessage(msj_server,res.message);
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
                //$("#view-saldo").text(res.saldo);
                
                elementos.formulario.hide();
                elementos.cont_datos.hide();
            }
        }
    })
};

captura.add = function(){
	var data = captura.elem;
	var action = "addCaptura";

	if((captura.validaDatos(data))){
		$.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
                                idCaptura:      data.idCaptura.val(),
				mesContable:    data.mesContable.val(),
				referencia:     data.referencia.val(),
				fecha_docSalida:data.fecha_docSalida.val(),
                                docSalida:      data.docSalida.val(), 
                                concepto:       data.concepto.val(),
                                cargo:          data.cargo.val(),
                                action: action
				},
			success: function(result){
				if(result.status == "error"){
					utilerias.displayErrorServerMessage(data.msj_server,result.message);
				}else{
					$("#formulario-captura :input").val('');
					utilerias.displaySuccessMessage(data.msj_server,result.message);
					location.reload();
				}
			}
		});
	}
};

captura.editCaptura = function () {
    var elementos =  captura.elem;
    var idCaptura = elementos.idCaptura.val();
    
    utilerias.removeErrorMessages();
    
    $.ajax({
        type:'post',
        url:'ajax.php',
        data:{
                action: "updateCaptura",
                idCaptura :idCaptura
        },
        suceess: function(result){
            var res = JSON.parse(result);
            if(res.status == 'error'){
                utilerias.displayErrorServerMessage(elementos.msj_server,res.message);
            }else {
                //mostramos y ocultamos los botones
                elementos.btn_save.attr('onclick','captura.updateCaptura();');
                elementos.btn_save.show();
                elementos.btn_editar.hide();
                
                //continuar Datos
                //
                //Fin de continucaion
                
                elementos.formulario.show();
                elementos.cont_datos.hide();
            }
        }
    });
};

captura.validaDatos = function (data) {
    var valid = true;
    utilerias.removeErrorMessages();
    
    if ($.trim(data.mesContable.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.mesContable,"Se debe ingresar mes contable");
    }
    if ($.trim(data.referencia.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.referencia,"Se debe ingresar referencia");
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


captura.deleteCaptura = function () {
    var elementos = captura.elem;
    var idCaptura = elementos.idCaptura.val();
    var c = confim('Está seguro de realizar la operación');
    if (c) {
        $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                action: "deleteCaptura",
                idCaptura: idCaptura
            },
            success: function (result) {
                if (result.status == "error") {
                    utilerias.displayErrorServerMessage(elementos.msj_server, result.message);
                } else {
                    utilerias.displaySuccessMessage(elementos.msj_server, result.message);
                    location.reload();
                }
            }
        });
    }
};

