<?php

/* 
 * Developed by wilowi
 */
final class encuestasRespuestasSelectModel extends baseModel {

    private $encuesta_id = 0;
    private $pregunta_id = 0;
    private $select_id = 0;
    private $value_select = 0;
    
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_encuestas_respuestas_select');
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


        if (!empty($this->select_id)) {
            if ($first) {
                $indices .= "select_id";
                $valores .= "'" . $this->select_id . "'";
                $first = false;
            } else {
                $indices .= ",select_id";
                $valores .= ",'" . $this->select_id . "'";
            }
        }
        
        if (!empty($this->value_select)) {
            if ($first) {
                $indices .= "value_select";
                $valores .= "'".$this->value_select."'";
                $first = false;
            } else {
                $indices .= ",value_select";
                $valores .= ",'" . $this->value_select."'";
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

    public function getSelect_id() {
        return $this->select_id;
    }

    public function getValue_select() {
        return $this->value_select;
    }

    public function setEncuesta_id($encuesta_id): void {
        $this->encuesta_id = $encuesta_id;
    }

    public function setPregunta_id($pregunta_id): void {
        $this->pregunta_id = $pregunta_id;
    }

    public function setSelect_id($select_id): void {
        $this->select_id = $select_id;
    }

    public function setValue_select($value_select): void {
        $this->value_select = $value_select;
    }
    
}
