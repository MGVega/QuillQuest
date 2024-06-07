<?php

/**
 * Rutas Controller
 *
 * @author Wilowi - Sandra Campos
 * @since 16/02/2023
 *
 */

header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Cache-Control: no-store, no-cache, must-revalidate');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Pragma: no-cache");
ini_set('display_errors', 0);

final class rutasController extends controller{    
    
    /**
     * Assign page for smarty template
     * @var string
     */
    private $ruta_id = '';

    
    
    /**
     * Construct
     */
    public function __construct() {

	parent::__construct();
	$this->logs->setFolder('rutas/');	
	$this->link = _URL_ENVIRONMENT.'/panel';	
	
    }
    
    /**
     * Set page to show in document
     * @param string $ruta_id
     */
    public function setRuta($id){
	
	$this->ruta_id = $id;
    }
    
    /**
     * Main function
     */
    public function main() {

        parent::main();
        
        $extra = "../";
        $show_menu = true;
        $this->printHeaderHTML($extra);
        $this->template->assign("reCaptcha", _KEY_CAPTCHA);
        $this->template->assign("urlEnvironment", _URL_ENVIRONMENT);

        // - - - - - - - - - - - - - -
        
        
        
        
        $modelHistorias = new historiasModel();
        $where = "historia_id=$this->ruta_id";
        $result_modelHistorias = $modelHistorias->select($where, '', '*', ' LEFT JOIN wi_generos ON(wi_historias.historia_genero_id=wi_generos.genero_id)');
        
        $modelPaginas = new paginasModel();
        $where_pag = "historia_id=$this->ruta_id ORDER BY pagina_id";
        $result_modelPaginas = $modelPaginas->select($where_pag);
        
        $modelElecciones = new eleccionesModel();
        $where_ele = "historia_id=$this->ruta_id";
        $result_modelElecciones = $modelElecciones->select($where_ele);
        
        /*echo print_r($result_modelHistorias[0]);
        echo print_r($result_modelPaginas);
        echo print_r($result_modelElecciones);*/
        
        $this->template->assign("historia", $result_modelHistorias[0]);
        $this->template->assign("paginas", $result_modelPaginas);
        $this->template->assign("elecciones", $result_modelElecciones);

        $content = $this->template->fetch("web/rutas/rutaSeleccionada.html");
	
        
        
        
        // - - - - - - - - - - - - - -
        
	// header
	$this->chargeHeader($extra, $show_menu);
	
	// content
	echo $content;
	
	// footer
        /*$this->chargeFooter($extra, $show_menu);*/

        $this->printHeaderPos();
        
        
        
	
        if ($this->page == 'rutas' || $this->page == 'encuesta' || $this->page == '') {
            $model = new analyticsModel();
            $resultModel = $model->select();
            $visitas_totales = $resultModel[0]->visitas_totales;
            $visitas_totales++;
            $model->setVisitas_totales($visitas_totales);
            $model->update("dato_id=1");
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
        $this->template_footer->assign('urlJsRutas', $extra . _JSWEB . _JSR);
        $this->template_footer->assign('apiGoogle', 1);
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
    
    private function chargeHeader($extra, $show_menu) {

        $plantilla_header = new newSmarty();
        $plantilla_header->assign('url', _URL_ENVIRONMENT);
        $plantilla_header->assign('page', $this->page);
        $plantilla_header->assign('show_menu', $show_menu);
        $plantilla_header->assign('urlExtra', $extra);
        $descripcion = "";
        $nombre = "";
        $imagen = "";
        
        session_start();
        if($_SESSION['name_user']){
            $usuarioModel = new usersModel();
            $resultado = "../".$usuarioModel->select("user_id=".$_SESSION['user_id'])[0]->photo;
            $plantilla_header->assign('testt', "hola");
            $plantilla_header->assign('fotoPerfil', $resultado);
        }
        
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
        $this->printFooterJs($extra);
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

            case 'leerRuta':
                $resultado = $this->leerRuta($params);
                break;

            default:
                break;
        }

        return $resultado;
    }
    
    private function leerRuta($params) {

        $ruta_id = intval($params->ruta_id);

        $modelRutas = new rutasModel();
        $where = "ruta_id=$ruta_id";
        $result_modelRutas = $modelRutas->select($where);
        
        $xml_ruta = simplexml_load_file(_URL_ENVIRONMENT.$result_modelRutas[0]->link_descarga);
        
        $rutaElement = new stdClass();
        $rutaElement->desc = (string) $xml_ruta->trk->desc[0];
        $rutaElement->cmt = (string) $xml_ruta->trk->cmt[0];
        $rutaElement->title = (string) $xml_ruta->trk->name[0];
        $rutaElement->center_lat = (float) $xml_ruta->trk->trkseg->trkpt[0]['lat'][0];
        $rutaElement->center_lng = (float) $xml_ruta->trk->trkseg->trkpt[0]['lon'][0];
        $rutaElement->points = array();
        $rutaElement->polylines = array();

        foreach($xml_ruta->wpt as $wpt){
            
            $aux = new stdClass();
            $aux->position = new stdClass();
            $aux->position->lat = (float)$wpt['lat'][0];
            $aux->position->lng = (float)$wpt['lon'][0];
            $aux->title = (string)$wpt->name;
            
            array_push($rutaElement->points,$aux);
            
        }
        
        foreach($xml_ruta->trk->trkseg->trkpt as $trkpt){
            
            $aux = new stdClass();
            $aux->lat = (float)$trkpt['lat'][0];
            $aux->lng = (float)$trkpt['lon'][0];
            
            array_push($rutaElement->polylines,$aux);
            
        }
        
        return $this->getJSONEncode(json_encode($rutaElement));
    }


}// guardarEncuesta