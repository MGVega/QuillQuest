/* 
 * Developed by wilowi
 */


closeModal = function(name){
    
    $('#'+name).modal('hide');
};

modalAdd = function () {

    $('#modal_add').modal('show');

};

modalAddMore = function (id) {

    $('#modal_add_' + id).modal('show');

};

modalModif = function () {

    $('#modal_modif').modal('show');
};

modalModifMore = function (id) {

    $('#modal_modif_' + id).modal('show');
};

modalView = function () {

    $('#modal_view').modal('show');
};

modalViewMore = function (id) {

    $('#modal_view_' + id).modal('show');
};


modalDelete = function () {

    $('#modal_delete').modal('show');

};

modalDeleteMore = function (id) {

    $('#modal_delete_' + id).modal('show');
};

modalPassword = function (id) {

    $('#modal_modif_password' + id).modal('show');

};

// --- ngenter
ngEnter = function () {
	return function (scope, element, attrs) {
		element.bind("keydown keypress", function (event) {
			if (event.which === 13) {
				scope.$apply(function () {
					scope.$eval(attrs.ngEnter);
				});

				event.preventDefault();
			}
		});
	};
};

ngFilter = function(e,btn){	
	
	if (e.keyCode === 13 && !e.shiftKey) {
		//alert("entro");
        e.preventDefault();
        var boton = document.getElementById(btn);
        angular.element(boton).triggerHandler('click');
    }
	
};


validateEmail = function (sEmail) {
	var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if (filter.test(sEmail)) {
		return true;
	} else {
		return false;
	}
};

afterDo = function (Data) {

    disableModals();

    if (Data.extra == 'SESSION_FALSE') {

        window.location.href = Data.result;

    } else {

        scrollSmooth();


        $('#container-principal').empty();
        $('#container-principal').html(Data.result);

        cargarEventoSelectTipo();
        
        var ids_datatables = ['listadoPreguntas'];
        cargarDataTables(ids_datatables);
        var id_tablaRutas = ['tablaRutas'];
        cargarDataTables(id_tablaRutas);
        showModalsInfo(Data);
        
        controlesPeticiones(Data);


    }

};


scrollSmooth = function () {

    //$window.location.hash = '#wrapper';
    window.scroll({
        top: 0,
        left: 0,
        behavior: 'smooth'
    });
    history.pushState("", document.title, window.location.pathname
            + window.location.search);
};

disableModals = function () {
    
    $('#modal_loading').on('shown.bs.modal', function (e) {
        $("#modal_loading").modal('hide');
    });

    $('#modal_delete').on('shown.bs.modal', function (e) {
        $("#modal_delete").modal('hide');
    });

    $('#modal_loading').modal('hide');
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('overflow', '');
    $('body').css('padding-right', '');

    $('#loading').css('display', 'none');
    $('.loading-div').css('display', 'none');

};

showModalsInfo = function (Data) {

    if (Data.msg != '') {

        if (Data.type_msg == 'INFO') {

            $('#setTextModalInfo').empty();
            $('#setTextModalInfo').append(Data.msg);

            $('#modal_info').modal('show');

        } else if (Data.type_msg == 'WARNING') {

            $('#setTextModalWarning').empty();
            $('#setTextModalWarning').append(Data.msg);
            $('#modal_warning').modal('show');

        } else if (Data.type_msg == 'ERROR') {

            $('#setTextModalError').empty();
            $('#setTextModalError').append(Data.msg);
            $('#modal_error').modal('show');

        }

    }

};


cargarDataTables = function(ids){

    var options = {
        "dom": 'lftip',
        "stateSave": true,
        "order": [],
        "language": {
            "lengthMenu": "Mostrando _MENU_ elementos por página",
            "zeroRecords": "No se ha encontrado ningún elemento",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "search": "Buscar",
            "infoEmpty": "No records available"
        }
    };

    $.each(ids,function(){
        $('#'+ids).DataTable(options);
        
    });
    
    
};

cargarDataTablesInformes = function(ids){

    var options = {
        "dom": 'Bfrtip',
        "stateSave": true,
        "searching": false,
        "language": {
            "lengthMenu": "Mostrando _MENU_ elementos por página",
            "zeroRecords": "No se ha encontrado ningún elemento",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "search": "Buscar",
            "infoEmpty": "No records available"
        },
        "buttons": [
            {
                "extend": "excelHtml5",
                "autoFilter": true,
                "text": "<i class='fas fa-file-excel'></i> Excel",
            }
        ]
    };
    
    for (let i = 0; i < ids.length; ++i) {
        // do something with `substr[i]`
        $('#'+ids[i]).DataTable(options);
    }
    
    
};
