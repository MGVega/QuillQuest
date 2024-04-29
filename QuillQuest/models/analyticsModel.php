<?php

/*
 * Developed by wilowi
 */
final class analyticsModel extends baseModel {

    private $dato_id = 0;
    private $visitas_principal = 0;
    private $visitas_rutas = 0;
    private $visitas_encuesta = 0;

    
    function __construct() {

        parent::__construct();
        parent::setTable('wi_analytics');
    }

    public function select($where = '', $as = '', $select = '*', $join = '') {
        return parent::select($where, $as, $select, $join);
    }

    public function update($campos = '', $where = '') {
        $first = true;
        
        if (!empty($this->visitas_principal)) {
            if ($first) {
                $campos .= " visitas_principal=" . $this->visitas_principal;
                $first = false;
            } else {
                $campos .= ", visitas_principal=" . $this->visitas_principal;
            }
        }
        
        if (!empty($this->visitas_rutas)) {
            if ($first) {
                $campos .= " visitas_rutas=" . $this->visitas_rutas;
                $first = false;
            } else {
                $campos .= ", visitas_rutas=" . $this->visitas_rutas;
            }
        }
        
        if (!empty($this->visitas_encuesta)) {
            if ($first) {
                $campos .= " visitas_encuesta=" . $this->visitas_encuesta;
                $first = false;
            } else {
                $campos .= ", visitas_encuesta=" . $this->visitas_encuesta;
            }
        }
        
        return parent::update($campos, $where);
    }

    public function getDato_id() {
        return $this->dato_id;
    }

    public function getVisitas_principal() {
        return $this->visitas_principal;
    }

    public function setDato_id($dato_id): void {
        $this->dato_id = $dato_id;
    }

    public function setVisitas_principal($visitas_principal): void {
        $this->visitas_principal = $visitas_principal;
    }

    public function getVisitas_rutas() {
        return $this->visitas_rutas;
    }

    public function getVisitas_encuesta() {
        return $this->visitas_encuesta;
    }

    public function setVisitas_rutas($visitas_rutas): void {
        $this->visitas_rutas = $visitas_rutas;
    }

    public function setVisitas_encuesta($visitas_encuesta): void {
        $this->visitas_encuesta = $visitas_encuesta;
    }

}