<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of controller
 *
 * @author Sandra
 */
class controller {
    
        /**
     * Object for a template
     * @var class newSmarty 
     */
    protected $template = null;
    
    /**
     * Parameter to control some options in js
     * @var string 
     */
    protected $control_request = false;
    
    /**
     * Extra information for the js.
     * @var string 
     */
    protected $extra = '';
    
    /**
     * Select the tab.
     * @var string 
     */
    protected $tabs = '';
    
    /**
     * Modal Message
     * @var string 
     */
    protected $msg = '';
    
    /**
     * Modal type message.
     * @var string 
     */
    protected $type_msg = '';
    
    /**
     * Control the session.
     * @var boolean 
     */
    protected $exitSession = false;
    
    /**
     * Object for a log class
     * @var class log 
     */
    protected $logs = null;
    
    /**
     * Url
     * @var string 
     */
    protected $link = '';

    /**
     * Type Alert:
     * - RED: error
     * - GREEN: all ok
     * - YELLOW: warning
     * - BLUE: information
     * @var string
     */
    protected $alert_type = '';

    /**
     * Mensaje para mostrar en la alerta.
     * @var string 
     */
    protected $msg_alert = '';
    
    
    
    /**
     * Actual Date
     * @var datetime
     */
    protected $today = null;
    
    /**
     * Debug code
     * @var boolean
     */
    protected $debug = false;
    
    /**
     * Template for header
     * @var smarty
     */
    protected $template_header = null;
    
    /**
     * Template for footer
     * @var smarty
     */
    protected $template_footer = null;
    
    /**
     * Page
     * @var type
     */
    protected $page = '';
    
    /**
     * Contruct
     */
    protected function __construct() {

	$this->template = new newSmarty();
	$this->logs = new logsModel();

        $this->today = new DateTime('now');	
	
    }
    
    /**
     * Main function
     */
    public function main(){
        
    }
    
    /**
     * Set page to show in document
     * @param string $page
     */
    public function setPage($page){
	
	$this->page = $page;
    }
    
    /**
     * Format the ajax response in json
     * @param string $HTML ->html
     * @return string
     */
    protected function getJSONEncode($HTML) {

	// --- Transforms the HTML to JSON
	$result = addslashes($HTML);
	$result = trim(str_replace(array("\r\n", "\n\r", "\n", "\r", "\t"), "", $result));
	$result = str_replace("\'", "'", $result);

	$this->extra = addslashes($this->extra);
	$this->extra = trim(str_replace(array("\r\n", "\n\r", "\n", "\r", "\t"), "", $this->extra));
	$this->extra = str_replace("\'", "'", $this->extra);
	
	$this->msg = addslashes($this->msg);
	$this->msg = trim(str_replace(array("\r\n", "\n\r", "\n", "\r", "\t"), "", $this->msg));
	$this->msg = str_replace("\'", "'", $this->msg);
	
	$this->type_msg = addslashes($this->type_msg);
	$this->type_msg = trim(str_replace(array("\r\n", "\n\r", "\n", "\r", "\t"), "", $this->type_msg));
	$this->type_msg = str_replace("\'", "'", $this->type_msg);

	$respuesta = '{"result":"' . $result . '","control_request":"' . $this->control_request . '","extra":"' . $this->extra . '","tabs":"' . $this->tabs . '","msg":"'.$this->msg.'","type_msg":"'.$this->type_msg.'"}';

        return $respuesta;
    }
    
    
    /**
     * Print the head for the web. Included all libraries and styles.
     */
    protected function printHeaderHTML($extra = "") {
	
	$descripcion = "";
	$keywords = "";
	
	$this->template_header = new newSmarty();
	$this->template_header->assign('title',_TITLE);
	$this->template_header->assign('urlCss',$extra. _CSS);
        $this->template_header->assign('urlCssComun', $extra . _CSS . _FILECSS);
	$this->template_header->assign('urlLib',$extra. _LIB);
	$this->template_header->assign('urlExtra',$extra. _EXTRA);
	$this->template_header->assign('keywords',$keywords);
	$this->template_header->assign('descripcion',$descripcion);	

    }
    
    /**
     * Print the footer fot web. Included javascript
     * @param string $extra
     */
    protected function printFooterJs($extra=''){
        
        $this->template_footer = new newSmarty();        
        $this->template_footer->assign('urlLib',$extra. _LIB);
	$this->template_footer->assign('urlExtra',$extra. _EXTRA);
	$this->template_footer->assign('urlJs', $extra. _JS);        
        $this->template_footer->assign('urlJsConfig', $extra . _JS . _JCONFIG);
        $this->template_footer->assign('urlJsComun', $extra . _JS . _JCOMUN);
        
    }
    
    /**
     * Print a value to debug code
     * @param mixed $value
     */
    protected function printDebug($value){
        
        echo "<pre>";
        echo print_r($value);
        echo "</pre>";
        
    }
    
    /**
     * Get template to redirect the url.
     * @return html
     */
    protected function redirectTemplate() {

        $template_aux = new newSmarty();
        $template_aux->assign('url', $this->link);
        $redirect = $template_aux->fetch("common/redirect.html");
        
        return $redirect;
    }
    


}
