<?php

/** * ********************************************************************
 * 	Autoincluding libraries when invoke them
 * 
 * @author Wilowi - Sandra Campos
 * @copyright Wilowi
 * @since 29/05/2020
 *  
 * ******************************************************************** */
require __DIR__ . '/vendor/autoload.php';
//require_once("vendor/geoip2/geoip2.phar");

include_once dirname(__FILE__) . "/lib/phpqrcode/qrlib.php";

/**
 * Libraries and classes
 *
 * @param string $class_name
 */
function autoload($class_name) {
    // ----- Clase conexión BD
    if ($class_name == 'dbConnector') {
        include_once dirname(__FILE__) . '/config/dbConnector.php';
    } elseif ($class_name == 'newSmarty') {
        include_once dirname(__FILE__) . '/config/newSmarty.php';
    } elseif ($class_name == 'wiMailer') {
        include_once dirname(__FILE__) . '/config/wiMailer.php';
    } elseif ($class_name == 'FPDF') {
	include_once dirname(__FILE__) . '/lib/fpdf/fpdf.php';
    } elseif ($class_name == 'PDF') {
	include_once dirname(__FILE__) . '/lib/fpdf/pdf.php';
    }elseif ($class_name == 'logsModel') {
        include_once dirname(__FILE__) . '/models/logsModel.php';
    } elseif ($class_name == 'controller') {
        include_once dirname(__FILE__) . '/controllers/controller.php';
    } elseif ($class_name == 'frontController') {
        include_once dirname(__FILE__) . '/controllers/frontController.php';
    } elseif ($class_name == 'panelController') {
        include_once dirname(__FILE__) . '/controllers/panelController.php';
    } elseif ($class_name == 'webController') {
        include_once dirname(__FILE__) . '/controllers/webController.php';
    } elseif ($class_name == 'rutasController') {
        include_once dirname(__FILE__) . '/controllers/rutasController.php';
    } elseif ($class_name == 'baseModel') {
        include_once dirname(__FILE__) . '/models/baseModel.php';
    } elseif ($class_name == 'usersModel') {
        include_once dirname(__FILE__) . '/models/usersModel.php';
    } elseif ($class_name == 'countriesModel') {
        include_once dirname(__FILE__) . '/models/countriesModel.php';
    } elseif ($class_name == 'comunidadesModel') {
        include_once dirname(__FILE__) . '/models/comunidadesModel.php';
    } elseif ($class_name == 'statesModel') {
        include_once dirname(__FILE__) . '/models/statesModel.php';
    } elseif ($class_name == 'citiesModel') {
        include_once dirname(__FILE__) . '/models/citiesModel.php';
    } elseif ($class_name == 'encuestasModel') {
        include_once dirname(__FILE__) . '/models/encuestasModel.php';
    } elseif ($class_name == 'encuestasRespuestasModel') {
        include_once dirname(__FILE__) . '/models/encuestasRespuestasModel.php';
    } elseif ($class_name == 'preguntasModel') {
        include_once dirname(__FILE__) . '/models/preguntasModel.php';
    } elseif ($class_name == 'preguntasOpcionesModel') {
        include_once dirname(__FILE__) . '/models/preguntasOpcionesModel.php';
    } elseif ($class_name == 'preguntasSelectModel') {
        include_once dirname(__FILE__) . '/models/preguntasSelectModel.php';
    } elseif ($class_name == 'preguntasTipoModel') {
        include_once dirname(__FILE__) . '/models/preguntasTipoModel.php';
    } elseif ($class_name == 'rutasModel') {
        include_once dirname(__FILE__) . '/models/rutasModel.php';
    } elseif ($class_name == 'selectModel') {
        include_once dirname(__FILE__) . '/models/selectModel.php';
    } elseif ($class_name == 'analyticsModel') {
        include_once dirname(__FILE__) . '/models/analyticsModel.php';
    } elseif ($class_name == 'encuestasRespuestasSelectModel') {
        include_once dirname(__FILE__) . '/models/encuestasRespuestasSelectModel.php';
    } elseif ($class_name == 'encuestasRespuestasMultipleModel') {
        include_once dirname(__FILE__) . '/models/encuestasRespuestasMultipleModel.php';
    } elseif ($class_name == 'preguntaRepository') {
        include_once dirname(__FILE__) . '/app/repository/preguntas/preguntaRepository.php';
    } elseif ($class_name == 'encuestaRepository') {
        include_once dirname(__FILE__) . '/app/repository/encuestas/encuestaRepository.php';
    }elseif ($class_name == 'rutasPointsModel') {
        include_once dirname(__FILE__) . '/models/rutasPointsModel.php';
    }elseif ($class_name == 'rutasLatLonModel') {
        include_once dirname(__FILE__) . '/models/rutasLatLonModel.php';
    }elseif ($class_name == 'generosModel') {
        include_once dirname(__FILE__) . '/models/generosModel.php';
    }elseif ($class_name == 'historiasModel') {
        include_once dirname(__FILE__) . '/models/historiasModel.php';
    }elseif ($class_name == 'paginasModel') {
        include_once dirname(__FILE__) . '/models/paginasModel.php';
    }elseif ($class_name == 'eleccionesModel') {
        include_once dirname(__FILE__) . '/models/eleccionesModel.php';
    }
    
}

spl_autoload_register('autoload');
?>
