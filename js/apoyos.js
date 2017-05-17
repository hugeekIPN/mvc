var apoyo = {};
/**
* apoyor inputs vista apoyo.php
**/
apoyo.elem ={
    idApoyo:      $("#id-apoyo"),
    tipo:    $("#tipo"),
    concepto:    $("#concepto"),
    abono:        $("#abono"),
    reflibretaana:      $("#reflibretaana"),
    mescaptura:       $("#mescaptura"),
    fechacaptura:          $("#fechacaptura"),
    mescontableana:          $("#mescontableana"),
    folio_apoyo:          $("#folio_apoyo"),
    frecuencia:          $("#frecuencia"),
    evento:          $("#evento"),
    proveedor:          $("#proveedor"),
    Tipodeapoyo:          $("#Tipodeapoyo"),
    paises:          $("#paises"),
    estadooregion:          $("#estadooregion"),
    numerodefactura:          $("#numerodefactura"),
    importe_apoyo:          $("#importe_apoyo"),
    moneda_apoyo:          $("#moneda_apoyo"),
    referencia_apoyo:          $("#referencia_apoyo"),
    observaciones:          $("#observaciones"),
    descripcionapoyo:          $("#descripcionapoyo"),

    mescontableflujo:          $("#mescontableflujo"),
    fechadoctosalida:          $("#fechadoctosalida"),
    documentosalida:          $("#documentosalida"),
    poliza:          $("#poliza"),
    // abono:          $("#abono"),
    
    archivo_up_pdf:          $("#archivo_up_pdf"),
    archivo_up_xml:          $("#archivo_up_xml"),
    

    formulario:     $("#formulario-apoyo"),
   // cont_datos:     $("#datos-apoyos"),
    btn_nuevo:      $("#btn-new"),
    btn_editar:     $("#btn-edit"),
    btn_save:       $("#btn-save"),
    btn_borrar:     $("#btn-delete"),
};

apoyo.verApoyo = function(idApoyo){
    var elementos = apoyo.elem;
    //*var action = "getapoyo";
    elementos.idApoyo.val(idApoyo);
    //utilerias.removeErrorMessages();
    $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getApoyo",
            //*action: action,
            idApoyo:  idApoyo
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
                
                elementos.tipo.val(res.tipo);
                elementos.concepto.val(res.concepto);
                elementos.abono.val(res.abono);
                elementos.reflibretaana.val(res.referencia_anamaria);
                elementos.mescaptura.val(res.mes_captura_anamaria);
                elementos.fechacaptura.val(res.fecha_captura_anamaria);
                elementos.mescontableana.val(res.mes_contable_anamaria);
                elementos.folio_apoyo.val(res.folio);
                elementos.frecuencia.val(res.frecuencia);
                elementos.evento.val(res.eventos_id_evento);
                elementos.proveedor.val(res.id_proveedor);
                elementos.Tipodeapoyo.val(res.tipo_apoyo);
                elementos.paises.val(res.pais);
                elementos.estadooregion.val(res.entidad);
                elementos.numerodefactura.val(res.factura);
                elementos.importe_apoyo.val(res.importe);
                elementos.moneda_apoyo.val(res.moneda);
                elementos.referencia_apoyo.val(res.referencia);
                elementos.observaciones.val(res.observaciones);
                elementos.descripcionapoyo.val(res.descripcion);
                elementos.mescontableflujo.val(res.mes_contabel_libretaflujo);
                elementos.fechadoctosalida.val(res.fecha_docto_salida);
                elementos.documentosalida.val(res.docto_salida);
                elementos.poliza.val(res.poliza);
                // elementos.formulario.hide();
                // elementos.cont_datos.show();
            }
        }
    });
    
};

apoyo.add = function(editMode){
	var data = apoyo.elem;
	var action = "addapoyo";
    
    var idapoyo = 0;
    var forUpdate = false;
    
    if (editMode == true)
        forUpdate = true;
    
    
    
	if((apoyo.validaDatos(data))){
        data.btn_save.attr('onclick',''); // Deshabilita 
        
        if ( editMode ) {
            action = "updateapoyo";
            idapoyo = $("#id-apoyo").val();
        }    
        
		$.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                    idapoyo : data.idapoyo.val(),
                    mesContable:    data.mesContable.val(),
                    fecha_docSalida: data.fecha_docSalida.val(),
                    docSalida:      data.docSalida.val(), 
                    concepto:       data.concepto.val(),
                    apoyo:          data.apoyo.val(),
                    action: action
                },
                success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{  
                        data.btn_save.attr('onclick','apoyo.add();');
                      //  utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
                        location.reload();
                     }
                }
        });
	}
};

apoyo.editapoyo = function () {
    var elementos =  apoyo.elem;
    var idapoyo = $("#view-id-apoyo").text();
    
    // utilerias.removeErrorMessages();
    
   $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getapoyo",
            //*action: action,
            idapoyo:  idapoyo
        },
       success: function(result){
                var res = JSON.parse(result);

                if(res.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, res.message);
                }else{
                //mostramos y ocultamos los botones
                elementos.btn_save.attr('onclick','apoyo.updateapoyo();');
                elementos.btn_save.show();
                elementos.btn_editar.hide();
                elementos.idapoyo.val(res.id_apoyo);
                elementos.mesContable.val(res.mes_contable);
                elementos.fecha_docSalida.val(res.fecha_docto_salida);
                elementos.docSalida.val(res.docto_salida);
                elementos.concepto.val(res.concepto);
                elementos.apoyo.val(res.apoyo);
                elementos.saldo.val(res.saldo);
                
                  elementos.formulario.show();
                elementos.cont_datos.hide();
            }
        }
    });
};


apoyo.validaDatos = function (data) {
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
    if ($.trim(data.apoyo.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.apoyo,"Se debe ingresar apoyo");
    }
    return valid;
};


apoyo.deleteapoyo = function () {
    var elementos = apoyo.elem;
    var idapoyo = elementos.idapoyo.val();
    var c = confirm('Está seguro de realizar la operación');
    if (c) {
        $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                action: "deleteapoyo",
                idapoyo: idapoyo
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

apoyo.updateapoyo = function () {
    apoyo.add(true);
};
