var apoyo = {};

apoyo.tabla = $('#tabla-apoyos').DataTable( {
    ajax: "index.php?op=getApoyos"
} );

$('#tabla-apoyos tbody').on('click','tr',function(){
    apoyo.verApoyo($(this).find('td').first().text());
});


/**
* apoyor inputs vista apoyo.php
**/
apoyo.elem ={
    status:    $("#status"),
    concepto:    $("#concepto"),
    abono:        $("#abono"),
    abono2:        $("#abono2"),
    fechacaptura:          $("#fechacaptura"),
    folio_apoyo:         $("#folio_apoyo"),
    frecuencia:         $("#frecuencia"),
    evento:            $("#evento"),
    proveedor:          $("#proveedor"),
    donatario:          $("#donatario"),
    especie:             $("#id_especie"),
    especie_div:          $("#especie_div"),
    Tipodeapoyo:          $("#Tipodeapoyo"),
    cantidad:             $("#cantidad"),
    cantidad_div:          $("#cantidad_div"),
    otra_especie:          $("#otra_especie"),
    otra_especie_div:       $("#otra_especie_div"),
    unidad:                 $("#unidad"),
    unidad_div:             $("#unidad_div"),
    paises:                 $("#paises"),
    estadooregion:          $("#estadooregion"),
    estado:                 $("#estado"),
    numerodefactura:         $("#numerodefactura"),
    importe_apoyo:          $("#importe_apoyo"),
    moneda_apoyo:          $("#moneda_apoyo"),
    referencia_apoyo:      $("#referencia_apoyo"),
    observaciones:         $("#observaciones"),
    descripcionapoyo:      $("#descripcionapoyo"),

    mescontableflujo:          $("#mescontableflujo"),
    fechadoctosalida:          $("#fechadoctosalida"),
    documentosalida:           $("#documentosalida"),
    poliza:          $("#poliza"),
    idSaldo:         $("#saldo"),
    tabla_eventos_div : $("#tabla_eventos_div"),
    archivo_up_pdf:          $("#archivo_up_pdf"),
    archivo_up_xml:          $("#archivo_up_xml"),    
 
    btn_save:       $("#btn-save"),
    btn_add:       $("#btn-add"),
    btn_update: $("#btn-update"),
    btn_delete:     $("#btn-delete"),
};

apoyo.loadTable = function(){
    apoyo.tabla.ajax.reload();
}

apoyo.verApoyo = function(idApoyo){
    var elementos = apoyo.elem;    
    $("#datable").hide();
    $("#contenedor-apoyos").show();
    utilerias.removeErrorMessages();
    $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getApoyo",            
            idApoyo:  idApoyo
        },
        success: function(result){
			var res = JSON.parse(result);
            
			if(res.status == "error"){
				utilerias.displayErrorServerMessage(elem.msj_server, res.message);
			}else{
                elementos.btn_save.hide();                
                elementos.status.val(res.estatus);
                elementos.concepto.val(res.concepto);
                elementos.abono.val(res.importe);

                elementos.mescaptura.val(res.mes_captura_anamaria);
                elementos.fechacaptura.val(res.fecha_captura_anamaria);
                elementos.mescontableana.val(res.mes_contable_anamaria);
                elementos.folio_apoyo.val(res.folio);
                elementos.frecuencia.val(res.frecuencia);
                elementos.evento.val(res.id_evento);
                elementos.proveedor.val(res.id_proveedor);
                elementos.donatario.val(res.id_donatario);
                elementos.fecharecibo.val(res.fecha_recibo);

                if(res.tipo_apoyo=="2"){  // especie
                    elementos.unidad.val(res.unidad);
                    elementos.cantidad.val(res.cantidad);
                    elementos.especie.val(res.id_especie);
                    elementos.especie.show();
                    elementos.especie_div.show();
                    elementos.unidad.show();
                    elementos.unidad_div.show();
                    elementos.cantidad.show();
                    elementos.cantidad_div.show();

                    var unidad = res.unidad;

                    if(isNaN(unidad)){
                        elementos.unidad.val("Otro");
                        elementos.otra_especie.val(res.unidad);
                        elementos.otra_especie.show();
                        elementos.otra_especie_div.show();
                    }else{
                       elementos.otra_especie.hide();
                        elementos.otra_especie_div.hide();     
                    }
                    
                }else{
                    elementos.especie.hide();
                    elementos.especie_div.hide();
                    elementos.unidad.hide();
                    elementos.unidad_div.hide();
                    elementos.cantidad.hide();
                    elementos.cantidad_div.hide();
                    elementos.otra_especie.hide();
                    elementos.otra_especie_div.hide();
                }
                     elementos.Tipodeapoyo.val(res.tipo_apoyo);

                if(res.pais=="México"){
                    elementos.paises.val(res.pais);  
                    elementos.estadooregion.show();
                    elementos.estadooregion.val(res.entidad);

                    document.getElementById('otro_text').type = 'hidden';
                }else{
                    if(res.pais=="EUA"){
                        elementos.estadooregion.hide();
                        elementos.paises.val(res.pais);
                        document.getElementById('otro_text').type = 'hidden';
                        document.getElementById('estado').type = 'text'; 
                        document.getElementById("estado").value= res.entidad;                           
                    }else{
                        elementos.paises.val("Otro");
                        elementos.estadooregion.hide();
                        document.getElementById('otro_text').type = 'text';
                        document.getElementById('otro_text').value= res.pais;
                        document.getElementById('estado').type = 'text';
                        document.getElementById("estado").value= res.entidad;  

                    }

                }
                
                elementos.numerodefactura.val(res.factura);

                if(res.importe== "0.00" ){
                    elementos.importe_apoyo.val(res.importe_ext);
                    elementos.abono.val(res.importe_ext);
                    elementos.abono2.val(res.importe_ext);
                }else{
                    if(res.importe_ext != "" || res.importe_ext != null){
                        elementos.importe_apoyo.val(res.importe);
                        elementos.abono.val(res.importe);
                        elementos.abono2.val(res.importe); 
                    }else{
                        elementos.importe_apoyo.val(res.importe_ext);
                        elementos.abono.val(res.importe_ext);
                        elementos.abono2.val(res.importe_ext);
                    }                    
                }      
                elementos.moneda_apoyo.val(res.moneda);
                elementos.referencia_apoyo.val(res.referencia);
                elementos.observaciones.val(res.observaciones);
                elementos.mescontableflujo.val(res.mes_contabel_libretaflujo);
                elementos.fechadoctosalida.val(res.fecha_docto_salida);
                elementos.documentosalida.val(res.docto_salida);
                elementos.poliza.val(res.poliza);
                elementos.idSaldo.val(res.saldo);



                apoyo.showArchivos(res.archivos);
                //alert(res.archivos[1].id_archivos);

            }
        }
    });


    apoyo.showArchivos = function(archivos){
        var tabla = $("#tabla-archivos");

        var fila = '<tr class="success">'
                        +'<td  id="id_upload">1</td>'
                        +'<td id="u_pdf"><button class="btn btn-primary">Subir</button></td>'
                        +'<td id="u_xml"><a href="#">Archivo.xml</a><button class="btn btn-primary">Subir</button></td>'
                        +'<td id="actualizar_fila_u"><button class="btn btn-primary">Actualizar</button></td>'
                        +'<td id="borrar_fila_u"><button class="btn btn-danger">Eliminar</button></td>'
                    +'</tr>';

        $("#tbodyid").empty();  // Limpia contenido de tbody de

        archivos.forEach(function(a){
            buttonPdf = '<button class="btn btn-primary">Subir</button>';
            buttonXml ='<button class="btn btn-primary">Subir</button>';
            pdf = (a.pdf)? a.pdf : buttonPdf;
            xml = (a.xml)? a.xml : buttonXml;
            tabla.append('<tr class="success">'
                        +'<td  id="id_upload">'+a.id_archivos+'</td>'
                        +'<td id="u_pdf"><a href="archivos/pdf/'+pdf+'" target="_blank">'+pdf+'</a></td>'
                        +'<td id="u_xml"><a href="archivos/xml/'+xml+'" target="_blank">'+xml+'</a></td>'
                        +'<td id="borrar_fila_u"><button class="btn btn-danger" onclick="apoyo.deleteArchivo('+a.id_archivos+');">Eliminar</button></td>'
                    +'</tr>');
        })
    }
};

apoyo.add = function(editMode){
	var data = apoyo.elem;
	var action = "addApoyo";
    
    var idApoyo = 0;
    var forUpdate = false;
    
    if (editMode == true)
        forUpdate = true;
    
    var paises = data.paises.val();
    var estado = null;

    if(paises=="México"){
         estado = data.estadooregion.val();  
    }else{
        if(paises=="Otro"){
           paises = document.getElementById('otro_text').value;
           estado = document.getElementById("estado").value;  
        }else{
            estado = document.getElementById("estado").value;  
        }
    }

    var tipo = data.Tipodeapoyo.val();
    var cantidad = null;
    var unidad = null;


    if(tipo=="2"){
         cantidad = data.cantidad.val(); 
         unidad = data.unidad.val();

         if(unidad=="Otro"){
            unidad = data.otra_especie.val();
         } 
    }

    var importe = null;
    var importe_ext = null;
    var moneda = data.moneda_apoyo.val();

    if(moneda == "1"){
         
        if(data.abono.val()) importe = data.abono.val(); else  importe = "0.00";
    }else{
        if(data.abono.val()) importe_ext = data.abono.val(); else  importe_ext = "0.00";
    }

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

                    importe:  importe,
                    importe_ext:  importe_ext,
                    
                    mes_captura_anamaria: data.mescaptura.val(),
                    fecha_captura_anamaria: data.fechacaptura.val(),
                    mes_contable_anamaria: data.mescontableana.val(),
                    folio: data.folio_apoyo.val(),
                    frecuencia: data.frecuencia.val(),
                    id_especie: data.especie.val(),
                    id_proveedor: data.proveedor.val(),
                    id_donatario: data.donatario.val(),
                    id_evento: data.evento.val(),
                    tipo_apoyo:    data.Tipodeapoyo.val(),
                    unidad:    unidad,
                    cantidad: cantidad,
                    pais:       paises,
                    entidad:    estado,
                    factura:    data.numerodefactura.val(), 
                    // data.importe_apoyo.val(),
                    moneda: data.moneda_apoyo.val(),
                    referencia: data.referencia_apoyo.val(),
                    fecha_recibo: data.fecharecibo.val(),
                    observaciones: data.observaciones.val(),
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

    if ($.trim(data.proveedor.val())=="" && $.trim(data.donatario.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.proveedor,"Debe existir un proveedor o un donatario");
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


apoyo.abono = function(){
    var data = apoyo.elem;

    data.importe_apoyo.val(data.abono.val());
    data.abono2.val(data.abono.val());
};


apoyo.nuevo = function(){
    var elementos = apoyo.elem;
    elementos.btn_save.text("Guardar");
    elementos.btn_save2.text("Guardar");
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
    elementos.evento.val(1);
    elementos.proveedor.val(0);
    elementos.donatario.val(0);
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

    elementos.unidad.hide();
    elementos.unidad_div.hide();
    elementos.otra_especie.hide();
    elementos.otra_especie_div.hide();
    elementos.cantidad.hide();
    elementos.cantidad_div.hide();
    elementos.especie.hide();
    elementos.especie_div.hide();

    elementos.tabla_eventos_div.hide();
};

apoyo.pais = function (){
    var elem = apoyo.elem;
    var valor = document.getElementById("paises").value;  
    
    if(valor=="México"){ 
        elem.estadooregion.show();
        document.getElementById('otro_text').type = 'hidden';
        document.getElementById('estado').type = 'hidden';
        
    }else{
       if(valor=="Otro"){ 
             elem.estadooregion.hide();
              document.getElementById('otro_text').type = "text";
            document.getElementById('estado').type = 'text';

         }else{
                elem.estadooregion.hide();
                document.getElementById('otro_text').type = 'hidden';
                document.getElementById('estadooregion').type = 'hidden';
                document.getElementById('estado').type = 'text';
         }
    }
};



apoyo.validaArchivos = function () {
     var data = apoyo.elem;
    var valid = true;
    utilerias.removeErrorMessages();
    
    
    if ($.trim(data.archivo_up_pdf.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.archivo_up_pdf,"Se debe ingresar un PDF");
    }
    if ($.trim(data.archivo_up_xml.val())=="") {
        valid = false;
        utilerias.displayErrorMessage(data.archivo_up_xml,"Se debe ingresar un XML");
    }

    return valid;
};

apoyo.tipoApoyo = function () {
     var data = apoyo.elem;

     var tipo= data.Tipodeapoyo.val();
    
    if(tipo == "2"){
        /// especie
        data.unidad.show();
        data.unidad_div.show();
        //data.otra_especie.show();
        data.cantidad.show();
        data.cantidad_div.show();
        data.especie.show();
        data.especie_div.show();
    }else{
        data.especie.hide();
        data.especie_div.hide();
        data.unidad.hide();
        data.unidad_div.hide();
        data.otra_especie.hide();
        data.otra_especie_div.hide();
        data.cantidad.hide();
        data.cantidad_div.hide();
    }
    
};

apoyo.otro = function () {
     var data = apoyo.elem;

     var unidad= data.unidad.val();
    
    if(unidad == "Otro"){
        data.otra_especie.show();
        data.otra_especie_div.show();
    }else{
        data.otra_especie.hide();
        data.otra_especie_div.hide();
    }
    
};

apoyo.filtro = function () {

    var data = apoyo.elem;

    var evento= data.evento.val();
    var anio = data.anio.val();
    if(evento && anio){
    $.ajax({
        type:   "post",
        url:    "ajax.php",
        data:   {
            action:"getApoyoEventos",
            id_evento: evento,
            anio: anio
        },
        success: function(result){
            var res = JSON.parse(result);
            
            if(res.status == "error"){
                $("#tbodyid_eventos").empty();
               // utilerias.displayErrorServerMessage(data.msj_server, res.message);
            }else{

                data.tabla_eventos_div.show();

                var tabla = $("#tabla_eventos");

                var fila = '<tr class="success">'
                                    +'<td  id="id_upload">1</td>'
                                    +'<td id="u_pdf"><button class="btn btn-primary">Subir</button></td>'
                                    +'<td id="u_xml"><a href="#">Archivo.xml</a><button class="btn btn-primary">Subir</button></td>'
                                    +'<td id="actualizar_fila_u"><button class="btn btn-primary">Actualizar</button></td>'
                                    +'<td id="borrar_fila_u"><button class="btn btn-danger">Eliminar</button></td>'
                                +'</tr>';

                                

                $("#tbodyid_eventos").empty();  // Limpia contenido de tbody de

                res.forEach(function(r){
                    tabla.append('<tr onclick="apoyo.verApoyo('+r.id_apoyo+');">'
                                +'<td>'+r.id_apoyo+'</td>'
                                +'<td >'+r.concepto+'</a></td>'
                                +'<td >'+r.nombre+'</td>'
                                +'<td >'+r.factura+'</td>'
                                +'</tr>');
                })
                

                //apoyo.showEventos(res.archivos);
                //alert(res.archivos[1].id_archivos);

            }
        }
    });
    }
};



apoyo.deleteArchivo = function (idArchivo) {
    var data = apoyo.elem;

    var c = confirm('Está seguro de realizar la operación');
    if (c) {
        $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                action: "deleteArchivo",
                idArchivo: idArchivo
            },
           success: function(result){
                if(result.status == "error"){
                    utilerias.displayErrorServerMessage(elem.msj_server, result.message);
                }else{
                    utilerias.displaySuccessMessage($("#mensajes-server"),result.message);

                    $("#tbodyid").empty();  
                    verApoyo(data.idApoyo.val());
                }
           }
        });
    }
};


apoyo.updateArchivo = function(idArchivo){
    var data = apoyo.elem;
    var action = "updateArchivo";


            $.ajax({
            type: "post",
            url: "ajax.php",
            dataType: "json",
            data: {
                    idArchivo : idArchivo,
                    pdf: data.archivo_up_pdf.val(),
                    xml: data.archivo_up_xml.val(),

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

};


apoyo.addArchivos = function(){
    var data = apoyo.elem;

    if(apoyo.validaArchivos()){
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
                     ,
                    success: function(result){
                    if(result.status == "error"){
                        utilerias.displayErrorServerMessage(elem.msj_server, result.message);

                    }else{  
                             utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
                             verApoyo(data.idApoyo.val());
                         }
                    }
                });
    }
};


apoyo.verPolizaSinCheque = function(){

var data = apoyo.elem;

/*
    var postData = 
                {
                    "proveedor": data.proveedor.val(),
                    "donatario": data.donatario.val(),
                    "abono": data.abono.val()
                };
    var dataString = JSON.stringify(postData);
*/
    var prov = document.getElementById("proveedor");
    var dona = document.getElementById("donatario");

    var idApoyo = data.idApoyo.val();
    var proveedor= prov.options[prov.selectedIndex].text;
    var donatario= dona.options[dona.selectedIndex].text;
    var abono= data.abono.val();
    var concepto= data.concepto.val();
 if(abono) abono= data.abono.val(); else abono = 0.00;
    
           /*   $.ajax({
                    type: "post",
                    url: "views/poliza_sin_cheque.php",
                    dataType: "json",
                    data: {
                            proveedor: data.proveedor.val(),
                            donatario: data.donatario.val(),
                            abono: data.abono.val()
                        },
                        success:  function (response) {
                                setTimeout(window.location='index.php?op=poliza',3000);
                        }
                                                       
                });
              */


             // window.location.href='index.php?op=poliza';
    //setTimeout(window.location='index.php?op=poliza',3000);
    window.open('index.php?op=poliza&concepto='+concepto+'&proveedor='+proveedor+'&donatario='+donatario+'&abono='+abono,'_blank');
};

apoyo.verCuenta = function(){

    var data = apoyo.elem;

    var cuenta= document.getElementById("cuenta_nombre");
    var firma= document.getElementById("firma_cambio");
    var moneda= document.getElementById("moneda_modal");
    var evento= document.getElementById("evento");
    var abono= document.getElementById("abono").value;
    var tipo= document.getElementById("tipo_cambio").value;
    var fecha= document.getElementById("fecharecibo").value;
    var concepto= document.getElementById("concepto").value;
    var folio = document.getElementById("folio_apoyo").value;
    var proveedor = document.getElementById("proveedor");
    var donatario = document.getElementById("donatario");
    var factura = document.getElementById("numerodefactura").value;
    var observaciones = document.getElementById("observaciones").value;
    var moneda = document.getElementById("moneda_modal").value;
    var fecha_cambio = document.getElementById("fecha_cambio").value;
    
       
    proveedor = proveedor.options[proveedor.selectedIndex].text;

 if(!proveedor) proveedor = donatario.options[donatario.selectedIndex].text;

 if(abono) abono= abono; else abono = 0.00;
    evento = evento.options[evento.selectedIndex].text;
    firma = firma.options[firma.selectedIndex].text;
    cuenta = cuenta.options[cuenta.selectedIndex].text;
 

  if(moneda == "1"){
        $.ajax({
                type: "post",
                url: "ajax.php",
                dataType: "json",
                data: {
                        idApoyo : data.idApoyo.val(),
                        tipo_cambio : tipo,
                        fecha_cambio: fecha,
                        moneda: moneda,
                        folio: data.folio_apoyo.val(),
                        action: "updateImporteApoyo"
                    },
                    success: function(result){
                    if(result.status == "error"){
                        utilerias.displayErrorServerMessage(elem.msj_server, result.message);                      
                    }else{  
                         if(result.importe != "0.00")
                            abono = result.importe;

                             utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
                            window.open('index.php?op=cuenta&observaciones='+observaciones+'&factura='+factura+'&proveedor='+proveedor+'&folio='+folio+'&abono='+abono+'&concepto='+concepto+'&cuenta='+cuenta+'&firma='+firma+'&moneda='+moneda+'&tipo='+tipo+'&fecha='+fecha+'&evento='+evento,'_blank');
                         }
                    }
            });
   }else{
            window.open('index.php?op=cuenta&observaciones='+observaciones+'&factura='+factura+'&proveedor='+proveedor+'&folio='+folio+'&abono='+abono+'&concepto='+concepto+'&cuenta='+cuenta+'&firma='+firma+'&moneda='+moneda+'&tipo='+tipo+'&fecha='+fecha+'&evento='+evento,'_blank');
   }
    

    
   
};

apoyo.verTransf = function(){

    var data = apoyo.elem;
    var proveedor= document.getElementById("proveedor").value;
    var firma= document.getElementById("firma_transf");
    var tipo= document.getElementById("tipo_transf");
    var mostrar= document.getElementById("mostrar_transf");
    var referencia= document.getElementById("referencia_apoyo").value;
    var folio= document.getElementById("folio_apoyo").value;
    var evento= document.getElementById("evento");
    var abono= document.getElementById("abono").value;
    var concepto= document.getElementById("concepto").value;
    
    if(!proveedor) proveedor = document.getElementById("donatario").value;
    

    var tipo= tipo.options[tipo.selectedIndex].text;
    var mostrar= mostrar.options[mostrar.selectedIndex].text;
    var firma= firma.options[firma.selectedIndex].text;
    var abono= data.abono.val();
    if(abono) abono= abono; else abono = 0.00;

    
    var cuenta=null;
    var banco=null;
    var sucursal=null;
    var plaza=null;

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {
            action: "getProveedor",
            id_proveedor : proveedor
        },
        success: function(result){
            var res = JSON.parse(result);
            
            cuenta= res.cuenta;
            banco= res.banco;
            sucursal= res.sucursal;
            plaza= res.plaza;
            proveedor = res.razon_social;
            concepto = res.concepto;

            setTimeout(window.open('index.php?op=solicitud&plaza='+plaza+'&sucursal='+sucursal+'&banco='+banco+'&cuenta='+cuenta+'&proveedor='+proveedor+'&firma='+firma+'&tipo='+tipo+'&mostrar='+mostrar+'&referencia='+referencia+'&folio='+folio+'&abono='+abono+'&concepto='+concepto,'_blank'), 3000);

        }
    });

};

apoyo.verCheque = function(){

    var nombre= document.getElementById("proveedor");
    var abono= document.getElementById("abono").value;
    var concepto= document.getElementById("concepto").value;
    var descripcion= document.getElementById("observaciones").value;
 if(!abono) abono = 0.00;
    nombre = nombre.options[nombre.selectedIndex].text;

    
    window.open('index.php?op=cheque&abono='+abono+'&concepto='+concepto+'&nombre='+nombre+'&descripcion='+descripcion,'_blank');
};



/*

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
*/