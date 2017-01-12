 $(document).ready(function () { 	
 	$("#login-form").submit(function () {
    	return false;
    });
 	

    $("#btn-login").click(function () {
        var  user    = $("#login-username"),
             pass    = $("#login-password");

       if(login.validateLogin(user, pass) === true) { 
            var data = {
                username: user.val(),
                password: pass.val()
            };
                        
            login.loginUser(data);
       }

    });
    $("#login-username").focus();
});


var login = {};

login.loginUser = function (data) {

    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: "json",
        data: {            
            username: data.username,
            password: data.password,
            action  : "logearse",
        },
        success: function (result) {           
           if( result.status === 'success' )  
               window.location.href = result.page;             
           else {
               
               utilerias.displayErrorMessage($("#errores"), result.message);
           }

        }
    });
};

login.validateLogin = function (un, pass) {
    var valid = true;
    var msg = "";
    var error = $("#errores");

    utilerias.removeErrorMessages();

    if($.trim(un.val()) == "") {
        msg = "<br>El usuario es requerido";
        utilerias.displayErrorMessage(error,msg);
        valid = false;
    }
    if($.trim(pass.val()) == "") {
        msg = "<br> Password es requerido";
        utilerias.displayErrorMessage(error,msg);
        valid = false;
    }

    return valid;
};