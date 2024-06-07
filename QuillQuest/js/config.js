/* 
 * Developed by wilowi
 */

// --- PRODUCTION --//
/*var urlAjax='https://www.QuillQuest.com/controllers/actionController.php';
 var rootUrl = 'https://www.QuillQuest.com/';
 var urlLogin = 'https://www.QuillQuest.com/admin';*/
// -----------------//

//DEVELOP
/*var urlAjax='https://QuillQuest.wilowi.com/controllers/actionController.php';
 var rootUrl = 'https://QuillQuest.wilowi.com/';
 var urlLogin = 'https://QuillQuest.wilowi.com/admin';*/
// -----------------//

/*var urlAjax = 'http://localhost/QuillQuest/QuillQuest/controllers/actionController.php';
var rootUrl = 'http://localhost/QuillQuest/QuillQuest/';
var urlLogin = 'http://localhost/QuillQuest/QuillQuest/admin';*/

var urlAjax = 'https://90dd-92-172-228-51.ngrok-free.app/quillquest/quillquest/controllers/actionController.php';
var rootUrl = 'https://90dd-92-172-228-51.ngrok-free.app/quillquest/quillquest/';
var urlLogin = 'https://90dd-92-172-228-51.ngrok-free.app/quillquest/quillquest/admin';

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
