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
					utilerias.displayErrorServerMessage($("#mensajes-server"),result.message);
				}else{
					$("#formulario-programas :input").val('');
					utilerias.displaySuccessMessage($("#mensajes-server"),result.message);
					location.reload();
				}
			}
		});
	}
};



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




