// --- FUNCTIONS "do" ---

doLogin = function () {

    var params = new Object();
    params.controller = 'webController';
    params.function = 'login';
    params.user = $('#usuario').val();
    params.password = $('#password').val();

    var values = JSON.stringify(params);
    sendToServer(values, afterLogin);

};

doRecoverPassword = function () {

    $('#modal_loading').modal('show');

    var params = new Object();
    params.controller = 'webController';
    params.function = 'recoveryPassword';
    params.email = $('#email').val();

    var values = JSON.stringify(params);
    sendToServer(values, afterLogin);


};

afterLogin = function (Data) {

    if (Data.result == 'loginTrue') {

        window.location.href = 'panel';
        scrollSmooth();

    } else {

        $('#resultLogin').empty();
        $('#resultLogin').append(Data.result);
    }

};



$(document).ready(function () {

    onSubmit = function (DataCallback){
        
        var params = new Object();
        params.response = DataCallback;
        params.controller = 'webController';
        params.function = 'googleCaptcha';
        var valores = JSON.stringify(params);
        sendToServer(valores,function(Data){
            //console.log(Data);
            //console.log(Data.success);
            
            if(Data.success){
                
                $("#btnLogin").prop("disabled",false);
                $("#btnLogin").removeClass("notDisplay");
            }
            
        });
        
        
    };
    
    onExpire = function (){
        
        $("#btnLogin").prop("disabled",true);
        $("#btnLogin").addClass("notDisplay");
    };

    headerfixed();
    
});

headerfixed = function(){
    // para el menu
    var divPueblo = $('.menuPrincipalPueblo').attr('id_menu');

    if (divPueblo === '1') {
        var altura = $('.menuPrincipalPueblo').offset().top;

        $(window).on('scroll', function () {
            if ($(window).scrollTop() > altura) {
                $('.menuPrincipalPueblo').addClass('menu-fixed');
                $('.menuPrincipalPueblo').removeClass('fixed-top');
            } else {
                $('.menuPrincipalPueblo').addClass('fixed-top');
                $('.menuPrincipalPueblo').removeClass('menu-fixed');
            }
        });
    }
    
};

eventsSelects = function(){
    
   
    
};

actualizarSelect = function (preguntaId, selectId) {

    if (selectId === 4 || selectId===3) {
        
        var id = $('#preguntaSelect' + preguntaId + selectId).val();

        var params = new Object();
        params.controller = 'webController';
        
        
        if (selectId === 4) {
            params.function = 'obtenerProvinciasComunidades';
            params.country_id = id;
        }else{
            params.function = 'obtenerProvincias';
            params.comunidad_id = id;
        }        

        var values = JSON.stringify(params);
        sendToServer(values, function(Data){
            
            var objeto = jQuery.parseJSON(Data.result);

            if (id === "207" && selectId === 4) {
                
                // Comunidad
                $('#preguntaSelect' + preguntaId + '3').css('display', 'block');
                $('#preguntaSelect' + preguntaId + '3').empty();
                $('#preguntaSelect' + preguntaId + '3').append('<option value="0">Seleccione Comunidad</option>');
                for (var index = 0; index < objeto.comunidades.length; index++) {
                    $('#preguntaSelect' + preguntaId + '3').append('<option value="'
                            + objeto.comunidades[index].state_id + '" country_id="'
                            + objeto.comunidades[index].country_id + '" class="eventComunidad">'
                            + objeto.comunidades[index].name + '</option>');
                }
                
                //-- Provincia
                $('#preguntaSelect' + preguntaId + '2').css('display', 'block');
                $('#preguntaSelect' + preguntaId + '2').empty();
                $('#preguntaSelect' + preguntaId + '2').append('<option value="0">Seleccione Provincia</option>');
                for (var index = 0; index < objeto.provincias.length; index++) {
                    $('#preguntaSelect' + preguntaId + '2').append('<option value="'
                            + objeto.provincias[index].state_id + '" country_id="'
                            + objeto.provincias[index].country_id + '" class="eventState">'
                            + objeto.provincias[index].name + '</option>');
                }

                $('#preguntaSelect' + preguntaId + '1').css('display', 'block');

            } else if(selectId === 3){
                
                //-- Provincia
                $('#preguntaSelect' + preguntaId + '2').css('display', 'block');
                $('#preguntaSelect' + preguntaId + '2').empty();
                $('#preguntaSelect' + preguntaId + '2').append('<option value="0">Seleccione Provincia</option>');
                for (var index = 0; index < objeto.provincias.length; index++) {
                    $('#preguntaSelect' + preguntaId + '2').append('<option value="'
                            + objeto.provincias[index].state_id + '" country_id="'
                            + objeto.provincias[index].country_id + '" class="eventState">'
                            + objeto.provincias[index].name + '</option>');
                }

                $('#preguntaSelect' + preguntaId + '1').css('display', 'block');
                
            }else {
                
                $('#preguntaSelect' + preguntaId + '1').css('display', 'none');
                $('#preguntaSelect' + preguntaId + '2').css('display', 'none');
                $('#preguntaSelect' + preguntaId + '3').css('display', 'none');
            }
            
            
            
        });


    } else if(selectId===2){        
        
        var id = $('#preguntaSelect' + preguntaId + selectId).val();

        var params = new Object();
        params.controller = 'webController';
        params.function = 'obtenerCiudades';
        params.state_id = id;

        var values = JSON.stringify(params);
        sendToServer(values, function(Data){
            
            var objeto = jQuery.parseJSON(Data.result);

            //Ciudad
            $('#preguntaSelect' + preguntaId + '1').css('display', 'block');
            $('#preguntaSelect' + preguntaId + '1').empty();
            $('#preguntaSelect' + preguntaId + '1').append('<option value="0">Seleccione Ciudad</option>');
            for (var index = 0; index < objeto.ciudades.length; index++) {
                $('#preguntaSelect' + preguntaId + '1').append('<option value="' 
                        + objeto.ciudades[index].city_id + '" country_id="'
                        + objeto.ciudades[index].country_id+'" state_id="'
                        + objeto.ciudades[index].state_id+' class="eventCity">' 
                        + objeto.ciudades[index].name + '</option>');
            }
            
        });
        
    }
  
};

/*- - - - - - - - - - Encuesta - - - - - - - - - -*/
function encuestaSiguiente(preguntaid) {
    
    /*var encuesta = $('#formularioEncuesta');
    if (!encuesta.is(':animated')) {
        var pregunta = "#encPregunta" + preguntaid;
        $(pregunta).show();
        $('#encPreguntaFin').insertAfter(pregunta);

        encuesta.animate({
            marginLeft: '-=100%'     // La distancia que tiene que recorrer la imagen hacia la derecha
        }, 700, function () { // Callback
        });
    }*/
    
    var pregunta = "#encPregunta" + preguntaid;
    var preguntaAnterior = preguntaid - 1;

    $(pregunta).removeClass('displayNone');
    $('#encInicio').addClass('displayNone');
    $('#encPregunta'+preguntaAnterior).addClass('displayNone');
    
    /*window.location = "#encPregunta"+preguntaid;
     history.pushState("", document.title, window.location.pathname
     + window.location.search);*/
}
;

function encuestaVolver(preguntaid) {
    
    /*var encuesta = $('#formularioEncuesta');
    if(!encuesta.is(':animated')){
    encuesta.animate({
                marginLeft: '+=100%'     // La distancia que tiene que recorrer la imagen hacia la derecha
            }, 700, function () { // Callback
                preguntaid++;
                var pregunta = "#encPregunta"+preguntaid;
                $(pregunta).hide();
            });
        }*/
    
    var pregunta = "#encPregunta" + preguntaid;
    var preguntaAnterior = preguntaid + 1;

    $(pregunta).removeClass('displayNone');
    $('#encInicio').addClass('displayNone');
    $('#encPregunta'+preguntaAnterior).addClass('displayNone');
    
    
            
    /*window.location = "#encPregunta"+preguntaid;
    history.pushState("", document.title, window.location.pathname
            + window.location.search);*/
};

/* - - - - - - Enviar datos - - - - - */
function encuestaEnviarDatos(contadorPregunta) {
    
    var contadorSiguiente = contadorPregunta+1;
    //Scroll
    $('#encFin').removeClass('displayNone');
    encuestaSiguiente(contadorSiguiente);

    var array_pregunta = [];
    $('.eventPregunta').each(function () {
        
        var pregunta_id = $(this).attr('pregunta_id');
        var tipo_pregunta = $(this).attr('tipo_pregunta');
        
        var newObject = new Object();
        newObject.pregunta_id = pregunta_id;
        newObject.tipo_pregunta = tipo_pregunta;
        newObject.respuesta_otros = $('#respuestaOtros'+pregunta_id).val();
        newObject.select = [];
        newObject.options = [];
        
        if(tipo_pregunta==1){            
            
            $('.eventPreguntaSelect'+pregunta_id).each(function(){
                
                var select_id = $(this).attr('select_id');
                
                var selectObject = new Object();
                selectObject.select_id = select_id;
                selectObject.value = $('#preguntaSelect'+pregunta_id+select_id).val();
                
                newObject.select.push(selectObject);
                
            });
        }else if(tipo_pregunta==2){ // selección simple
            
            $('.eventPreguntaSimple'+pregunta_id).each(function(){
                
                if($(this).is(':checked')){
                    newObject.value = $(this).val();
                }
            });
            
        }else if(tipo_pregunta==3){ // selección múltiple
            
            $('.eventPreguntaMultiple'+pregunta_id).each(function(){
                
                var option_value = $(this).val();
                
                if($(this).is(':checked')){
                    newObject.options.push(option_value);
                }
                
                
            });
            
            
        }else if(tipo_pregunta==4){ // si/no
            
            if($('#respuestaSi'+pregunta_id).is(':checked')){
                newObject.value = 1;
            }else{
                newObject.value = 0;
            }
            
        }
        else{ // resto
            newObject.value = $(this).val();
        }
        
        array_pregunta.push(newObject);
        
    });
    
    
    //console.log(array_pregunta);
        
    var params = new Object();
    params.controller = 'webController';
    params.function = 'guardarEncuesta';
    params.preguntas = array_pregunta;

    var values = JSON.stringify(params);
    sendToServer(values, encuestaCallback);
    
};

function encuestaCallback (Data){
    var container = document.getElementById('mensajeFinal');
     container.innerHTML = Data.result;
};

//Visualizar en grande fotos al hacer click
$(document).ready(function(){
    
    $('.foto-web').on('click', function() {
        var rutaImagen = $(this).attr('src'); // Obtenemos el atributo de la imagen clicada. La ruta básicamente
        var modalFotos = '<div class="modalFotos" id="modalFotos"><img src="'+ rutaImagen +'"><div class="btn-cerrar" id="btnCerrar"><i class="fa fa-times"></i></div></div>';
        
        $('#fotosPueblo').after(modalFotos);
         
        $('#btnCerrar').on('click', function(){
            $('#modalFotos').remove();
        });
    });
   
    $(document).on('keyup', function(e){  //Evento cuando sueltas una tecla keyup
        if (e.which == 27){ //which para saber la tecla que se presionó. Ponemos ESC en ASCII
            $('#modalFotos').remove();
        }
    }); 
    
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modalFotos) {
            $('#modalFotos').remove();
        }
    };
    
    $("#navbarSupportedContent a:not(.dropdown-toggle)").click(function() {
      $("#navbarSupportedContent").collapse("hide");
    });
});