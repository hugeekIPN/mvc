var eventos = {};


/**
* Elementos a manipular del usuario
* Se capturan los objetos html
**/
eventos.elementos = {
	nombre : $("#inputNombreEventos"),
    eventoId : $("#inputIDEventos"),
    subProgId : $("#inputIDSubEventos"),
    eventoDesc : $("#inpuDescripcionEventos"),
	pais : $("#inputPaisEventos"),
	ciudad : $("#inputCiudadEventos"),
    entidad : $("#inputEntidadEventos"),
    estado : $("#inputEstadoEventos"),
    fechaEvento : $("#inputFechaCreacionEventos"),
	 button : $("#btn-add-evento"),
};

eventos.verEvento = function (eventoId){

	//ocultamos el boton de acutalizar
	var update_button = $("#btn-update-evento");
	update_button.hide();

	$("#btn-delete-evento").show();


	utilerias.removeErrorMessages();
	$("#inputIDEventos").val(eventoId);	
	
    $.ajax({
		type: "POST",
		url: "ajax.php",
		data: {
			action: "getEvento",
			eventoId : eventoId
		},
		success: function(result){
			var res = JSON.parse(result);

			//ocultamos formulario
			$("#eventos").hide();

			//asignamos los valores a visualizar
			$("#vista-id").text(res.id_evento);
			$("#vista-nombre").text(res.nombre);
			$("#vista-desc").text(res.descripcion);

			//mostramos los datos en el contenedor
			$("#datos-evento").show();

			//cambiamos a visible el boton editar
			$("#btn-edit-evento").show();
		}
	});
};

eventos.addEvento = function (editMode) {
    var data  = usuarios.elementos;
    var modal = $("#modal-add-edit-evento");
    var btn   = $("#btn-add-evento");
    var action = "addEvento";
    var usuarioId = 0;
    var forUpdate = false;

    if ( editMode == true)
        forUpdate = true;

    if ( usuarios.validaDatosEvento(data, forUpdate) ) {

       
        if ( editMode ) {
            action = "updateEvento";
            eventoId = $("#eventoId").val();

        }      

        $.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: {
				eventoId : eventoId,
				nombre : data.nombre.val(),
                eventoDesc : data.eventoDesc.val(),
				action : action
				},
			success: function(result){
				if(result.status == "error"){
					utilerias.displayErrorServerMessage($("#mensajes-server"),result.message);
				}else {
					$("#formulario-usuario :input").val('');
					utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
				}
			}
		});		
    }
};


/**
* Funcion cuando se pulse el boton editar. 
* En este caso se muestra un formulario con los datos
**/
eventos.editEvento = function(){
	var data = eventos.elementos;
    var eventoId= data.eventoId.val();

    //mostramos el boton de agregar nuevo usuario
    data.button.show();

    //ocultamos el boton editar
    $("#btn-edit-user").hide();

    //activamos el de acutalizar
	var update_button = $("#btn-update-evento");
	update_button.show();
	update_button.attr('onclick','eventos.updateEvento()');

	//mostramos el formulario
	$("#cont-formulario").show();

	//ocultamos datos de visualizacion
	$("#datos-usuario").hide();

	utilerias.removeErrorMessages();
	
    if(userId >0){
    $.ajax({
		type: "POST",
		url: "ajax.php",
		data: {
			action: "getEvento",
			eventoId: eventoId
		},
		success: function(result){
			var res = JSON.parse(result);

			data.nombre.val(res.nombre);
			data.eventoDesc.val(res.eventoDesc);
		}
	});
        }
};


/**
* Funcion que llama a agregar nuevo usuario, con modalidad de actualizacion
**/
eventos.updateEvento = function () {
    eventos.addEvento(true);
};


eventos.verFormularioVacio = function(){
	location.reload();

	//activamos opcion para guardar
	var save_button = $("#btn-update-evento");
	save_button.show();
	update_button.attr('onclick','eventos.addEvento()');
}

eventos.deleteEvento = function(){
    var data = eventos.elementos;
    var eventoId= data.eventoId.val();
	var c= confirm('Estás seguro de esto?');
	if(c){
		$.ajax({
			type: "post",
			url: "ajax.php",
			data: {
				action: "deleteEvento",
				usuarioId: eventoId
			},
			success: function(result){
				if(result.status == "error")
					utilerias.displayErrorMessage($("#mensajes-server"),result.message);
				else
					location.reload();
			}
		});
	}
};


/**
* Funcion para validar lod datos ingresados por el usuario
* !!! En caso de actualizacion, habría que validar si el correo se puede usar
**/
eventos.validaDatosEvento = function(data,forUpdate){
	var valid = true;
	var msg = "";

	utilerias.removeErrorMessages();

	if($.trim(data.nombre.val())==""){
		valid = false;
		utilerias.displayErrorMessage(data.nombre,"El nombre de usuario es requerido");
	}

	return valid;

};

/**
* Funcion para validar mail
* Tomado de http://www.w3schools.com/js/tryit.asp?filename=tryjs_form_validate_email
**/
