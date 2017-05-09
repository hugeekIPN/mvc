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
    IdSaldoBD:          $("#IdSaldoBD"),
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
    var idSaldo;
    
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
            idSaldo = res.saldo;
			if(res.status == "error"){
				utilerias.displayErrorServerMessage(elem.msj_server, res.message);
			}else{
                //mostramos y ocultamos los botones
                elementos.btn_editar.show();
                elementos.btn_save.hide();
                elementos.btn_borrar.show();
                
                idSaldo = res.saldo;
                
                $("#view-id-captura").text(res.idCaptura);
                $("#view-mes-contable").text(res.mesContable);
                $("#view-referencia").text(res.referencia);
                $("#view-FechaDocto-Salida").text(res.fecha_docSalida);
                $("#view-Docto-Salida").text(res.docSalida);
                $("#view-concepto").text(res.concepto);
                $("#view-cargo").text(res.cargo);
               // $("#view-saldo").text(res.saldo);
          
                
                elementos.formulario.hide();
                elementos.cont_datos.show();
            }
        }
    });
    
          $.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
                    saldoId: idSaldo,
                    action: "getSaldo"
				},
                success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{
                      $("#view-saldo").text(result.saldo);
                  //document.getElementById("saldotd"+idSaldo).innerHTML = "$"+result.saldo;
                        //location.reload();
                    }
                }
		});
};

captura.add = function(editMode){
	var data = captura.elem;
	var action = "addCaptura";
    
    var idCaptura = 0;
    var forUpdate = false;
    
    if (editMode == true)
        forUpdate = true;
    
	if((captura.validaDatos(data))){
        
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
                    saldo:          data.IdSaldoBD.val(),
                    action: action
				},
                success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }
                }
		});
        
        $.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
                    saldo: data.saldo.val(),
                    action: "addSaldo"
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

captura.getCargo = function () {
    var data = captura.elem;
    var saldo = $("#saldoBD").val();
  
    var cargo = data.cargo.val();
    saldo = parseInt(saldo) + parseInt(cargo);
    data.saldo.val(saldo);
};

captura.getSaldo = function (idSaldo){
      $.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
                    saldoId: idSaldo,
                    action: "getSaldo"
				},
                success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{
                      document.getElementById("saldotd"+idSaldo).innerHTML = "$"+result.saldo;
                        //location.reload();
                    }
                }
		});
}