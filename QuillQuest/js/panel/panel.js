var numPag = 0;
var pagTotal = 2;
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

crearHistoria = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'crearHistoria';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

crearNuevaHistoria = function(){
    
    var form = $('#historiaForm')[0];
    var formData = new FormData(form);
    var tituloHistoria = $('#tituloHistoria').val();
    var sinopsisHistoria = $('#sinopsisHistoria').val();
    
    formData.append('controller', 'panelController');
    formData.append('function', 'crearNuevaHistoria');

    if (tituloHistoria != '' && sinopsisHistoria != '') {
        
        if ($('#portadaHistoria').val() !== undefined && $('#portadaHistoria').val()!='') {
            // - - - - - - - - Comprobar datos subidos - - - - - - - - 
            const allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
            var fileName = $('#portadaHistoria').val();
            var fileExtension = fileName.split('.').pop(); //Sacamos la extension del archivo

            if (allowedExtensions.includes(fileExtension)) {
                sendToServerDoc(formData, afterDo);
            } else {
                swal("Error en la portada", "Por favor, seleccione un tipo de archivo válido (jpg, jpeg, png o gif)", "error");
                this.value = null;
            }
        } else {
            sendToServerDoc(formData, afterDo);
        }
        
    } else {
        swal("Error al crear la historia", "El título y la sinopsis son obligatorios", "error");
    }
    
};

modificarHistoria = function(historia_id){
    
    var form = $('#historiaForm'+historia_id)[0];
    var formData = new FormData(form);
    var tituloHistoria = $('#tituloHistoria'+historia_id).val();
    var sinopsisHistoria = $('#sinopsisHistoria'+historia_id).val();
    var generoHistoria = $('#generoHistoria'+historia_id).val();
    
    formData.append('controller', 'panelController');
    formData.append('function', 'modificarHistoria');
    formData.append('historia_id', historia_id);
    formData.append('tituloHistoria', tituloHistoria);
    formData.append('sinopsisHistoria', sinopsisHistoria);
    formData.append('generoHistoria', generoHistoria);

    if (tituloHistoria != '' && sinopsisHistoria != '') {
        
        if ($('#portadaHistoria'+historia_id).val() !== undefined && $('#portadaHistoria'+historia_id).val()!='') {
            // - - - - - - - - Comprobar datos subidos - - - - - - - - 
            const allowedExtensions = ['jpg', 'png', 'jpeg', 'gif'];
            var fileName = $('#portadaHistoria'+historia_id).val();
            var fileExtension = fileName.split('.').pop(); //Sacamos la extension del archivo

            if (allowedExtensions.includes(fileExtension)) {
                sendToServerDoc(formData, afterDo);
            } else {
                swal("Error en la portada", "Por favor, seleccione un tipo de archivo válido (jpg, jpeg, png o gif)", "error");
                this.value = null;
            }
        } else {
            sendToServerDoc(formData, afterDo);
        }
        
    } else {
        swal("Error al crear la historia", "El título y la sinopsis son obligatorios", "error");
    }
    
};

borrarHistoria = function (historia_id) {

    var params = new Object();
    
    params.historia_id = historia_id;
    params.controller = 'panelController';
    params.function = 'borrarHistoria';
    var values = JSON.stringify(params);
    
    sendToServer(values, afterDo);
    
};

crearPaginas = function (historia_id) {

    numPag = 1;

    var params = new Object();
    
    params.historia_id = historia_id;
    params.controller = 'panelController';
    params.function = 'crearPaginas';
    var values = JSON.stringify(params);
    
    sendToServer(values, afterDo);
    
};

addPage = function () {
    var contenidoPagina =   `<div id="pag_${numPag}">` +
                            '<hr>' +
                            '<div class="row">' +
                            '<div class="col-3">' +
                            `<h4>Página Nº ${numPag}</h4>` +
                            '</div>' +
                            '</div>' +
                            '<div class="row mb-3 text-center">' +
                            '<div class="col-12">' +
                            '<span>Descripción</span><br>' +
                            `<textarea class="page-content" data-page-id="${numPag}" maxlength="500" cols="60" rows="4"></textarea>` +
                            '</div>' +
                            '</div>' +
                            '<div class="row text-center">' +
                            `<div class="col-md-6 mb-5">` +
                            `<button class="btn btn-secondary" id="sel_1_pag_${numPag}" onclick="addSeleccion(${numPag},1);">Añadir opción 1</button>` +
                            '</div>' +
                            `<div class="col-md-6 mb-5">` +
                            `<button class="btn btn-secondary" id="sel_2_pag_${numPag}" onclick="addSeleccion(${numPag},2);" disabled>Añadir opción 2</button>` +
                            '</div>' +
                            '</div>';

    $("#separadorBotones").before(contenidoPagina);
    $("#comenzar").remove();
    numPag++;
    
    return;
};

addSeleccion = function(numPag, opcion) {
    var button = $("#sel_" + opcion + "_pag_" + numPag);
    var inputId = "input_opcion_" + opcion + "_pag_" + numPag;

    if (button.text() === "Añadir opción 1") {
        button.prop("disabled", true);
        button.after('<input type="text" class="opcion-content form-control mt-2" data-page-id="' + numPag + '" data-opcion-id="' + opcion + '" data-target-page-id="' + pagTotal + '" placeholder="Escribe aquí la opción 1">');
        button.after(`<a href="#pag_${pagTotal}" style="color: white !important;"> Pág ${pagTotal} <i class="fa fa-arrow-down"></i></a>`);
        $("#sel_2_pag_" + numPag).prop("disabled", false);
    } else {
        button.prop("disabled", true);
        button.after('<input type="text" class="opcion-content form-control mt-2" data-page-id="' + numPag + '" data-opcion-id="' + opcion + '" data-target-page-id="' + pagTotal + '" placeholder="Escribe aquí la opción 2">');
        button.after(`<a href="#pag_${pagTotal}"> Pág ${pagTotal} <i class="fa fa-arrow-down"></i></a>`);
    }

    pagTotal++;
    this.addPage();
};

savePages = function(historia_id){
    
    numPag = 0;
    pagTotal = 2;
    
    var pages = [];
    var options = [];
    
    var params = new Object();

    // Recoger datos de las páginas
    $(".page-content").each(function(){
        var pageId = $(this).data("page-id");
        var content = $(this).val();
        pages.push({
            pagina_id: pageId,
            contenido: content
        });
    });

    // Recoger datos de las opciones
    $(".opcion-content").each(function(){
        var pageId = $(this).data("page-id");
        var opcionId = $(this).data("opcion-id");
        var targetPageId = $(this).data("target-page-id");
        var content = $(this).val();
        options.push({
            pagina_id: pageId,
            eleccion_id: opcionId,
            pagina_destino_id: targetPageId,
            texto: content
        });
    });

    console.log("Pages: ", pages);
    console.log("Options: ", options);

    params.paginas = pages;
    params.elecciones = options;
    params.historia_id = historia_id;
    params.controller = 'panelController';
    params.function = 'savePages';
    
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

documentos = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'documentos';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};

listado = function () {

    var params = new Object();
    params.controller = 'panelController';
    params.function = 'listado';

    var values = JSON.stringify(params);
    sendToServer(values, afterDo);

};


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