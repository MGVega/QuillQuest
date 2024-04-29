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
            
            case 'verQR':
		$resultado = $this->verQR();
		break;
                  
            case 'preguntaRequest':
		$resultado = $this->preguntaRequest($params);
		break;
            
            case 'listadoPreguntas':
		$resultado = $this->listadoPreguntas();
		break;
            
            case 'encuestasRealizadas':
		$resultado = $this->encuestasRealizadas();
		break;
            
            case 'graficos':
		$resultado = $this->graficos();
		break;
            
            case 'documentos':
		$resultado = $this->documentos();
		break;
            
            case 'rutaRequest':
		$resultado = $this->rutaRequest($params, $files);
		break;
            
            case 'crearRuta':
		$resultado = $this->crearRuta();
		break;
            
            case 'listadoRutas':
		$resultado = $this->listadoRutas();
		break;
            
            case 'perfil':
		$resultado = $this->perfil();
		break;
            
            case 'verEncuestaPage':
                $resultado = $this->verEncuestaPage($params);
                break;
            
            case 'verPreguntaPage':
                $resultado = $this->verPreguntaPage($params);
                break;
            
            case 'obtenerBalance':
                $resultado = $this->obtenerBalance();
                break;
            
            case 'cargarInforme':
                $resultado = $this->cargarInforme($params);
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
    
    
    private function verQR(){
        
        $qrLocation = "../images/qr/encuestaQr.png";
        $urlEncuesta = _URL_ENVIRONMENT.'encuesta';
        QRcode::png($urlEncuesta, $qrLocation, QR_ECLEVEL_M);
        
        //pdf
        $filename =  '../documents/qr.pdf';

        $pdf = new PDF();
        $pdf->SetMargins(20, 20, 20); // before add page
        $pdf->AddPage();

        $pdf->SetFont('Arial', '', 20);
        $pdf->SetXY(95,15);

        $pdf->Image('../images/escudoMirandilla.png');
        $pdf->SetX(55);
        $pdf->Cell(100,10, "Ayuntamiento", 0, 1, 'C'); 
        $pdf->SetX(55);
        $pdf->Cell(100,10, "de", 0, 1, 'C');
        $pdf->SetX(55);
        $pdf->Cell(100,10, "Mirandilla", 0, 1, 'C');
        //$pdf->Line(10, 35, 200, 35); Dibujar una linea
        
        $pdf->SetXY(55,110);
        $pdf->Cell(100, 20,"Encuesta", 0, 1, 'C');
        $pdf->SetX(80);
        $pdf->Cell(50,50, $pdf->Image('../images/qr/encuestaQr.png', $pdf->GetX(), $pdf->GetY(),50),0, 'C');
        $pdf->Ln();
        $pdf->SetFont('Arial', 'I', 10);
        $pdf->SetX(55);
        $pdf->Cell(100, 10,utf8_decode("Escanee el código QR para visualizar la encuesta"), 0, 1, 'C');

        $pdf->Output($filename, 'F');
        
        $send = $this->template->fetch('panel/qr/qr.html');
        
        return $this->getJSONEncode($send);
    }
    

    private function preguntaRequest($params){

        $request_type = filter_var($params->request_type,FILTER_SANITIZE_STRING);
        $send = '';
        
        switch ($request_type) {
            case 'create':
                $send = $this->crearPregunta();
                break;
            
            case 'modify':
                $send = $this->modificarPregunta($params, 1);
                break;
            
            case 'activate':
                $send = $this->activarPregunta($params, 1);
                break;
            
            case 'deactivate':
                $send = $this->activarPregunta($params, 0);
                break;
            
            case 'save':
                $send = $this->modificarPregunta($params, 0);
                break;

            default:
                break;
        }
                
        return $send;
    }
    
    
    private function crearPregunta(){
                
        $this->cargarPreguntasSelect();
        $this->cargarPreguntasTipo();
        
        $send = $this->template->fetch('panel/encuestas/crearPregunta.html');
        
        return $this->getJSONEncode($send);
    }
    
    /**
     * Modificar o guardar pregunta nueva
     * @param stdClass $params
     * @param int $save
     * @return html
     */
    private function modificarPregunta($params, $save){

        $result = false;
        $id = intval($params->id);
        $titulo = filter_var($params->titulo, FILTER_SANITIZE_STRING);
        $pregunta_tipo_id = intval($params->pregunta_tipo);
        $activar_otros = intval($params->activar_otros);
        $num_select = intval($params->num_select);
        $preguntas_opciones = $params->opciones;
        $preguntas_selects = $params->selects;

        $model = new preguntasModel();
        $model->setActivar_otros($activar_otros);
        if($pregunta_tipo_id == 1){
            $model->setNum_select($num_select);
        }        
        $model->setPregunta_tipo_id($pregunta_tipo_id);
        $model->setTitulo($titulo);
        $model->setVisible(1);
        
        if(empty($save)){
            
            $result = $model->add();
            $id = $result; // para guardar el resto
            
        }else{           
            
            $model->setPregunta_id($id);
            $result = $model->update();
            // llamar a update
        }
 
        // si todo va bien guardo las opciones o los selects
        if ($result) {
            
            if ($pregunta_tipo_id == 2 || $pregunta_tipo_id == 3) {

                $this->crearOpcionesPreguntas($id, $preguntas_opciones);
                
            } elseif ($pregunta_tipo_id == 1) {

                $this->crearSelectsPreguntas($id, $preguntas_selects);
            }

            $this->msg = 'Pregunta modificada correctamente.';
            if(empty($save)){
                $this->msg = 'Pregunta creada correctamente.';
            }
            $this->type_msg = 'INFO';
        } else {
            
            $this->msg = 'Error al modificar pregunta.';
            if(empty($save)){
                $this->msg = 'Error al crear pregunta.';
            }
            $this->type_msg = 'ERROR';
        }

        if(empty($save)){
            
            return $this->crearPregunta();
        }
        
        return $this->listadoPreguntas();
    }
    
    private function crearOpcionesPreguntas($id, $preguntas_opciones) {

        $opciones = new preguntasOpcionesModel();
        $opciones->setPregunta_id($id);

        foreach ($preguntas_opciones as $op) {
            
            if (!empty($op)) {
                $opciones->setNombre($op->text);
                $opciones->setOrden($op->order);

                if (empty($op->option_id)) {
                    $opciones->add();
                    
                } else {
                    
                    if(empty($op->delete)){
                        
                        $opciones->setOpcion_id($op->option_id);
                        $opciones->update();
                        
                    }else{
                        $where_delete = "opcion_id=$op->option_id";
                        $opciones->delete($where_delete);
                    }
                    
                    
                }
            }
        }
    }
    
    private function crearSelectsPreguntas($id, $preguntas_selects) {

        $selects = new preguntasSelectModel();
        $selects->delete("pregunta_id=$id");
        $selects->setPregunta_id($id);

        foreach ($preguntas_selects as $sel) {
            if (!empty($sel)) {
                $selects->setSelect_id($sel->id);
                $selects->add();
            }
        }
    }

    /**
     * 
     * @param type $params
     * @param type $active
     * @return html
     */
    private function activarPregunta($params, $active){
        
        $id = intval($params->id);
        
        $model = new preguntasModel();
        $model->setPregunta_id($id);
        $model->setVisible($active);
        $result = $model->updateVisible();

        if ($result) {
            $this->msg = 'Pregunta activada/desactivada correctamente.';
            $this->type_msg = 'INFO';
        } else {
            $this->msg = 'Error al activar/desactivar pregunta.';
            $this->type_msg = 'ERROR';
        }

        
        return $this->listadoPreguntas();
    }
    
    
    
    private function listadoPreguntas(){
        
        $model = new preguntasModel();
        $join = " INNER JOIN wi_preguntas_tipo USING(pregunta_tipo_id)";
        $result_model = $model->select('pregunta_id>0 order by pregunta_id','','*',$join);
        
        $result_preguntas = $this->ordenarPreguntas($result_model);
        $this->cargarPreguntasSelect();
        $this->cargarPreguntasTipo();
        
        $this->template->assign('preguntas',$result_preguntas);
        $send = $this->template->fetch('panel/encuestas/listadoPreguntas.html');
        
        return $this->getJSONEncode($send);
        
    }
    
    
    private function encuestasRealizadas(){
        
        $encuestas = new encuestaRepository();
        
        $this->template->assign('encuestas',$encuestas->getEncuestas());
        $send = $this->template->fetch('panel/encuestas/listadoEncuestas.html');
        
        return $this->getJSONEncode($send);
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
    
    
    private function documentos(){
        
        $preguntas = new preguntaRepository();
        
        $this->template->assign('preguntas',$preguntas->getPreguntasSimple(1));
        $send = $this->template->fetch('panel/informes/informes.html');
        
        return $this->getJSONEncode($send);
    }
    
    private function rutaRequest($params, $files){

        $request_type = filter_var($params->request_type,FILTER_SANITIZE_STRING);
        $send = '';
        
        switch ($request_type) {
            
            case 'save':
                $send = $this->nuevaRuta($params, $files);
                break;
            
            case 'delete':
                $send = $this->borrarRuta($params);
                break;
            
            case 'update':
                $send = $this->actualizarRuta($params, $files);
                break;
            
            case 'borrarRutaArchivo':
                $send = $this->borrarRutaArchivo($params);
                break;
            
            default:
                break;
        }
                
        return $send;
    }

/* - - - - - - - - - - NUEVA RUTA - - - - - - - - - - */
    private function nuevaRuta($params, $files) {

        $result = false;
        $titulo = filter_var($params->ruta_titulo, FILTER_SANITIZE_STRING);
        $descripcion = filter_var($params->ruta_descripcion, FILTER_SANITIZE_STRING);
        $dificultad = intval($params->ruta_dificultad);
        $km = str_replace(',', '.', floatval($params->ruta_km));
        $tipo_ruta = intval($params->ruta_tipo);

        $model = new rutasModel();
        $model->setTitulo($titulo);
        $model->setDescripcion($descripcion);
        $model->setDificultad($dificultad);
        $model->setKm($km);
        $model->setTipo_ruta($tipo_ruta);
        $id = $model->add();

        // GUARDAR IMAGEN - - - - - - - - - - 
        $ImagenUrl = $this->guardarImagen($id, $files);

        // GUARDAR FICHERO - - - - - - - - - - 
        $ficheroUrl = $this->guardarFichero($id, $files);

        $model->setRuta_id($id);
        $model->setImage($ImagenUrl);
        $model->setLink_descarga($ficheroUrl);
        $model->update();

        // Mensaje final 
        if ($id) {
            $this->msg = 'Ruta creada correctamente.';
            $this->type_msg = 'INFO';
            
            // leo los datos del xml para guardar los puntos
            $this->leerRuta($ficheroUrl, $id);
        } else {
            $this->msg = 'Error al crear ruta.';
            $this->type_msg = 'ERROR';
        }

        return $this->crearRuta();
    }

    private function actualizarRuta($params, $files) {

        $model = new rutasModel();

        $id = intval($params->id);
        $titulo = filter_var($params->ruta_titulo, FILTER_SANITIZE_STRING);
        $descripcion = filter_var($params->ruta_descripcion, FILTER_SANITIZE_STRING);
        $dificultad = intval($params->ruta_dificultad);
        $km = str_replace(',', '.', floatval($params->ruta_km));
        $tipo_ruta = intval($params->ruta_tipo);

        $model->setRuta_id($id);
        $model->setTitulo($titulo);
        $model->setDescripcion($descripcion);
        $model->setDificultad($dificultad);
        $model->setKm($km);
        $model->setTipo_ruta($tipo_ruta);

        // GUARDAR IMAGEN - - - - - - - - - - 
        $ImagenUrl = $this->guardarImagen($id, $files);

        // GUARDAR FICHERO - - - - - - - - - - 
        $ficheroUrl = $this->guardarFichero($id, $files);

        $model->setRuta_id($id);
        $model->setImage($ImagenUrl);
        $model->setLink_descarga($ficheroUrl);
        $result_update = $model->update(); 

        // Mensaje final 
        if ($result_update) {
            $this->msg = 'Ruta modificada correctamente.';
            $this->type_msg = 'INFO';

            // leo los datos del xml para guardar los puntos
            $this->leerRuta($ficheroUrl, $id);
        } else {
            $this->msg = 'Error al modificar ruta.';
            $this->type_msg = 'ERROR';
        }

        return $this->listadoRutas();
    }
    
    private function leerRuta($fichero, $ruta_id) {

        $xml_ruta = simplexml_load_file(_URL_ENVIRONMENT.$fichero);
        
        $modelRuta = new rutasModel();
        $modelLatLon = new rutasLatLonModel();
        $modelPoints = new rutasPointsModel();
        
        $modelRuta->setRuta_id($ruta_id);
        $modelLatLon->setRuta_id($ruta_id);
        $modelPoints->setRuta_id($ruta_id);

        $modelRuta->setCenter_lat((float) $xml_ruta->trk->trkseg->trkpt[0]['lat'][0]);
        $modelRuta->setCenter_lon((float) $xml_ruta->trk->trkseg->trkpt[0]['lon'][0]);
        $modelRuta->updateLatLon();

        // Borro las tablas primero
        $modelLatLon->delete("ruta_id=$ruta_id");
        $modelPoints->delete("ruta_id=$ruta_id");
        
        foreach($xml_ruta->wpt as $wpt){

            $modelPoints->setLat((float)$wpt['lat'][0]);
            $modelPoints->setLon((float)$wpt['lon'][0]);
            $modelPoints->setTitle((string)$wpt->name);
            
            $modelPoints->add();
            
        }
        
        foreach($xml_ruta->trk->trkseg->trkpt as $trkpt){
            
            $modelLatLon->setLat((float)$trkpt['lat'][0]);
            $modelLatLon->setLon((float)$trkpt['lon'][0]);
            
            $modelLatLon->add();
            
        }
        
        return true;
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
    
    // - - - - Borrar imagen/fichero
    private function borrarRutaArchivo($params){
        
        $ruta_id = intval($params->ruta_id);
        $tipoArchivo = filter_var($params->tipoArchivo, FILTER_SANITIZE_STRING);
        
        $model = new rutasModel();
        $model->setRuta_id($ruta_id);
        
        if ($tipoArchivo == 'imagen'){
                //Obtenemos el link de la imagen de la bbdd
            $select_imagen = $model->select("ruta_id=$ruta_id","imagen","imagen");
            $ruta_imagen = "../".$select_imagen[0]->imagen;
            unlink($ruta_imagen); //Borrar imagen
            $model->update("imagen=null", "id=$ruta_id");
            
        } else if($tipoArchivo == 'fichero'){
            
                //Obtenemos el link del archivo de descarga de la bbdd
            $select_link_descarga = $model->select("ruta_id=$ruta_id","link_descarga","link_descarga");
            $ruta_link_descarga = "../".$select_link_descarga[0]->link_descarga;
            unlink($ruta_link_descarga); //Borrar archivo
            $model->update("link_descarga=null", "id=$ruta_id");
        }
        
        return $this->listadoRutas();
   }
    
   // - - - - Borrar ruta completa
    private function borrarRuta($params){
        
        $ruta_id = intval($params->ruta_id);
        
        $model = new rutasModel();
        $model->setRuta_id($ruta_id);
            //Obtenemos el link de la imagen de la bbdd
        $select_imagen = $model->select("ruta_id=$ruta_id","imagen","imagen");
        $ruta_imagen = "../".$select_imagen[0]->imagen;
           //Obtenemos el link del archivo de descarga de la bbdd
        $select_link_descarga = $model->select("ruta_id=$ruta_id","link_descarga","link_descarga");
        $ruta_link_descarga = "../".$select_link_descarga[0]->link_descarga;
        
        $result_delete = $model->delete("ruta_id=$ruta_id");
        unlink($ruta_imagen); //Borrar imagen
        unlink($ruta_link_descarga); //Borrar archivo
        
        // Mensaje final 
        if ($result_delete) {
            $this->msg = 'Ruta eliminada correctamente.';
            $this->type_msg = 'INFO';
        } else {
            $this->msg = 'Error al eliminar ruta.';
            $this->type_msg = 'ERROR';
        }
        
        return $this->listadoRutas();
    }
    
    /**
     * Crear ruta
     * @return type
     */
    private function crearRuta(){
        
        $send = $this->template->fetch('panel/rutas/crearRuta.html');
        
        return $this->getJSONEncode($send);
    }
    
    /**
     * Listado de rutas
     * @return type
     */
    private function listadoRutas(){
        
        $model = new rutasModel();
        $result_model = $model->select();
        
        $this->template->assign("listaRutas",$result_model);
        $send = $this->template->fetch('panel/rutas/listadoRutas.html');
        
        return $this->getJSONEncode($send);
    }
    
    

    private function perfil(){
        
        //echo print_r($_SESSION);
        $id = $this->user_id;
        $model = new usersModel();
        $result_model = $model->select("user_id=$id");
        //echo print_r($result_model);
        
        /*$nombreUsuario = $result_model[0]->name;
        $apellidoUsuario = $result_model[0]->lastname;
        $emailUsuario = $result_model[0]->email;
        $imagenUsuario = $result_model[0]->photo;
        
        $send = $this->template->assign('nombreUsuario', $nombreUsuario);
        $send = $this->template->assign('apellidoUsuario', $apellidoUsuario);
        $send = $this->template->assign('emailUsuario', $emailUsuario);
        $send = $this->template->assign('imagenUsuario', $imagenUsuario);
        $send = $this->template->assign('idUsuario', $id);*/
        
        // no tienes que hacer lo de arriba, si ya lo tienes en $result_model sólo tienes que asignar esa variable a la plantilla
        // y como es sólo un registro (porque sabes que es uno) asignas a la plantilla la primera posición.
        
        // y a parte cada vez que asignas un valor no tienes que sobreescribr la variable $send
        //con $this->template->assign asignas a la plantilla pero eso no devuelve nada, pro tanto no tienes que asignarlo a anda.
        
        // todo lo anterior quedaría en esto:
        
        $this->template->assign('usuario', $result_model[0]);
        
        // ahora en la vista (en el html) accedes con [s/$usuario->name/s], etc.
        
        $send = $this->template->fetch('panel/profile.html');
        
        
        return $this->getJSONEncode($send);
    }
    
    private function cargarPreguntasSelect(){
        
        $model = new selectModel();
        $result_model = $model->select();
        
        $this->template->assign('selects', $result_model);
        
    }
    
    private function cargarPreguntasTipo(){        
        
        $model = new preguntasTipoModel();
        $result_model = $model->select();
        
        $this->template->assign('preguntasTipo', $result_model);
        
    }
    
    private function ordenarPreguntas($preguntas) {

        if (!empty($preguntas)) {
            foreach ($preguntas as $key => $pregunta) {

                if ($pregunta->pregunta_tipo_id == 2 || $pregunta->pregunta_tipo_id == 3) {

                    $model = new preguntasOpcionesModel();
                    $result_model = $model->select("pregunta_id=$pregunta->pregunta_id");

                    $preguntas[$key]->opciones = $result_model;
                } elseif ($pregunta->pregunta_tipo_id == 1) {

                    $model = new preguntasSelectModel();
                    $result_model = $model->select("pregunta_id=$pregunta->pregunta_id");

                    $preguntas[$key]->selects = $result_model;
                }
            }
        }

        return $preguntas;
        
    }
    
    private function verEncuestaPage($params){
        
        $encuesta_id = intval($params->id);
        
        $encuesta = new encuestaRepository();
                
        $this->template->assign("encuesta",$encuesta->getRespuestasEncuesta($encuesta_id));
        $send = $this->template->fetch('panel/encuestas/verEncuesta.html');
        return $this->getJSONEncode($send);
    }
    
    
    private function verPreguntaPage($params){
        
        $pregunta_id = intval($params->id);
        
        $pregunta = new preguntaRepository();
        
        $this->cargarPreguntasSelect();
        $this->cargarPreguntasTipo();
        
        $result_pregunta = $pregunta->getPreguntaView($pregunta_id);
        
        $this->template->assign("pregunta",$result_pregunta[$pregunta_id]);
        $send = $this->template->fetch('panel/encuestas/verPregunta.html');
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
    
    private function cargarInforme($params){
        
        $id = intval($params->id);
        
        $preguntas = new preguntaRepository();
        
        $respuestas = new encuestaRepository();
        $datosPregunta = $preguntas->getUnaPregunta($id);
        
        switch ($datosPregunta->pregunta_tipo_id) {
            case 1:
                $result_pregunta = $respuestas->getRespuestasEncuestasPorPregunta($id);                
                break;
            
            case 2:
                $result_pregunta = $respuestas->getEncuestasOpciones($id);
                break;
            
            case 3:

                $result_pregunta = $respuestas->getEncuestasOpcionesMultiple($id);
                break;
            
            case 4:

                $result_pregunta = $respuestas->getEncuestasSiNo($id);
                break;
            
            case 5:
                $result_pregunta = $respuestas->getRespuestasEncuestasPorPregunta($id);
                break;
            
            case 6:
                $result_pregunta = $respuestas->getRespuestasEncuestasPorPregunta($id);
                break;

            default:
                $result_pregunta = array();
                break;
        }
        
        
        //echo print_r($result_pregunta);
         
        $this->template->assign("resultados",$result_pregunta);
        $this->template->assign("pregunta",$datosPregunta);
        
        if($datosPregunta->pregunta_tipo_id==1){
            $send = $this->template->fetch('panel/informes/cargarTablaInformeSelect.html');
        }elseif($datosPregunta->pregunta_tipo_id==5 || $datosPregunta->pregunta_tipo_id==6){
            $send = $this->template->fetch('panel/informes/cargarTablaInformeOtros.html');
        }
        else{
            $send = $this->template->fetch('panel/informes/cargarTablaInforme.html');
        }
        
        
        return $this->getJSONEncode($send);
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


