var usuarios = {};

usuarios.elementos = {
	username : $("#username"),
    userId : $("#usuarioId"),
	password : $("#password"),
	password_conf : $("#password-confirm"),
	button : $("#btn-submit")
};

//Al pulsar en nuevo usuario
$("#btn-add-user").click(function(){	
	$("#form-add-usuario :input").val('');
	$("#form-add-usuario :input").attr('placeholder','');
    $("#form-add-usuario :input").removeAttr('readonly', 'readonly');
	$(usuarios.elementos.button.val('Guardar'));
});

$("#btn-edit-user").click(function(){	
    $("#form-add-usuario :input").removeAttr("readonly");
	$("#form-add-usuario :input").attr('placeholder','');
	$(usuarios.elementos.button.val('Actualizar'));
});

//Capturar formulario para agregar o editar un usuario
$("#form-add-usuario").submit(function(event){
	event.preventDefault();
	var data = usuarios.elementos;
	var forUpdate = false;
	var action = "addUsuario";
	var usuarioId = 0;

	if(data.button.val() == "Actualizar"){
		forUpdate = true;
    }

	if(usuarios.validaDatosUsuario(data,forUpdate)){					
		if(forUpdate == true){
			action = "updateUsuario";
			usuarioId = $("#usuarioId").val();
		}

		$.ajax({
			type: "POST",
			url: "ajax.php",
			dataType: "json",
			data: {
				usuarioId : usuarioId,
				username : data.username.val(),
				password : data.password.val(),
				password_confirm : data.password_conf.val(),
				action : action
				},
			success: function(result){
				if(result.status == "error"){
					utilerias.displayErrorMessage($("#errores"),result.message);
				}else {
					location.reload();
				}
			}
		});			
		
	}

});

usuarios.editUser = function(){
	var data = usuarios.elementos;
    var userId= data.userId.val();
	data.button.attr('value','Actualizar');
	utilerias.removeErrorMessages();

	$("#usuarioId").val(userId);
    $("#form-add-usuario :input").removeAttr('readonly', 'readonly');
	
    if(userId >0){
    $.ajax({
		type: "POST",
		url: "ajax.php",
		data: {
			action: "getUsuario",
			userId: userId
		},
		success: function(result){
			var res = JSON.parse(result);

			data.username.val(res.nombre);
			data.password.val(res.password);
			data.password_conf.val(res.password);

			data.password.attr('placeholder', 'Deje en blanco si no desea cambiarlo');
			data.password_conf.attr('placeholder','Deje en blanco si no desea cambiarlo');
		}
	});
        }
};


usuarios.verUser = function(userId){
	var data = usuarios.elementos;
	data.button.attr('value','Actualizar');
	utilerias.removeErrorMessages();

	$("#usuarioId").val(userId);
    $("#form-add-usuario :input").attr('readonly', 'readonly');
	
    $.ajax({
		type: "POST",
		url: "ajax.php",
		data: {
			action: "getUsuario",
			userId: userId
		},
		success: function(result){
			var res = JSON.parse(result);

			data.username.val(res.nombre);
			data.password.val(res.password);
			data.password_conf.val(res.password);

			data.password.attr('placeholder', 'Deje en blanco si no desea cambiarlo');
			data.password_conf.attr('placeholder','Deje en blanco si no desea cambiarlo');
		}
	});
};

usuarios.deleteUser = function(){
    var data = usuarios.elementos;
    var userId= data.userId.val();
	var c= confirm('Estás seguro de esto?');
	if(c){
		$.ajax({
			type: "post",
			url: "ajax.php",
			data: {
				action: "deleteUsuario",
				usuarioId: userId
			},
			success: function(result){
				if(result.status == "error")
					utilerias.displayErrorMessage($("#errores"),result.message);
				else
					location.reload();
			}
		});
	}
}


usuarios.validaDatosUsuario = function(data,forUpdate){
	var valid = true;
	var msg = "";
    var error = $("#errores");

	utilerias.removeErrorMessages();

	if($.trim(data.username.val())==""){
		valid = false;
		utilerias.displayErrorMessage(error,"<br>El nombre de usuario es requerido");
	}

	if(forUpdate == true){
		if(data.password.val() != data.password_conf.val()){
			valid = false;
			utilerias.displayErrorMessage(error,"No coinciden los password");
		}

	} else{

		if($.trim(data.password.val())==""){
			valid = false;
			utilerias.displayErrorMessage(error,"<br>El password es requerido");
		}else{
			if(data.password.val() != data.password_conf.val()){
				valid = false;
				utilerias.displayErrorMessage(error, "<br>Password no coincide");
			}
		}
	}

	return valid;

};