/* 
 * Developed by wilowi
 */

// --- PRODUCTION --//
/*var urlAjax='https://www.mirandilla.com/controllers/actionController.php';
 var rootUrl = 'https://www.mirandilla.com/';
 var urlLogin = 'https://www.mirandilla.com/admin';*/
// -----------------//

//DEVELOP
/*var urlAjax='https://mirandilla.wilowi.com/controllers/actionController.php';
 var rootUrl = 'https://mirandilla.wilowi.com/';
 var urlLogin = 'https://mirandilla.wilowi.com/admin';*/
// -----------------//

var urlAjax = 'http://localhost/mirandilla/mirandilla/controllers/actionController.php';
var rootUrl = 'http://localhost/mirandilla/mirandilla/';
var urlLogin = 'http://localhost/mirandilla/mirandilla/admin';


// --- Enviar al servidor
sendToServer = function (parametros, funcion_callback) {
    
    var asincrono = true;
    var request = $.ajax(
	    {
		url: urlAjax,
		scriptCharset: "utf8",
		type: "POST",
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		headers: {
		    "Content-type": " application/json",
		    "Access-Control-Allow-Origin": "*",
		    "Cache-Control": "no-store, no-cache, must-revalidate"
		},
		async: asincrono,
		crossDomain: true,
		data: parametros,
		cache: false
	    });
    request.done(funcion_callback);
    request.fail(function (jqXHR, textStatus)
    {
	//console.log(jqXHR);
        //console.log(textStatus);
	alert("Lo siento, ha ocurrido un problema con la petición. Contacte con el administrador");

	return false;
    });

    return true;
};

sendToServerDoc = function (formData, funcion_callback) {

    var asincrono = true;
    var request = $.ajax(
            {
                url: urlAjax,
                type: 'POST',
                data: formData,
                async: asincrono,
                crossDomain: true,
                contentType: false,
                processData: false,
                cache: false
            });
    request.done(funcion_callback);
    request.fail(function (jqXHR, textStatus)
    {
        //console.log(jqXHR);
        alert("Lo siento, ha ocurrido un problema con la petición. Contacte con el administrador");

        return false;
    });

    return true;

};
