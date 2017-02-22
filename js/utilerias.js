var utilerias = {};

utilerias.displaySuccessMessage = function (element, message) {
    $(".alert").remove();
    var div = ("<div class='alert alert-success'>"+message+"</div>");
    element.append(div);
    element.show();
};

utilerias.displayErrorServerMessage = function(element,message){
	$(".alert").remove();
    var div = ("<div class='alert alert-danger'>"+message+"</div>");
    element.append(div);
    element.show();
}

utilerias.displayErrorMessage = function(element, message) {
    var input = element.parent(); // obtiene el contenedor del input
    input.addClass("has-error");
    if(typeof message !== "undefined") {
        var error = $("<span class='help-inline text-danger'>"+message+"</span>");
        input.append(error);
    }
};

utilerias.removeErrorMessages = function () {
    $(".input").removeClass("has-error");
    $(".help-inline").remove();
    $("#mensajes-server").hide();
};


