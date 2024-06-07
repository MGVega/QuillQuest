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

    //headerfixed();
    
});


// Función para mostrar una página específica y ocultar las demás
    function mostrarPagina(paginaId) {
        // Ocultar todas las páginas
        var paginas = document.getElementsByClassName('content-page');
        for (var i = 0; i < paginas.length; i++) {
            paginas[i].style.display = 'none';
        }
        // Mostrar la página seleccionada
        document.getElementById('page-' + paginaId).style.display = 'block';
    }

    // Inicialmente, ocultar todas las páginas
    document.addEventListener('DOMContentLoaded', function() {
        var paginas = document.getElementsByClassName('content-page');
        for (var i = 0; i < paginas.length; i++) {
            paginas[i].style.display = 'none';
        }
    });


eventsSelects = function(){};

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

//Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", function() {
      smoothScrollToTop();
    });

// Smooth scroll function
function smoothScrollToTop() {
  const scrollDuration = 300; // Duration in milliseconds
  const scrollStep = -window.scrollY / (scrollDuration / 15);
  const scrollInterval = setInterval(function() {
    if (window.scrollY != 0) {
      window.scrollBy(0, scrollStep);
    } else {
      clearInterval(scrollInterval);
    }
  }, 15);
}

function modalFotos(){}


leerHistoria = function(historia_id){
    
    var params = new Object();
    params.controller = 'webController';
    params.function = 'leerHistoria';
    params.historia_id = historia_id;

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);
    
};

function registrarUsuario() {
    
    // Validar campos
    var nombre = $("#nombre").val();
    var apellidos = $("#apellidos").val();
    var email = $("#email").val();
    var pass1 = $("#pass1").val();
    var pass2 = $("#pass2").val();
    
    var params = new Object();
    params.controller = 'webController';
    params.function = 'registrarUsuario';
    params.name = nombre;
    params.lastname = apellidos;
    params.email = email;
    params.password = pass1;
        
    // Realizar validaciones aquí
    var error = '';

    // Validación de campo obligatorio: nombre
    if (nombre.trim() === '' && email.trim() === '' && pass1.trim() === '' && pass2.trim() === '') {
        error += 'Los campos con un asterisco (*) son obligatorios. ';
    }

    // Ejemplo de validación: contraseña igual
    if (pass1 !== pass2) {
        error += 'Las contraseñas no coinciden. ';
    }

    // Ejemplo de validación: longitud de la contraseña
    if (pass1.length < 8) {
        error += 'La contraseña debe tener al menos 8 caracteres. ';
    }

    // Ejemplo de validación: email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        error += 'El correo electrónico no es válido. ';
    }

    // Mostrar mensaje de error o éxito
    if (error !== '') {
        $("#errorRegistro").text(error);
    } else {
        error = '';
        
        var values = JSON.stringify(params);
        sendToServer(values, afterDo);
    }
};