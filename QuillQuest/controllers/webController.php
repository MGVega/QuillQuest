<?php

/**
 * Web Controller
 *
 * @author Wilowi - Sandra Campos
 * @since 06/07/2020
 *
 */

header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Cache-Control: no-store, no-cache, must-revalidate');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
ini_set('display_errors', 0);

final class webController extends controller{    
    
    /**
     * Construct
     */
    public function __construct() {

	parent::__construct();
	$this->logs->setFolder('web/');	
	$this->link = _URL_ENVIRONMENT.'/panel';	
	
    }

    /**
     * Main function
     */
    public function main() {

        parent::main();
        
        $extra = "";
        $page_old = "";
        $rescursos = array();
        $show_menu = true;
        $show_footer = true;
        
        if(in_array($this->page, $rescursos)){
            $extra = "../";
        }

        $this->printHeaderHTML($extra);        

        $this->template->assign("reCaptcha", _KEY_CAPTCHA);
        $this->template->assign("urlEnvironment", _URL_ENVIRONMENT);
        
        if ($this->page == 'encuesta') {
            
            $show_menu = false;
            
             // Al entrar en la página de encuestas, cargamos la base de datos con las preguntas            
            $preguntas = new preguntaRepository();
            $totalPreguntas = $preguntas->getPreguntas(1);
            
            //cargamos países, provincias y localidades.
            $paises = new countriesModel();
            $provincias = new statesModel();
            $ciudades = new citiesModel();
            $comunidades = new comunidadesModel();
            $result_paises = $paises->select('country_id>0 ORDER BY name','','name,native,country_id');
            $result_provincias = $provincias->select('state_id>0 ORDER BY name','','name,state_id,country_id,comunidad_id');
            $result_ciudades = $ciudades->select('city_id>0 ORDER BY name','','name,state_id,country_id,city_id');
            $result_comunidades = $comunidades->select('comunidad_id>0 ORDER BY name','','name,country_id,comunidad_id');
            
            $this->template->assign("datosPreguntas", $totalPreguntas);
            $this->template->assign("paises", $result_paises);
            $this->template->assign("provincias", $result_provincias);
            $this->template->assign("ciudades", $result_ciudades);
            $this->template->assign("comunidades", $result_comunidades);
            
        }
        
        if ($this->page == 'rutas') {
            // Al entrar en la página de rutas, cargamos la base de datos con las rutas            
            $modelRutas = new rutasModel();
            $result_modelRutas = $modelRutas->select(); // Array con las preguntas
            
            $this->template->assign("datosRutas", $result_modelRutas);
        }
        
        if(empty($this->page)){          
            
            $content = $this->template->fetch("web/index.html");
        }
        else{
            $content = $this->template->fetch("web/$this->page.html");
        }
        
        if(!empty($page_old)){
            $this->page = $page_old;
        }
	
	// header
	$this->chargeHeader($show_menu);
	
	// content
	echo $content;
	
	// footer
        $this->chargeFooter($extra, $show_footer);

        $this->printHeaderPos();
        
        
        
	
        if ($this->page == '') {
            $model = new analyticsModel();
            $resultModel = $model->select();
            $visitas_principal = $resultModel[0]->visitas_principal;
            $visitas_principal++;
            $model->setVisitas_principal($visitas_principal);

            $model->update("dato_id=1,");
        } else
            if ($this->page == 'encuesta') {
            $model = new analyticsModel();
            $resultModel = $model->select();
            $visitas_encuesta = $resultModel[0]->visitas_encuesta;
            $visitas_encuesta++;
            $model->setVisitas_encuesta($visitas_encuesta);

            $model->update("dato_id=1,");
        } else if ($this->page == 'rutas') {
            $model = new analyticsModel();
            $resultModel = $model->select();
            $visitas_rutas = $resultModel[0]->visitas_rutas;
            $visitas_rutas++;
            $model->setVisitas_rutas($visitas_rutas);

            $model->update("dato_id=1,");
        }
    }
    /**
     * Print the head for the web. Included all libraries and styles.
     */
    protected function printHeaderHTML($extra = '') {

	parent::printHeaderHTML($extra);
                
        if (_ENVIRONMENT == 'production') {
            
            $this->template_header->assign('robots', 'NoIndex,NoFollow');
        }else{
            $this->template_header->assign('robots', 'NoIndex,NoFollow');
        }
	
	$this->template_header->assign('urlCssCntrl',$extra._CSSWEB._FILECSSWEB);        
	
	$header = $this->template_header->fetch("common/header_html_web.html");
	
	echo $header;
    }
    
    /**
     * Print the js libraries
     * @param type $extra
     */
    protected function printFooterJs($extra='') {

        parent::printFooterJs($extra);
        
        $this->template_footer->assign('urlJsCntrl', $extra . _JSWEB . _JSW);
        $footerJs = $this->template_footer->fetch('common/footer_js_web.html');
	
	echo $footerJs;
    }
    
    /**
     * Print the end of the web page.
     */
    private function printHeaderPos() {
	
	//$modals = file_get_contents(_VIEWS . "/common/modals.html");
	//echo $modals;
	
	echo '</body>';

	echo '</html>';
    }
    
    private function chargeHeader($show_menu) {

        $plantilla_header = new newSmarty();
        $plantilla_header->assign('url', _URL_ENVIRONMENT);
        $plantilla_header->assign('page', $this->page);
        $plantilla_header->assign('show_menu', $show_menu);
        $descripcion = "";
        $nombre = "";
        $imagen = "";

        $plantilla_header->assign('nombre_pagina', $nombre);
        $plantilla_header->assign('descripcion_pagina', $descripcion);
        $plantilla_header->assign('imagen_pagina', $imagen);
        $header = $plantilla_header->fetch('common/header_web.html');

        echo $header;
    }

    private function chargeFooter($extra, $show){

        if ($show) {
            $plantilla_footer = new newSmarty();
            $plantilla_footer->assign('urlExtra', $extra);
            $plantilla_footer->assign('year', $this->today->format('Y'));
            $footer = $plantilla_footer->fetch("common/footer_web.html");

            echo $footer;
        }
        $this->printFooterJs('');
    }
    
    /**
     * Main function to control the ajax requests.
     * @param Object $params params from ajax
     * @params Object $files -> files like photos
     * @return json
     */
    public function doFunction($params, $files = '') {

	$resultado = '';

	switch ($params->function) {

            case 'login':
                $resultado = $this->login($params);
                break;

            case 'recoveryPassword':
                $resultado = $this->recoverPassword($params);
                break;

            case 'googleCaptcha':
                $resultado = $this->googleCaptcha($params);
                break;

            case 'guardarEncuesta':
                $resultado = $this->guardarEncuesta($params);
                break;
            
            case 'obtenerProvincias':
                $resultado = $this->obtenerProvincias($params);
                break;
            
            case 'obtenerProvinciasComunidades':
                $resultado = $this->obtenerProvinciasComunidades($params);
                break;
            
            case 'obtenerComunidades':
                $resultado = $this->obtenerComunidades($params);
                break;
            
            case 'obtenerCiudades':
                $resultado = $this->obtenerCiudades($params);
                break;

            default:
                break;
        }

        return $resultado;
    }


    private function login($params) { 

	$send = '';
	$email = filter_var($params->user, FILTER_SANITIZE_EMAIL);
	$password = $params->password;
	$today = new DateTime('now');

	// --- Get the user from the email.
	$user = new usersModel();
	$where = "email='$email'";
	$result_login = $user->select($where);

	// --- If email exists
	if (!empty($result_login)) {

	    // --- If is a correct password or master password and if the user is active and not blocked.
	    if ( password_verify($password, $result_login[0]->password) && $result_login[0]->active == 1) {

		$this->control_request = true;		
		session_start();
		$_SESSION['name_user'] = $result_login[0]->name;
		$_SESSION['user_id'] = $result_login[0]->user_id;
		$_SESSION['role_user'] = $result_login[0]->role;
		$_SESSION['time'] = time();

		//echo print_r($_SESSION);
		$send = 'loginTrue';
		$user->setDate_last_login($today->format('Y-m-d H:i:s'));
		$user->setUser_id($result_login[0]->user_id);
		$user->updateLastLogin();
		
	    } else {

		if ($result_login[0]->active == 0) {
		    $send = "El usuario no está activo.";
		    
		} else {
		    $send = "Contraseña incorrecta.";
		}

	    }
	    
	} else {	    
	    $send = "El usuario no existe.";
	}

	return $this->getJSONEncode($send);
    }
    
    private function recoverPassword($params){
	
	
	
	
    }
    
    private function enviarCorreoContacto(){
        
        $addresses = array();
        array_push($addresses,"sandra@wilowi.com");
        $subject = "Wilowi";
        
        $body = "Hola";
        
        $respuesta = sendMail($addresses, utf8_decode($subject), utf8_decode($body));
        
        return $respuesta;
    }
    
    private function googleCaptcha($params) {

        $data = new stdClass();

        $data->secret = file_get_contents('../../dataDB/captcha_secret');
        $data->response = $params->response;

        $URL = "https://www.google.com/recaptcha/api/siteverify";
        $dataSend = array(
            'secret' => $data->secret,
            'response' => $data->response
        );

        $conexion = curl_init();

        //GET
        curl_setopt($conexion, CURLOPT_URL, $URL);
        curl_setopt($conexion, CURLOPT_POST, TRUE);
        if(_ENVIRONMENT!='localhost'){
            curl_setopt($conexion, CURLOPT_SSL_VERIFYPEER, TRUE);
        }else{
            curl_setopt($conexion, CURLOPT_SSL_VERIFYPEER, FALSE);
        }
        
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($conexion, CURLOPT_POSTFIELDS, http_build_query($dataSend));

        $respuesta = curl_exec($conexion);
        //echo "<pre>";echo print_r($respuesta);echo "</pre>";

        curl_close($conexion);

        return $respuesta;
    }
    
    private function guardarEncuesta($params) {

        $encuestas = new encuestasModel();
        $encuestas->setFecha_encuesta($this->today->format('Y-m-d H:i:s'));
        $result_id = $encuestas->add();

        if ($result_id) {
            $model = new encuestasRespuestasModel();
            $model->setEncuesta_id($result_id);

            foreach ($params->preguntas as $pregunta) {
                
                // resetear los valores al principio porque sino en nada que coja uno el resto igual
                $model->setOpciones_select(0);
                $model->setOpciones_multiple(0);
                $model->setSi_no(0);
                $model->setNumero_libre(0);
                $model->setOpciones(0);
                $model->setTexto_libre(null);
                $model->setOtros(null);

                if (!empty($pregunta)) {
                    $model->setPregunta_id($pregunta->pregunta_id);
                }
                switch (intval($pregunta->tipo_pregunta)) {
                    case 1: //Seleccion
                        
                        $model->setOpciones_select(1);

                        $modelSelect = new encuestasRespuestasSelectModel();
                        $modelSelect->setEncuesta_id($result_id);
                        $modelSelect->setPregunta_id($pregunta->pregunta_id);
                        
                        foreach ($pregunta->select as $opciones) {

                            $modelSelect->setSelect_id($opciones->select_id);
                            $modelSelect->setValue_select($opciones->value);
                            $modelSelect->add();
                        }

                        break;
                        
                    case 2: //Opciones simple
                        $model->setOpciones($pregunta->value);
                        break;
                    case 3: //Opciones multiples

                        $model->setOpciones_multiple(1);
                        
                        $modelOption = new encuestasRespuestasMultipleModel();
                        $modelOption->setEncuesta_id($result_id);
                        $modelOption->setPregunta_id($pregunta->pregunta_id);
                        
                        foreach ($pregunta->options as $opciones) {

                            $modelOption->setOpcion_id($opciones);
                            $modelOption->add();
                        }
                        
                        break;
                    case 4: //Si/No
                        $model->setSi_no($pregunta->value);
                        break;
                    case 5: //Texto libre
                        $model->setTexto_libre($pregunta->value);
                        break;
                    case 6: //Numero libre
                        $model->setNumero_libre($pregunta->value);
                        break;
                }
                if (!empty($pregunta->respuesta_otros)) {
                    $model->setOtros($pregunta->respuesta_otros);
                }

                $model->add();

            }
        } else {
            $mensaje = "Ha habido un error y no se han podido guardar los datos correctamente. Disculpe las molestias.";
            return $this->getJSONEncode($mensaje);
        }
        $mensaje = "¡Muchas gracias!";
        return $this->getJSONEncode($mensaje);
    }
    
    private function obtenerProvinciasComunidades($params){
        
        $id = intval($params->country_id);
        
        $where = "country_id=$id ORDER BY name";
        
        $provincias = new statesModel();
        $result_provincias = $provincias->select($where,'','name,state_id,country_id,comunidad_id');
        $comunidades = new comunidadesModel();
        $result_comunidades = $comunidades->select($where,'','name,comunidad_id,country_id');
        
        $objetoTotal = new stdClass();
        $objetoTotal->provincias = $result_provincias;
        $objetoTotal->comunidades = $result_comunidades;
        
        return $this->getJSONEncode(json_encode($objetoTotal));
    }
    
    private function obtenerProvincias($params){
        
        $id = intval($params->comunidad_id);
        
        $where = "comunidad_id=$id ORDER BY name";
        
        $provincias = new statesModel();
        $result_provincias = $provincias->select($where,'','name,state_id,country_id,comunidad_id');
        
        $objetoTotal = new stdClass();
        $objetoTotal->provincias = $result_provincias;
        
        return $this->getJSONEncode(json_encode($objetoTotal));
    }
    
    


    
    private function obtenerCiudades($params){
        
        $id = intval($params->state_id);
        
        $where = "state_id=$id ORDER BY name";

        $ciudades = new citiesModel();
        $result_ciudades = $ciudades->select($where,'','name,city_id,country_id,state_id,comunidad_id');
        
        $objetoTotal = new stdClass();
        $objetoTotal->ciudades = $result_ciudades;
        
        return $this->getJSONEncode(json_encode($objetoTotal));
        
    }
    
    
}// guardarEncuesta