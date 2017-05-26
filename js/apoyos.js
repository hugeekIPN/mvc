var apoyo = {};
/**
* apoyor inputs vista apoyo.php
**/
apoyo.elem ={
    idApoyo:      $("#id-apoyo"),
    id_apoyo_gasto: $("#id_apoyo_gasto"),
    status:    $("#status"),
    tipo:    $("#tipo"),
    concepto:    $("#concepto"),
    abono:        $("#abono"),
    abono2:        $("#abono2"),
    reflibretaana:      $("#reflibretaana"),
    mescaptura:       $("#mescaptura"),
    fechacaptura:          $("#fechacaptura"),
    mescontableana:          $("#mescontableana"),
    folio_apoyo:          $("#folio_apoyo"),
    frecuencia:          $("#frecuencia"),
    evento:          $("#evento"),
    proveedor:          $("#proveedor"),
    donatario:          $("#donatario"),
    Tipodeapoyo:          $("#Tipodeapoyo"),
    paises:          $("#paises"),
    estadooregion:          $("#estadooregion"),
    estado:         $("#estado"),
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
    idSaldo: $("#saldo"),

    archivo_up_pdf:          $("#archivo_up_pdf"),
    archivo_up_xml:          $("#archivo_up_xml"),
    

    formulario:     $("#formulario-apoyo"),
   // cont_datos:     $("#datos-apoyos"),
    btn_nuevo:      $("#btn-new"),
    btn_editar:     $("#btn-edit"),
    btn_save:       $("#btn-save"),
    btn_save2:       $("#btn-save2"),
    btn_borrar:     $("#btn-delete"),
};

apoyo.verApoyo = function(idApoyo){
    var elementos = apoyo.elem;
    //*var action = "getapoyo";
    $("#datable").hide();
    $("#contenedor-apoyos").show();
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
                elementos.btn_save.show();
                elementos.btn_save.attr('onclick','apoyo.updateApoyo();');
                elementos.btn_save2.attr('onclick','apoyo.updateApoyo();');
                elementos.btn_borrar.show();
                elementos.id_apoyo_gasto.val(res.id_apoyo);
                elementos.status.val(res.estatus);
                elementos.concepto.val(res.concepto);
                elementos.abono.val(res.importe);
                elementos.reflibretaana.val(res.referencia_anamaria);
                elementos.mescaptura.val(res.mes_captura_anamaria);
                elementos.fechacaptura.val(res.fecha_captura_anamaria);
                elementos.mescontableana.val(res.mes_contable_anamaria);
                elementos.folio_apoyo.val(res.folio);
                elementos.frecuencia.val(res.frecuencia);
                elementos.evento.val(res.eventos_id_evento);
                elementos.proveedor.val(res.id_proveedor);
                elementos.donatario.val(res.id_donatario);
                elementos.Tipodeapoyo.val(res.tipo_apoyo);
                elementos.paises.val(res.pais);
                elementos.estadooregion.val(res.entidad);
                elementos.numerodefactura.val(res.factura);
                elementos.importe_apoyo.val(res.importe);
                elementos.abono.val(res.importe);
                elementos.abono2.val(res.importe);
                elementos.moneda_apoyo.val(res.moneda);
                elementos.referencia_apoyo.val(res.referencia);
                elementos.observaciones.val(res.observaciones);
                elementos.descripcionapoyo.val(res.descripcion);
                elementos.mescontableflujo.val(res.mes_contabel_libretaflujo);
                elementos.fechadoctosalida.val(res.fecha_docto_salida);
                elementos.documentosalida.val(res.docto_salida);
                elementos.poliza.val(res.poliza);
                elementos.idSaldo.val(res.saldo);
            }
        }
    });
    
};

apoyo.add = function(editMode){
	var data = apoyo.elem;
	var action = "addApoyo";
    
    var idApoyo = 0;
    var forUpdate = false;
    
    if (editMode == true)
        forUpdate = true;
    
    
    
	if((apoyo.validaDatos(data))){
        if ( editMode ) {
            action = "updateApoyo";
            idApoyo = data.idApoyo.val();
        }    
        
		$.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                    idApoyo : data.idApoyo.val(),
                    id_saldo: data.idSaldo.val(),
                    estatus: data.status.val(),
                    tipo: data.tipo.val(), // APOYO
                    concepto: data.concepto.val(),
                    importe:  data.abono.val(),
                    //referencia_anamaria: data.reflibretaana.val(),
                    mes_captura_anamaria: data.mescaptura.val(),
                    fecha_captura_anamaria: data.fechacaptura.val(),
                    mes_contable_anamaria: data.mescontableana.val(),
                    folio: data.folio_apoyo.val(),
                    frecuencia: data.frecuencia.val(),
                    eventos_id_evento: data.evento.val(),
                    id_proveedor: data.proveedor.val(),
                    id_donatario: data.donatario.val(),
                    tipo_apoyo:    data.Tipodeapoyo.val(),
                    pais:       data.paises.val(),
                    entidad:    data.estadooregion.val(),
                    factura:    data.numerodefactura.val(), /// ¡???
                    // data.importe_apoyo.val(),
                    moneda: data.moneda_apoyo.val(),
                    referencia: data.referencia_apoyo.val(),
                    observaciones: data.observaciones.val(),
                    descripcion: data.descripcionapoyo.val(),
                    mes_contabel_libretaflujo: data.mescontableflujo.val(),
                    fecha_docto_salida:  data.fechadoctosalida.val(),
                    docto_salida:    data.documentosalida.val(),
                    poliza:  data.poliza.val(),

                    action: action
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
                elementos.btn_save.attr('onclick','apoyo.updateApoyo();');
                elementos.btn_save2.attr('onclick','apoyo.updateApoyo();');
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
    
    
    if ($.trim(data.concepto.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.concepto,"Se debe ingresar un concepto");
    }
    if ($.trim(data.abono.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.abono,"Se debe ingresar un abono");
    }
    if ($.trim(data.proveedor.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.proveedor,"Debe existir un proveedor");
    }
    if ($.trim(data.donatario.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.donatario,"Debe existir un donatario");
    }
    if ($.trim(data.evento.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.evento,"Debe ingresar un evento");
    }

    return valid;
};


apoyo.deleteApoyo = function () {
    var elementos = apoyo.elem;
    var idApoyo = elementos.idApoyo.val();
    var c = confirm('Está seguro de realizar la operación');
    if (c) {
        $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                action: "deleteApoyo",
                idApoyo: idApoyo
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

apoyo.updateApoyo = function () {
    apoyo.add(true);
};


 $(function(){
        $("#formArchivos").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formArchivos"));
            formData.append("action", "nuevoArchivo");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            
            $.ajax({

                url: "ajax.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                 processData: false
            })
                .done(function(res){
                    $("#mensaje").html("Respuesta: " + res);
                });
        });
 });

apoyo.abono = function(){
    var data = apoyo.elem;

    data.importe_apoyo.val(data.abono.val());
    data.abono2.val(data.abono.val());
};


apoyo.nuevo = function(){
    var elementos = apoyo.elem;

    elementos.btn_save.attr('onclick','apoyo.add();');
    elementos.btn_save2.attr('onclick','apoyo.add();');

    elementos.status.val(1);
    elementos.concepto.val("");
    elementos.abono.val("0.00");
    elementos.reflibretaana.val("");
    elementos.mescaptura.val("");
    elementos.fechacaptura.val("");
    elementos.mescontableana.val("");
    elementos.folio_apoyo.val("");
    elementos.frecuencia.val(1);
    elementos.evento.val("");
    elementos.proveedor.val("");
    elementos.donatario.val("");
    elementos.Tipodeapoyo.val(1);
    elementos.paises.val("");
    elementos.estadooregion.val("");
    elementos.numerodefactura.val("");
    elementos.importe_apoyo.val("");
    elementos.abono.val("");
    elementos.abono2.val("");
    elementos.moneda_apoyo.val(1);
    elementos.referencia_apoyo.val("");
    elementos.observaciones.val("");
    elementos.descripcionapoyo.val("");
    elementos.mescontableflujo.val("");
    elementos.fechadoctosalida.val("");
    elementos.documentosalida.val("");
    elementos.poliza.val("");
};

apoyo.pais = function (){
    var elem = apoyo.elem;
    var valor = document.getElementById("paises").value;  
    
    if(valor=="México"){ 
        document.getElementById('otro_text').type = 'hidden';
        document.getElementById('estado').type = 'hidden';
        
    }else{
       if(valor=="Otro"){ 
             document.getElementById('estadooregion').type = 'hidden';
              document.getElementById('otro_text').type = "text";
            document.getElementById('estado').type = 'text';

         } else{
                document.getElementById('otro_text').type = 'hidden';
                document.getElementById('estadooregion').type = 'hidden';
                document.getElementById('estado').type = 'text';
         }
    }
};