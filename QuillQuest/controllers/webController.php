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
        
        if ($this->page == 'descubre') {
            
            $model_generos = new generosModel();
            $result_generos = $model_generos->select();
            $this->template->assign("generos", $result_generos);
            
            $modelHistorias = new historiasModel();
            $result_historias = $modelHistorias->select('','','*',' LEFT JOIN wi_users ON (wi_historias.autor_id = wi_users.user_id) LEFT JOIN wi_generos ON (wi_historias.historia_genero_id = wi_generos.genero_id) ORDER BY historia_id ASC');
            
            $this->template->assign("historias", $result_historias);
            
        }
        
        if ($this->page == 'rutas') {
            // Al entrar en la página de rutas, cargamos la base de datos con las rutas            
            $modelRutas = new rutasModel();
            $result_modelRutas = $modelRutas->select(); // Array con las preguntas
            
            $this->template->assign("datosRutas", $result_modelRutas);
        }
        
        if(empty($this->page)){
            
            $modelHistorias = new historiasModel();
            $result_historias = $modelHistorias->select('','','*',' LEFT JOIN wi_users ON (wi_historias.autor_id = wi_users.user_id) LEFT JOIN wi_generos ON (wi_historias.historia_genero_id = wi_generos.genero_id) ORDER BY historia_id DESC LIMIT 6 ');
            
            $historias_carro = $modelHistorias->select('','','*',' LEFT JOIN wi_users ON (wi_historias.autor_id = wi_users.user_id) LEFT JOIN wi_generos ON (wi_historias.historia_genero_id = wi_generos.genero_id) ORDER BY historia_id ASC LIMIT 3 ');
            
            $this->template->assign("historias", $result_historias);
            $this->template->assign("historias_carro", $historias_carro);
            
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
        
        session_start();
        if($_SESSION['name_user']){
            $usuarioModel = new usersModel();
            $resultado = $usuarioModel->select("user_id=".$_SESSION['user_id'])[0]->photo;
            $plantilla_header->assign('testt', "hola");
            $plantilla_header->assign('fotoPerfil', $resultado);
        }
        
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

            case 'leerHistoria':
                $resultado = $this->leerHistoria($params);
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

            case 'registrarUsuario':
                $resultado = $this->registrarUsuario($params);
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
    
    
    private function registrarUsuario($params) {
        
        //echo print_r($params);
        $name = $params->name;
        $lastname = $params->lastname;
        $email = $params->email;
        $password = $params->password;
        $password_segura = $this->securePass($password);
        
        $usersModel = new usersModel();
        $result = $usersModel->select('email="'.$email.'"','','email');
                
        $usersModel->setActive(1);
        $usersModel->setEmail($email);
        $usersModel->setLastname($lastname);
        $usersModel->setPassword($password_segura);
        $usersModel->setName($name);
        $usersModel->setRole(2);
        $usersModel->setCreated_by("pruebas");
        $usersModel->setAttempts(1);
        $usersModel->setBlocked(0);
        
        if (count($result) > 0) {
            $this->msg = 'No se ha podido crear el usuario. El correo electrónico ya existe.';
            $this->type_msg = 'USER_ERROR';
        } else{
            $this->msg = 'Usuario creado correctamente';
            $this->type_msg = 'USER_INFO';
            $usersModel->add();
        }
        
        //$send = $this->template->fetch('web/index.html');
        $send='';
        
        return $this->getJSONEncode($send);
    }
    
    private function securePass($password) {
        $password_encrypt = $password;
        $costt = array('cost' => PASSWORD_BCRYPT_DEFAULT_COST);
        $password_encrypt_aux = password_hash($password_encrypt, PASSWORD_BCRYPT, $costt);

        return $password_encrypt_aux;
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
    
    private function recoverPassword($params){}
    
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
    
    private function leerHistoria($params) {
        
        echo print_r($params);
        $model_generos = new generosModel();
        $result_generos = $model_generos->select();
        $this->template->assign("generos", $result_generos);
        
        $send = $this->template->fetch('web/leerHistoria.html');
        return $this->getJSONEncode($send);
        
    }
    
}
