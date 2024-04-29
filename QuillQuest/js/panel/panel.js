
var thumbnail = {
    dataUrl: 'images/avatar.png'
};
var fileReaderSupported = window.FileReader != null;


$(document).ready(function () {
    
    var params = new Object();
    params.controller = 'panelController';
    params.function = 'obtenerBalance';

    var values = JSON.stringify(params);
    sendToServer(values, function(Data){
        
        
        chargeMainChart(Data);
        
    });

    


});



controlesPeticiones = function(Data){
    
    if(Data.control_request=='graficos'){        
        
        chargePaisesChart(Data);
        chargeComunidadesChart(Data);
        chargeProvinciasChart(Data);
        chargeCiudadesChart(Data);
        chargeOptionsCharts(Data);
        
    }
    
};

chargeMainChart = function(Data){
    
    var dataChart = jQuery.parseJSON(Data.result);

    const mainChart = new Chart(document.getElementById('main-chart'), {
        type: 'line',
        data: {
            labels: dataChart.labels,
            datasets: [{
                    label: 'Encuestas totales',
                    backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle('--cui-info'), 10),
                    borderColor: coreui.Utils.getStyle('--cui-info'),
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    data: dataChart.totales,
                    fill: true
                }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        drawOnChartArea: false
                    }
                },
                y: {
                    ticks: {
                        beginAtZero: true,
                        maxTicksLimit: 5,
                        stepSize: Math.ceil(250 / 5),
                        max: 250
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                },
                point: {
                    radius: 0,
                    hitRadius: 10,
                    hoverRadius: 4,
                    hoverBorderWidth: 3
                }
            }
        }
    });
    
};

doLoadImage = function (files, name) {

    if (files != null) {
        var file = files[0];
        if (fileReaderSupported && file.type.indexOf('image') > -1) {
            $timeout(function () {
                var fileReader = new FileReader();
                fileReader.readAsDataURL(file);
                fileReader.onload = function (e) {
                    $timeout(function () {
                        thumbnail.dataUrl = e.target.result;
                        $('#' + name).attr('ng-src', e.target.result);
                        $('#' + name).attr('src', e.target.result);
                    });
                }
            });
        }
    }
};


logOut = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'logout';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

verQR = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'verQR';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

/**
 * Controlador para el apartadod e preguntas
 * @param [string} request_type -> create,modify,activate,deactivate, save
 * @param [integer} id -> pregunta id
 * @returns {undefined}
 */
preguntaRequest = function (request_type, id) {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'preguntaRequest';
    params.request_type = request_type;
    params.id = id;

    params.titulo = $('#pregunta_titulo').val();
    params.pregunta_tipo = $('#pregunta_tipo').val();

    if ($('#activar_otros').is(':checked')) {
        params.activar_otros = 1;
    } else {
        params.activar_otros = 0;
    }

    var cont_options = 1;
    params.opciones = [];
    $('.eventNewResponse').each(function () {
        if ($(this).val() != '') {

            params.opciones[cont_options] = new Object();
            params.opciones[cont_options].text = $(this).val();
            params.opciones[cont_options].order = cont_options;
            params.opciones[cont_options].option_id = $(this).attr('option_id');
            params.opciones[cont_options].delete = 0;
            

        }else{
            
            params.opciones[cont_options] = new Object();
            params.opciones[cont_options].order = cont_options;
            params.opciones[cont_options].delete = 1;
            params.opciones[cont_options].option_id = $(this).attr('option_id');
            
        }
        
        cont_options = cont_options + 1;
    });

    var cont_selects = 1;
    params.selects = [];
    $('.eventNewSelect').each(function () {

        if ($(this).is(':checked')) {

            params.selects[cont_selects] = new Object();
            params.selects[cont_selects].id = $(this).attr('select_id');
            params.selects[cont_selects].order = cont_selects;
            cont_selects = cont_selects + 1;
        }

    });

    params.num_select = cont_selects;

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};


listadoPreguntas = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'listadoPreguntas';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

encuestasRealizadas = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'encuestasRealizadas';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

graficos = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'graficos';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);    
    

};



chargeProvinciasChart = function(Data){
    
  var dataChart = jQuery.parseJSON(Data.extra);

    const mainChart = new Chart(document.getElementById('provincias-chart'), {
        type: 'bar',
        data: {
            labels: dataChart.provincias.labels,
            datasets: [{
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    data: dataChart.provincias.totales,
                    fill: true,
                    label: 'Provincias'
                }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    }); 
};

chargePaisesChart = function(Data){
    
  var dataChart = jQuery.parseJSON(Data.extra);

    const mainChart = new Chart(document.getElementById('paises-chart'), {
        type: 'bar',
        data: {
            labels: dataChart.paises.labels,
            datasets: [{
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    borderColor: 'rgba(229, 107, 157, 1)',
                    backgroundColor: 'rgba(245, 150, 189, 0.8)',
                    data: dataChart.paises.totales,
                    fill: true,
                    label: 'Países',
                }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    }); 
};

chargeComunidadesChart = function(Data){
    
  var dataChart = jQuery.parseJSON(Data.extra);

    const mainChart = new Chart(document.getElementById('comunidades-chart'), {
        type: 'bar',
        data: {
            labels: dataChart.comunidades.labels,
            datasets: [{
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    borderColor: 'rgb(255, 152, 0, 1)',
                    backgroundColor: 'rgb(255, 152, 0, 1)',
                    data: dataChart.comunidades.totales,
                    fill: true,
                    label: 'Comunidades Autónomas',
                }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    }); 
};

chargeCiudadesChart = function(Data){
    
  var dataChart = jQuery.parseJSON(Data.extra);

    const mainChart = new Chart(document.getElementById('ciudades-chart'), {
        type: 'bar',
        data: {
            labels: dataChart.ciudades.labels,
            datasets: [{
                    pointHoverBackgroundColor: '#fff',
                    borderWidth: 2,
                    borderColor: 'rgba(45,153,198,1)',
                    backgroundColor: 'rgba(45,153,198,0.8)',
                    data: dataChart.ciudades.totales,
                    fill: true,
                    label: 'Ciudades',
                }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    }); 
};

chargeOptionsCharts = function (Data) {

    var dataChart = jQuery.parseJSON(Data.extra);

    Object.values(dataChart).forEach(val => {

        if (val.pregunta_id > 0 && val.pregunta_id != 'undefined') {
            const mainChart = new Chart(document.getElementById('chart' + val.pregunta_id), {
                type: 'doughnut',
                data: {
                    labels: val.labels,
                    datasets: [{
                            pointHoverBackgroundColor: '#fff',
                            data: val.totales,
                            label: val.titulo,
                            backgroundColor: ['rgba(75, 192, 192, 1)', 'rgba(229, 107, 157, 1)', 'rgba(45,153,198,1)', 'rgba(250, 88, 88,1)', 'rgba(252, 255, 51,1)', 'rgba(139, 88, 250,1)', 'rgba(114, 114, 115,1)']
                        }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                },
                title: {
                    display: true,
                    text: val.titulo
                }
            });
        }
        
    });


};




documentos = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'documentos';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

crearRuta = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'crearRuta';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

listadoRutas = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'listadoRutas';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

/**
 * Controlador para el apartado de rutas
 * @param [string} request_type -> save
 * @param [integer} id -> ruta_id
 * @returns {undefined}
 */
rutaRequest = function (request_type, id) {
    switch (request_type) {
        case 'save':
            var form = $('#formularioRuta')[0];
            break;
        case 'update':
            var form = $('#formularioModif'+id)[0];
            break;
    };
    var formData = new FormData(form);
    var imagen = $('#ruta_imagen'+id).prop('files');

    var ruta_titulo = $('#ruta_titulo').val();

    formData.append('controller', 'panelController');
    formData.append('function', 'rutaRequest');
    formData.append('request_type', request_type);
    formData.append('id', id);

    if (ruta_titulo.trim()) {
        
        if ($('#ruta_imagen'+id).val() !== undefined) {
            // - - - - - - - - Comprobar datos subidos - - - - - - - - 
            const allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
            var fileName = $('#ruta_imagen'+id).val();
            var fileExtension = fileName.split('.').pop(); //Sacamos la extension del archivo

            if (allowedExtensions.includes(fileExtension)) {
                sendToServerDoc(formData, afterDo);
            } else {
                alert("Por favor, seleccione un tipo de archivo válido (jpg, jpeg, png o gif)");
                this.value = null;
            }
        } else {
            sendToServerDoc(formData, afterDo);
        }
                
    } else {
        alert("Por favor, introduzca al menos el título");
    }
};


/*borrarRutaArchivo = function (request_type, tipoArchivo){
    var params = new Object();
    var ruta_id = $('#idRuta').val(); //Campo invisible dentro del popup con la id del registro que vamos a modificar
    
    params.controller = 'panelController';
    params.function = 'rutaRequest';
    params.request_type = request_type;
    params.ruta_id = ruta_id;
    params.tipoArchivo = tipoArchivo;
    
    var values = JSON.stringify(params);
    sendToServer(values, listadoRutas);
};*/


borrarRuta = function(ruta_id){

    var params = new Object();
    
    params.ruta_id = ruta_id;
    params.request_type = 'delete';
    params.controller = 'panelController';
    params.function = 'rutaRequest';
    var values = JSON.stringify(params);
    
    sendToServer(values, listadoRutas);
};

perfil = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'perfil';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

modificarUsuario = function(id){
    
    var form = $('#modificarUsuario')[0];
    var formData = new FormData(form);

    formData.append('controller', 'panelController');
    formData.append('function', 'modificarUsuario');
    formData.append('id', id);
    
    if ($('#fotoNuevo').val() !== '') {
        // - - - - - - - - Comprobar datos subidos - - - - - - - - 
        const allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
        var fileName = $('#fotoNuevo').val();
        var fileExtension = fileName.split('.').pop(); //Sacamos la extension del archivo

        if (allowedExtensions.includes(fileExtension)) {
            sendToServerDoc(formData, afterDo);
        } else {
            alert("Por favor, seleccione un tipo de archivo válido (jpg, jpeg, png o gif)");
            this.value = null;
        }
    } else {
        sendToServerDoc(formData, afterDo);
    }
};

modificarContra = function (id) {
    var contraNuevo = $('#contraNuevo').val();
    var contraRepe = $('#contraRepe').val();
    var params = new Object();

    if (contraNuevo.length > 7) {
        if (contraNuevo == contraRepe) {
            if (containsLowercase(contraNuevo)) {
                if (containsUppercase(contraNuevo)) {
                    if (containsNumbers(contraNuevo)) {
                        if (containsSpecialchar(contraNuevo)) {
                            $("#contraMensaje").html("");
                            
                            params.user_id = id;
                            params.pass = contraNuevo;
                            params.controller = 'panelController';
                            params.function = 'modificarContra';
                            var values = JSON.stringify(params);

                            sendToServer(values, afterDo);
                            
                        } else {
                            $("#contraMensaje").html("La contraseña debe contener mínimo un carácter especial (!, ?, /, &, ...)");
                        }
                    } else {
                        $("#contraMensaje").html("La contraseña debe contener mínimo un número");
                    }
                } else {
                    $("#contraMensaje").html("La contraseña  debe contener mínimo una letra mayúscula");
                }
            } else {
                $("#contraMensaje").html("La contraseña debe contener mínimo una letra minúscula");
            }
        } else {
            $("#contraMensaje").html("La contraseña en ambos campos no coincide");
        }
    } else {
            $("#contraMensaje").html("La contraseña debe tener 8 o más caracteres");
    }
};

function containsLowercase(str) {
    return /[a-z]/.test(str);
}
function containsUppercase(str) {
    return /[A-Z]/.test(str);
}
function containsNumbers(str) { //Comprueba si tiene numeros
    return /\d/.test(str);
}
function containsSpecialchar(str) {
    return /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(str);
}

showFilter = function () {

    if ($('.cardFilter').hasClass('displayNone')) {
        $('.cardFilter').css('display', 'block');
        $('.cardFilter').removeClass('displayNone');
    } else {
        $('.cardFilter').css('display', 'none');
        $('.cardFilter').addClass('displayNone');
    }

};

cargarEventoSelectTipo = function () {

    $('#pregunta_tipo').change(function () {

        var id = $(this).val();

        $('#divOpciones').addClass('displayNone');
        $('#divSelect').addClass('displayNone');
        if (id == 2 || id == 3) {
            $('#divOpciones').removeClass('displayNone');



        } else if (id == 1) {
            $('#divSelect').removeClass('displayNone');

        }


    });

    $('#addResponse').sortable();
    $('#allSelects').sortable();
    $('#btnAddNewResponse').unbind('click');
    $('#btnAddNewResponse').on('click', addNewResponse);
};

addNewResponse = function () {

    var divInput = '<div class="row"><div class="col-md-12"><div class="float_left"><input type="text" class="form-control  form-control-inline eventNewResponse" option_id="0"></div>';
    divInput = divInput + '<div class="float_left padding-top5 padding-left10 cursor_pointer"><i class="fa-solid fa-sort"></i></div>';
    divInput = divInput + '</div></div>';
    $('#addResponse').append(divInput);
};

verEncuestaPage = function(id){
    
    $('.loading-div').css('display', 'block');
    var params = new Object();
    params.controller = 'panelController';
    params.function = 'verEncuestaPage';
    params.id = id;

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);
    
};

verPreguntaPage = function(id){
    
    $('.loading-div').css('display', 'block');
    var params = new Object();
    params.controller = 'panelController';
    params.function = 'verPreguntaPage';
    params.id = id;

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);
    
};

cargarInforme = function(){
    
    $('.loading-div').css('display', 'block');
    var params = new Object();
    params.controller = 'panelController';
    params.function = 'cargarInforme';
    params.id = $('#seleccionInforme').val();

    var values = JSON.stringify(params);
    sendToServer(values, function(Data){
        
        $('#cargarTablaInforme').empty();
        $('#cargarTablaInforme').html(Data.result);
        var idtablaInformes = ['informesPreguntas','informesPreguntasLocalidad','informesPreguntasProvincia','informesPreguntasComunidad','informesPreguntasPais'];
        cargarDataTablesInformes(idtablaInformes);
        
    });
};