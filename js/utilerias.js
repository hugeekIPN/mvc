
var utilerias = {};

utilerias.displaySuccessMessage = function (elemnt, message) {
   if(typeof message !== "undefined") {
        element.append(message);
    }
};


utilerias.displayErrorMessage = function(element, message) {
    if(typeof message !== "undefined") {
        element.append(message);
    }
};

utilerias.removeErrorMessages = function () {
    $("#errores").empty();
};


