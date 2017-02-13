var programas = {};

/**
* se capturan los inputs de la vista
**/
programas.elementos = {
	id_programa: $("#id-programa"),
	nombre: $("#inputNombreProgramas"),
	descripcion: $("#inputDescripcionProgramas"),
	btn_add: $("#btn-add-programa"),
	btn_save: $("#btn-save"),
	btn_edit: $("#btn-edit"),
	btn_delete: $("#btn-delete"),
	msj_server: $("#mensajes-server"),
	formulario: $("#formulario-programas"),
	cont_datos: $("#datos-programas"),
};

/**
* Agregar un nuevo programa
**/
programas.add = function(){
	var data = programas.elementos;
	var action = "addPrograma";

	if(programas.validaDatos(data)){
		$.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
				nombre: data.nombre.val(),
				descripcion: data.descripcion.val(),
				action: action
				},
			success: function(result){
				if(result.status == "error"){
					utilerias.displayErrorServerMessage(data.msj_server,result.message);
				}else{
					$("#formulario-programas :input").val('');
					utilerias.displaySuccessMessage(data.msj_server,result.message);
					location.reload();
				}
			}
		});
	}
};

/**
* Valida los valores del formulario
**/
programas.validaDatos = function(data){
	var valid = true;

	utilerias.removeErrorMessages();

	if($.trim(data.nombre.val())==""){
		valid = false;
		utilerias.displayErrorMessage(data.nombre, "Se debe proporcionar un nombre");
	}

	if($.trim(data.descripcion.val())==""){
		valid = false;
		utilerias.displayErrorMessage(data.descripcion,"Se debe proporcionar una descripcion");
	}

	return valid;
};

/**
* Funcion cuando se da clic en algun elemento de la tabla.
* Permite visualizar la informacion en texto plano
**/
programas.verPrograma = function(idPrograma){

	var elem = programas.elementos;

	utilerias.removeErrorMessages();
	elem.id_programa.val(idPrograma);

	$.ajax({
		type: "post",
		url: "ajax.php",
		data: {
			action: "getPrograma",
			idPrograma: idPrograma
		},

		success: function(result){
			var res = JSON.parse(result);

			if(res.status == "error"){
				utilerias.displayErrorServerMessage(msj_server, res.message);
			}else{
				//mostramos y ocultamos botones correspondientes
				elem.btn_edit.show();
				elem.btn_save.hide();
				elem.btn_delete.show();
				

				$("#view-id-programa").text(res.id_programa);
				$("#view-nombre-programa").text(res.nombre);
				$("#view-descripcion-programa").text(res.descripcion);

				elem.formulario.hide();
				elem.cont_datos.show();
			}
		}
	});
};

/**
* Cuando se da click en el icono editar
* Muestra los datos en el formulario
**/
programas.editPrograma = function(){
	var elem = programas.elementos;
	var idPrograma = elem.id_programa.val();

	utilerias.removeErrorMessages();

	$.ajax({
		type: "post",
		url: "ajax.php",
		data: {
			action: "getPrograma",
			idPrograma: idPrograma
		},

		success: function(result){
			var res = JSON.parse(result);

			if(res.status == "error"){
				utilerias.displayErrorServerMessage(elem.msj_server, res.message);
			}else{
				//mostramos y ocultamos botones correspondientes
				elem.btn_save.attr('onclick','programas.updatePrograma();');
				elem.btn_save.show();
				elem.btn_edit.hide();
				
				elem.nombre.val(res.nombre);
				elem.descripcion.val(res.descripcion);

				elem.formulario.show();
				elem.cont_datos.hide();
			}
		}
	});
};

/**
* Funcion para actualizar los datos
**/
programas.updatePrograma = function(){
	var elem = programas.elementos;

	var idPrograma = elem.id_programa.val();

	if(programas.validaDatos(elem)){
		$.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
				idPrograma : idPrograma,
				nombre: elem.nombre.val(),
				descripcion: elem.descripcion.val(),
				action: "updatePrograma"
			},
			success: function(result){
				if(result.status == "error"){
					utilerias.displayErrorServerMessage(elem.msj_server,result.message);
				}else{
					$("#formulario-programas :input").val('');
					utilerias.displaySuccessMessage(elem.msj_server,result.message);
					location.reload();					
				}
			}
		});
	}
};



/**
* Al pulsar el icono borrar, se ejecuta la funcion
**/
programas.deletePrograma = function(){
	var elem = programas.elementos;
	var idPrograma = elem.id_programa.val();
	var c = confirm('Estás seguro de realizar la operación?');
	if(c){
		$.ajax({
			type: "post",
			url: "ajax.php",
			dataType: "json",
			data: {
				action: "deletePrograma",
				idPrograma: idPrograma
			},
			success: function(result){
				if(result.status == "error"){
					utilerias.displayErrorServerMessage(elem.msj_server,result.message);
				}
				else{
					utilerias.displaySuccessMessage(elem.msj_server,result.message);
					location.reload();
				}
			}
		});
	}
};






