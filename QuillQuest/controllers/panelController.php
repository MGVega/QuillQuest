<?php

/**
 * Admin Panel Controller
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

/**
 * Class for control the panel
 */
final class panelController extends controller{
      
    /**
     * User id from session
     * @var integer
     */
    private $user_id = 0;
    
    /**
     * User rol from session
     * @var integer
     */
    private $role_user = 0;
    
    /**
     * Name user from session
     * @var integer
     */
    private $name_user = 0;
    
    /**
     * Construct
     */
    public function __construct() {
        
        parent::__construct();
	$this->logs->setFolder('panel/');
	
	$this->link = _URL_ENVIRONMENT;

	session_start();
        $time = intval($_SESSION['time']);
        $this->user_id = intval($_SESSION['user_id']);
        $this->role_user = intval($_SESSION['role_user']);
        $this->name_user = filter_var($_SESSION['name_user']);

        if ((time() - $time) > 3600 || empty($this->user_id) || empty($_SESSION)) {

            $_SESSION = array();
            session_destroy();
            $this->exitSession = true;
        } else {
            $_SESSION['time'] = time();
        }
    }
    
   
    /**
     * Main function
     */
    public function main() {
        
        parent::main();
        
        if ($this->exitSession) {

	    $this->extra = 'SESSION_FALSE';
	    header('Location: ' . $this->link);
	    echo $this->redirectTemplate();
	    
	    die();
	}

	if(!empty($this->user_id)){
	    
	    $this->printHeaderHTML();

            $footer = $this->chargeFooter();
            $this->template->assign('footer',$footer);
            
            $this->cargarDatosDashboard();
            
	    $content = $this->template->fetch("panel/dashboard.html");
	    
	    echo $content;
	    
            $this->printFooterJs('');
	    $this->printHeaderPos();
	    
	}else {

	    header('Location: ' . $this->link);	    
	    echo $this->redirectTemplate();
	    
	    die();
	}	
        
    }

    private function cargarDatosDashboard(){
        
        //Foto de perfil
        $usuariosModel = new usersModel();
        $usuarioDatos = $usuariosModel->select("user_id=".intval($_SESSION['user_id']))[0];
        $this->template->assign('fotoPerfil', $usuarioDatos->photo);
        
        // Encuestas totales
        $encuestas = new encuestaRepository();
        $result_encuestas = $encuestas->getEncuestasTotales();
        $this->template->assign('encuestasTotales',$result_encuestas[0]->encuestasTotales);
        
        // Encuestas en el día
        $result_dia = $encuestas->getEncuestasDia();
        $this->template->assign('encuestasTotalesDia',$result_dia[0]->totalesDia);
        
        // Visitas
        $visitas = new analyticsModel();
        $result_visitas = $visitas->select();
        $visitas_principal = $result_visitas[0]->visitas_principal;
        $this->template->assign('visitasPrincipal', $visitas_principal);
        
        $visitas_rutas = $result_visitas[0]->visitas_rutas;
        $this->template->assign('visitasRutas', $visitas_rutas);
        
        $visitas_encuesta = $result_visitas[0]->visitas_encuesta;
        $this->template->assign('visitasEncuesta', $visitas_encuesta);        
        
        // Rutas
        $rutas = new rutasModel();
        $result_rutas = $rutas->select('','','count(ruta_id) as rutasTotales');
        $this->template->assign('rutasTotales',$result_rutas[0]->rutasTotales);

        
    }
    
    /**
     * Print the head for the web. Included all libraries and styles.
     */
    protected function printHeaderHTML($extra = "") {

        parent::printHeaderHTML($extra);

	$this->template_header->assign('robots','NoIndex,NoFollow');
	$this->template_header->assign('urlCssCntrl',_CSSPANEL._FILECSSPANEL);
        $this->template_header->assign('urlCssStyle',_CSSPANEL._FILECSSSTYLE);
        $this->template_header->assign('urlCssSimpleBar',_CSSPANEL._FILECSSSIMPLEBAR);
        $this->template_header->assign('urlCssSimpleBarVendor',_CSSPANEL._FILECSSSIMPLEBARVENDOR);		
	$header = $this->template_header->fetch("common/header_html_panel.html");	
	echo $header;

    }
    
    /**
     * Print the end of the web page.
     */
    private function printHeaderPos() {
	
	$modals = file_get_contents(_VIEWS . "/common/modals.html");
	echo $modals;
	
	echo '</body>';
	echo '</html>';
    }
    
    /**
     * Main function to control the ajax requests.
     * @param Object $params params from ajax
     * @params Object $files -> files like photos
     * @return json
     */
    public function doFunction($params, $files = '') {

	$resultado = '';

	if ($this->exitSession) {

	    $this->extra = "SESSION_FALSE";
	    return $this->getJSONEncode($this->link);
	}

	switch ($params->function) {

	    case 'logout':
		$resultado = $this->logOut();
		break;
            
            case 'crearHistoria':
		$resultado = $this->crearHistoria();
		break;
            
            case 'crearNuevaHistoria':
		$resultado = $this->crearNuevaHistoria($params, $files);
		break;
            
            case 'borrarHistoria':
		$resultado = $this->borrarHistoria($params);
		break;
            
            case 'crearPaginas':
		$resultado = $this->crearPaginas($params);
		break;
            
            case 'savePages':
		$resultado = $this->savePages($params);
		break;
            
            case 'modificarHistoria':
		$resultado = $this->modificarHistoria($params, $files);
		break;
            
            case 'graficos':
		$resultado = $this->graficos();
		break;
            
            case 'documentos':
		$resultado = $this->documentos();
		break;
            
            case 'listado':
		$resultado = $this->listado();
		break;
            
            case 'perfil':
		$resultado = $this->perfil();
		break;
            
            case 'obtenerBalance':
                $resultado = $this->obtenerBalance();
                break;
            
            case 'modificarUsuario':
                $resultado = $this->modificarUsuario($params, $files);
                break;
            
            case 'modificarContra':
                $resultado = $this->modificarContra($params);
                break;
            
	    default:
		break;
	}

	return $resultado;
    }

    /**
     * Print the html for the footer
     * @return string
     */
    private function chargeFooter(){

        $plantilla_footer = new newSmarty();
	$plantilla_footer->assign('year', $this->today->format('Y'));
	$footer = $plantilla_footer->fetch('common/footer_panel.html');
	
	return $footer;
	
    }
    
    /**
     * Print the js libraries
     * @param type $extra
     */
    protected function printFooterJs($extra='') {

        parent::printFooterJs($extra);
        
        $this->template_footer->assign('urlJsCntrl', $extra . _JSPANEL . _JSP);
        $this->template_footer->assign('urlJsCntrlMain', $extra . _EXTRA . "coreui/js/main.js");
        $this->template_footer->assign('urlJsCntrlChart', $extra . _EXTRA . "Chart/Chart.min.js");
        $this->template_footer->assign('urlJsCntrlUtils', $extra . _EXTRA . "coreui/vendors/@coreui/utils/js/coreui-utils.js");
        $this->template_footer->assign('urlJsCntrlSimple', $extra . _EXTRA . "coreui/vendors/simplebar/js/simplebar.min.js");
        $this->template_footer->assign('urlJsCntrlCore', $extra . _EXTRA . "coreui/vendors/@coreui/coreui/js/coreui.bundle.min.js");
        
        $footerJs = $this->template_footer->fetch('common/footer_js_panel.html');	
	echo $footerJs;
    }

    /**
     * Logout the session
     * @return type
     */
    private function logOut(){	
	
	$_SESSION = array();
	session_destroy();
	
	$this->extra = "SESSION_FALSE";
	return $this->getJSONEncode($this->link);
    }
    
    private function crearHistoria(){
        
        $model_generos = new generosModel();
        $result_generos = $model_generos->select();
        $this->template->assign("generos", $result_generos);
        
        $send = $this->template->fetch('panel/historias/crearHistoria.html');
        
        return $this->getJSONEncode($send);
    }
    
    private function crearNuevaHistoria($params, $files){
        
        /*echo print_r($params);
        echo print_r($files);*/
        $user_id = $_SESSION['user_id'];
        $tituloHistoria = $params->tituloHistoria;
        $generoHistoria = $params->generoHistoria;
        $sipnopsisHistoria = $params->sipnopsisHistoria;
        
        $historias_model = new historiasModel();
        $historias_model->setAutor_id($user_id);
        $historias_model->setTitulo($tituloHistoria);
        $historias_model->setHistoria_genero_id($generoHistoria);
        $historias_model->setSinopsis($sipnopsisHistoria);
        $result_model = $historias_model->add();
        
        if($result_model && $files['portadaHistoria']['error'] == 0){
            $imagenUrl = $this->guardarPortada($result_model, $files);
            $historias_model->setPortada($imagenUrl);
            $historias_model->setHistoria_id($result_model);
            $historias_model->update();
        }
        
        $model_historias = new historiasModel();
        $result_historias = $model_historias->select();
        $model_generos = new generosModel();
        $result_generos = $model_generos->select();
        
        $this->template->assign("historias",$result_historias);        
        $this->template->assign("generos",$result_generos);
        $send = $this->template->fetch('panel/historias/listado.html');
        
        return $this->getJSONEncode($send);
        
    }
    
    /**
     * Listado de historias
     * @return type
     */
    private function listado(){
        
        $model_historias = new historiasModel();
        $result_historias = $model_historias->select();
        $model_generos = new generosModel();
        $result_generos = $model_generos->select();
        
        $this->template->assign("historias",$result_historias);        
        $this->template->assign("generos",$result_generos);
        $send = $this->template->fetch('panel/historias/listado.html');
        
        return $this->getJSONEncode($send);
    }
    
    private function modificarHistoria($params, $files){
        
        /*echo print_r($params);
        echo print_r($files);*/
        $historia_id = $params->historia_id;
        $tituloHistoria = $params->tituloHistoria;
        $generoHistoria = $params->generoHistoria;
        $sipnopsisHistoria = $params->sinopsisHistoria;
        
        $historias_model = new historiasModel();
        $historias_model->setHistoria_id($historia_id);
        $historias_model->setTitulo($tituloHistoria);
        $historias_model->setHistoria_genero_id($generoHistoria);
        $historias_model->setSinopsis($sipnopsisHistoria);
        
        if($files['portadaHistoria'.$historia_id]['error'] == 0){
            $imagenUrl = $this->updatePortada($historia_id, $files);
            $historias_model->setPortada($imagenUrl);
        }
        
        $historias_model->update();
        
        $this->msg = 'Historia modificada correctamente.';
        $this->type_msg = 'INFO';
        
        
        $model_historias = new historiasModel();
        $result_historias = $model_historias->select();
        $model_generos = new generosModel();
        $result_generos = $model_generos->select();
        
        $this->template->assign("historias",$result_historias);        
        $this->template->assign("generos",$result_generos);
        $send = $this->template->fetch('panel/historias/listado.html');
        
        return $this->getJSONEncode($send);
        
    }
    
    private function borrarHistoria($params){
        
        $historia_id = intval($params->historia_id);
        
        $model = new historiasModel();
        $model->setHistoria_id($historia_id);
            //Obtenemos el link de la imagen de la bbdd
        $select_imagen = $model->select("historia_id=$historia_id","portada","portada");
        $ruta_imagen = "../".$select_imagen[0]->portada;
        
        $result_delete = $model->delete("historia_id=$historia_id");
        unlink($ruta_imagen); //Borrar imagen
        
        // Mensaje final 
        if ($result_delete) {
            $this->msg = 'Historia eliminada correctamente.';
            $this->type_msg = 'INFO';
        } else {
            $this->msg = 'Error al eliminar historia.';
            $this->type_msg = 'ERROR';
        }
        
        return $this->listado();
        
    }
    
    private function crearPaginas($params){
        
        $historia_id = $params->historia_id;
        
        $model_historias = new historiasModel();
        $model_generos = new generosModel();
        
        $result_historia = $model_historias->select("historia_id=$historia_id")[0];
        $where_generos= "genero_id=".$result_historia->historia_genero_id;
        $genero = $model_generos->select($where_generos, '', "nombre_genero")[0]->nombre_genero;
        $this->template->assign("historia",$result_historia);  
        $this->template->assign("genero", $genero);
        
        $send = $this->template->fetch('panel/paginas/crearPaginas.html');
        
        return $this->getJSONEncode($send);
        
    }
    
    private function savePages($params){
        
        $historia_id = $params->historia_id;
        $paginas = $params->paginas;
        $elecciones = $params->elecciones;
        $pagina_eleccion = 0;
        
        $modelHistorias = new historiasModel();
        $modelPaginas = new paginasModel();
        $modelElecciones = new eleccionesModel();
        
        $first = true;
        //Guardamos las páginas
        foreach($paginas as $pagina){
            $modelPaginas->setHistoria_id($historia_id);
            $modelPaginas->setContenido($pagina->contenido);
            if($first){
                $modelPaginas->add();
                $pagina_eleccion = $modelPaginas->select('historia_id ='.$historia_id,'','pagina_id')[0]->pagina_id;
            } else {
                $modelPaginas->add();
            }
        }
        
        //Guardamos las elecciones
        foreach($elecciones as $eleccion){
            
            $pagina_eleccion_aux = $eleccion->pagina_id - 1;
            $pagina_eleccion_aux += $pagina_eleccion;
            
            $pagina_destino_aux = $eleccion->pagina_destino_id - 1;
            $pagina_destino_aux += $pagina_eleccion;
            
            $modelElecciones->setHistoria_id($historia_id);
            $modelElecciones->setTexto($eleccion->texto);
            $modelElecciones->setPagina_id($pagina_eleccion_aux);
            $modelElecciones->setPagina_destino_id($pagina_destino_aux);
            $modelElecciones->add();
        }
        
        $modelHistorias->setHistoria_id($historia_id);
        $modelHistorias->setVisible(1);
        $result_update = $modelHistorias->updateVisible();
        
        // Mensaje final 
        if ($result_update) {
            $this->msg = 'Páginas creadas correctamente.';
            $this->type_msg = 'INFO';
        } else {
            $this->msg = 'Error al crear las páginas.';
            $this->type_msg = 'ERROR';
        }
        
        return $this->listado();
        
    }
    
    private function guardarPortada($id, $files){
        $imagenNombre = $files['portadaHistoria']['name'];
        
            // Getting file extension 
            $imagen_new_name = explode(".", $imagenNombre);
            $imagen_extension = end($imagen_new_name);
            
            if ($imagenNombre != ""){
                //Borramos la imagen existente, por si introducimos otra que tenga una extension diferente se borre la antigua
                $direccion_antigua = "../images/portadas/portada_$id";
                unlink(glob($direccion_antigua . '*.{jpg,jpeg,png,gif}', GLOB_BRACE)[0]);
            }
            // Location 
            $imagenLocation = "images/portadas/portada_$id.$imagen_extension";
            $imageFileType = pathinfo($imagenLocation, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            
            // Upload file 
            if (move_uploaded_file($files['portadaHistoria']['tmp_name'], "../" . $imagenLocation)) {
                $imagenResponse = $imagenLocation;
            }
            return $imagenResponse;
    }
    
    private function updatePortada($id, $files){
        $imagenNombre = $files['portadaHistoria'.$id]['name'];
        
            // Getting file extension 
            $imagen_new_name = explode(".", $imagenNombre);
            $imagen_extension = end($imagen_new_name);
            
            if ($imagenNombre != ""){
                //Borramos la imagen existente, por si introducimos otra que tenga una extension diferente se borre la antigua
                $direccion_antigua = "../images/portadas/portada_$id";
                unlink(glob($direccion_antigua . '*.{jpg,jpeg,png,gif}', GLOB_BRACE)[0]);
            }
            // Location 
            $imagenLocation = "images/portadas/portada_$id.$imagen_extension";
            $imageFileType = pathinfo($imagenLocation, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            
            // Upload file 
            if (move_uploaded_file($files['portadaHistoria'.$id]['tmp_name'], "../" . $imagenLocation)) {
                $imagenResponse = $imagenLocation;
            }
            return $imagenResponse;
    }
    
    private function graficos(){
        
        $this->control_request = 'graficos';
        
        $encuestas = new encuestaRepository();
        $dataCharts = new stdClass();
        $dataChartsHtml = new stdClass();
        
        $dataCharts->paises = $encuestas->getEncuestasLocalizacion(4);
        $dataCharts->comunidades = $encuestas->getEncuestasLocalizacion(3);
        $dataCharts->provincias = $encuestas->getEncuestasLocalizacion(2);
        $dataCharts->ciudades = $encuestas->getEncuestasLocalizacion(1);
        
        // obtendría las preguntas tipo opciones
        $preguntas = new preguntaRepository();
        $result_preguntas_opciones = $preguntas->getPreguntaPorTipo(2);
        
        foreach ($result_preguntas_opciones as $tipoOpcion) {
            
            $value = $tipoOpcion->pregunta_id;
            $dataCharts->$value = $encuestas->getEncuestasOpciones($tipoOpcion->pregunta_id);
            $dataCharts->$value->pregunta_id = $tipoOpcion->pregunta_id;
            $dataCharts->$value->titulo = $tipoOpcion->titulo;
            
            $dataChartsHtml->$value = $encuestas->getEncuestasOpciones($tipoOpcion->pregunta_id);
            $dataChartsHtml->$value->pregunta_id = $tipoOpcion->pregunta_id;
            $dataChartsHtml->$value->titulo = $tipoOpcion->titulo;
            
        }
        
        $result_preguntas_multiple = $preguntas->getPreguntaPorTipo(3);
        
        foreach ($result_preguntas_multiple as $tipoOpcion) {
            
            $value = $tipoOpcion->pregunta_id;
            $dataCharts->$value = $encuestas->getEncuestasOpcionesMultiple($tipoOpcion->pregunta_id);
            $dataCharts->$value->pregunta_id = $tipoOpcion->pregunta_id;
            $dataCharts->$value->titulo = $tipoOpcion->titulo;
            
            $dataChartsHtml->$value = $encuestas->getEncuestasOpcionesMultiple($tipoOpcion->pregunta_id);
            $dataChartsHtml->$value->pregunta_id = $tipoOpcion->pregunta_id;
            $dataChartsHtml->$value->titulo = $tipoOpcion->titulo;
        }

        
        $this->extra = json_encode($dataCharts);
        
        $send = $this->template->fetch('panel/informes/graficos.html');
        
        return $this->getJSONEncode($send);
    }

    /**
     * Guardar imagen
     * @param type $id
     * @param type $files
     * @return type
     */
    private function guardarImagen($id, $files){

        $imagenNombre = $files['ruta_imagen']['name'];
            
            // Getting file extension 
            $imagen_new_name = explode(".", $imagenNombre);
            $imagen_extension = end($imagen_new_name);
            
            if ($imagenNombre != ""){
                //Borramos la imagen existente, por si introducimos otra que tenga una extension diferente se borre la antigua
                $direccion_antigua = "../images/panel/rutas/imagen_ruta_$id";
                unlink(glob($direccion_antigua . '*.{jpg,jpeg,png,gif}', GLOB_BRACE)[0]);
            }
            // Location 
            $imagenLocation = "images/panel/rutas/imagen_ruta_$id.$imagen_extension";

            // Upload file 
            if (move_uploaded_file($files['ruta_imagen']['tmp_name'], "../" . $imagenLocation)) {
                $imagenResponse = $imagenLocation;

            }
            return $imagenResponse;
    }
    
    /**
     * Guardar Fichero
     * @param type $id
     * @param type $files
     * @return type
     */
    private function guardarFichero($id, $files){
        $ficheronombre = $files['ruta_link_descarga']['name'];
            
            // Getting file extension 
            $fichero_new_name = explode(".", $ficheronombre);
            $fichero_extension = end($fichero_new_name);
            
            // Location 
            $ficheroLocation = "documents/panel/rutas/fichero_ruta_$id.$fichero_extension";

            // Upload file 
            if (move_uploaded_file($files['ruta_link_descarga']['tmp_name'], "../" . $ficheroLocation)) {
                $ficheroResponse = $ficheroLocation;
            }
            return $ficheroResponse;
    }

    private function perfil(){
        
        //echo print_r($_SESSION);
        $id = $this->user_id;
        $model = new usersModel();
        $result_model = $model->select("user_id=$id");
        //echo print_r($result_model);
        
        $this->template->assign('usuario', $result_model[0]);
        
        // ahora en la vista (en el html) accedes con [s/$usuario->name/s], etc.
        
        $send = $this->template->fetch('panel/profile.html');
        
        
        return $this->getJSONEncode($send);
    }
    
    
    private function obtenerBalance(){

        // Obtener Encuestas meses
        $date_from = new DateTime();
        $date_from->modify('-6 months');
        $encuestasRep = new encuestaRepository();
        $result_dates = $encuestasRep->getEncuestasBalance($date_from->format('Y-m-d'),$this->today->format('Y-m-d').' 23:59:59');
        
        //echo print_r($result_dates);
        
        return $this->getJSONEncode(json_encode($result_dates));
        
    }
    
    private function modificarUsuario($params, $files){
        //echo print_r($params);
        //echo print_r($files);
        $okEmail = true;
        
        $model = new usersModel();
        $registroOriginal = $model->select("user_id=$params->id")[0];
        $result_model = $model->select();
        //echo print_r($result_model);
        
        // && $params->emailNuevo != $registroOriginal->email
        if ($registroOriginal->email != $params->emailNuevo) {
            foreach ($result_model as $registro) {
                if ($params->emailNuevo == $registro->email) {
                    $okEmail = false;
                    break;
                }
            }
        }
        if ($okEmail) {
            
            $model->setUser_id($params->id);
            $model->setName($params->nombreNuevo);
            $model->setLastname($params->apellidoNuevo);
            $model->setEmail($params->emailNuevo);
            
            $imagenUrl = $this->guardarFoto($params->id, $files);
            $model->setPhoto($imagenUrl);
            $result_update = $model->update();

            // Mensaje final 
            if ($result_update) {
                $this->msg = 'Usuario modificado correctamente.';
                $this->type_msg = 'INFO';
            } else {
                $this->msg = 'Error al modificar el usuario.';
                $this->type_msg = 'ERROR';
            }
        } else {
                $this->msg = 'No se pudo modificar. La dirección de email que intenta introducir ya está en uso.';
                $this->type_msg = 'ERROR';
        }

            return $this->perfil();
    }
    
    private function guardarFoto($id, $files){
        $imagenNombre = $files['fotoNuevo']['name'];
        
            // Getting file extension 
            $imagen_new_name = explode(".", $imagenNombre);
            $imagen_extension = end($imagen_new_name);
            
            if ($imagenNombre != ""){
                //Borramos la imagen existente, por si introducimos otra que tenga una extension diferente se borre la antigua
                $direccion_antigua = "../images/panel/usuarios/usuario_$id";
                unlink(glob($direccion_antigua . '*.{jpg,jpeg,png,gif}', GLOB_BRACE)[0]);
            }
            // Location 
            $imagenLocation = "images/panel/usuarios/usuario_$id.$imagen_extension";
            $imageFileType = pathinfo($imagenLocation, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            
            // Upload file 
            if (move_uploaded_file($files['fotoNuevo']['tmp_name'], "../" . $imagenLocation)) {
                $imagenResponse = $imagenLocation;
            }
            return $imagenResponse;
    }
    
    private function modificarContra($params){
        //echo print_r($params);
        $model = new usersModel();
        $user_id = $params->user_id;
        $password = $params->pass;

        // no crees funciones dentro de funciones xDDD te la he sacado fuera y se accede con $this-> porque está dentro de la clase.
        // de hecho esa función podría estar en la librería de funciones comunes, pero bueno como este proyecto no tiene más sitios pues se deja en esta clase.
        
        $password_segura = $this->securePass($password);

        $model->setUser_id($user_id);
        $model->setPassword($password_segura);
        
        $result_update = $model->update();
        
        // Mensaje final 
        if ($result_update) {
            $this->msg = 'Contraseña modificada correctamente.';
            $this->type_msg = 'INFO';
        } else {
            $this->msg = 'Error al modificar la contraseña.';
            $this->type_msg = 'ERROR';
        }
        return $this->perfil();
    }
    
    private function securePass($password) {
        $password_encrypt = $password;
        $costt = array('cost' => PASSWORD_BCRYPT_DEFAULT_COST);
        $password_encrypt_aux = password_hash($password_encrypt, PASSWORD_BCRYPT, $costt);

        return $password_encrypt_aux;
    }

}


