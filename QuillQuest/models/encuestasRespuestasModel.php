<?php

/* 
 * Developed by wilowi
 */
final class encuestasRespuestasModel extends baseModel {

    private $encuesta_id = 0;
    private $pregunta_id = 0;
    private $texto_libre = '';
    private $si_no = 0;
    private $opciones = 0;
    private $opciones_multiple = 0;
    private $opciones_select = 0;
    private $numero_libre = 0;
    private $otros = '';
    
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_encuestas_respuestas');
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

        if (!empty($this->texto_libre)) {
            if ($first) {
                $indices .= "texto_libre";
                $valores .= "'" . $this->texto_libre . "'";
                $first = false;
            } else {
                $indices .= ",texto_libre";
                $valores .= ",'" . $this->texto_libre . "'";
            }
        }

        if (!empty($this->si_no)) {
            if ($first) {
                $indices .= "si_no";
                $valores .= "'" . $this->si_no . "'";
                $first = false;
            } else {
                $indices .= ",si_no";
                $valores .= ",'" . $this->si_no . "'";
            }
        }

        if (!empty($this->opciones)) {
            if ($first) {
                $indices .= "opciones";
                $valores .= "'" . $this->opciones . "'";
                $first = false;
            } else {
                $indices .= ",opciones";
                $valores .= ",'" . $this->opciones . "'";
            }
        }
        
        if (!empty($this->opciones_multiple)) {
            if ($first) {
                $indices .= "opciones_multiple";
                $valores .= "'".$this->opciones_multiple."'";
                $first = false;
            } else {
                $indices .= ",opciones_multiple";
                $valores .= ",'" . $this->opciones_multiple."'";
            }
        }
        
        if (!empty($this->opciones_select)) {
            if ($first) {
                $indices .= "opciones_select";
                $valores .= "'".$this->opciones_select."'";
                $first = false;
            } else {
                $indices .= ",opciones_select";
                $valores .= ",'" . $this->opciones_select."'";
            }
        }
        
        if (!empty($this->numero_libre)) {
            if ($first) {
                $indices .= "numero_libre";
                $valores .= $this->numero_libre;
                $first = false;
            } else {
                $indices .= ",numero_libre";
                $valores .= "," . $this->numero_libre;
            }
        }
        
        if (!empty($this->otros)) {
            if ($first) {
                $indices .= "otros";
                $valores .= "'".$this->otros."'" ;
                $first = false;
            } else {
                $indices .= ",otros";
                $valores .= ",'" . $this->otros."'" ;
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

    public function getTexto_libre() {
        return $this->texto_libre;
    }

    public function getSi_no() {
        return $this->si_no;
    }

    public function getOpciones() {
        return $this->opciones;
    }

    public function getOpciones_select() {
        return $this->opciones_select;
    }

    public function getNumero_libre() {
        return $this->numero_libre;
    }

    public function setEncuesta_id($encuesta_id): void {
        $this->encuesta_id = $encuesta_id;
    }

    public function setPregunta_id($pregunta_id): void {
        $this->pregunta_id = $pregunta_id;
    }

    public function setTexto_libre($texto_libre): void {
        $this->texto_libre = $texto_libre;
    }

    public function setSi_no($si_no): void {
        $this->si_no = $si_no;
    }

    public function setOpciones($opciones): void {
        $this->opciones = $opciones;
    }

    public function setOpciones_select($opciones_select): void {
        $this->opciones_select = $opciones_select;
    }

    public function setNumero_libre($numero_libre): void {
        $this->numero_libre = $numero_libre;
    }

    public function getOtros() {
        return $this->otros;
    }

    public function setOtros($otros): void {
        $this->otros = $otros;
    }
    
    public function getOpciones_multiple() {
        return $this->opciones_multiple;
    }

    public function setOpciones_multiple($opciones_multiple): void {
        $this->opciones_multiple = $opciones_multiple;
    }


    
}
