<?php

/* 
 * Developed by wilowi
 */
final class encuestasRespuestasMultipleModel extends baseModel {

    private $encuesta_id = 0;
    private $pregunta_id = 0;
    private $opcion_id = 0;
    
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_encuestas_respuestas_multiple');
    }

    public function select($where = '', $as = '', $select = '*', $join = '') {
	return parent::select($where, $as, $select, $join);
    }
    
     public function add($indices = '', $valores = '') {
         
        $first = true;
        
        if (!empty($this->encuesta_id)) {
            if ($first) {
                $indices .= "encuesta_id";
                $valores .= "'" . $this->encuesta_id . "'";
                $first = false;
            } else {
                $indices .= ",encuesta_id";
                $valores .= ",'" . $this->encuesta_id . "'";
            }
        }

        if (!empty($this->pregunta_id)) {
            if ($first) {
                $indices .= "pregunta_id";
                $valores .= "'" . $this->pregunta_id . "'";
                $first = false;
            } else {
                $indices .= ",pregunta_id";
                $valores .= ",'" . $this->pregunta_id . "'";
            }
        }


        if (!empty($this->opcion_id)) {
            if ($first) {
                $indices .= "opcion_id";
                $valores .= "'" . $this->opcion_id . "'";
                $first = false;
            } else {
                $indices .= ",opcion_id";
                $valores .= ",'" . $this->opcion_id . "'";
            }
        }
        

        return parent::add($indices, $valores);
    }
    
    public function getEncuesta_id() {
        return $this->encuesta_id;
    }

    public function getPregunta_id() {
        return $this->pregunta_id;
    }

    public function getOpcion_id() {
        return $this->opcion_id;
    }

    public function setEncuesta_id($encuesta_id): void {
        $this->encuesta_id = $encuesta_id;
    }

    public function setPregunta_id($pregunta_id): void {
        $this->pregunta_id = $pregunta_id;
    }

    public function setOpcion_id($opcion_id): void {
        $this->opcion_id = $opcion_id;
    }



    
}
