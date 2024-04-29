<?php

/* 
 * Developed by wilowi
 */
final class encuestasModel extends baseModel {
    
    private $encuesta_id = 0;
    private $fecha_encuesta = '';

    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_encuestas');
    }

    public function select($where = '', $as = '', $select = '*', $join = '') {
	return parent::select($where, $as, $select, $join);
    }
    
     public function add($indices = '', $valores = '') {

        $first = true;

        if (!empty($this->fecha_encuesta)) {
            if ($first) {
                $indices .= "fecha_encuesta";
                $valores .= "'" . $this->fecha_encuesta . "'";
                $first = false;
            } else {
                $indices .= ",fecha_encuesta";
                $valores .= ",'" . $this->fecha_encuesta . "'";
            }
        }
        
        return parent::add($indices, $valores);
    }

    public function getEncuesta_id() {
        return $this->encuesta_id;
    }

    public function getFecha_encuesta() {
        return $this->fecha_encuesta;
    }

    public function setEncuesta_id($encuesta_id): void {
        $this->encuesta_id = $encuesta_id;
    }

    public function setFecha_encuesta($fecha_encuesta): void {
        $this->fecha_encuesta = $fecha_encuesta;
    }
}
