<?php

/*
 * Developed by wilowi
 */

final class paginasModel extends baseModel {

    private $pagina_id = 0;
    private $historia_id = 0;
    private $contenido = '';

    function __construct() {

        parent::__construct();
        parent::setTable('wi_paginas');
    }

    public function select($where = '', $as = '', $select = '*', $join = '') {
        return parent::select($where, $as, $select, $join);
    }

    public function selectPagination($where = '', $join = '', $order = '', $limit = '', $select = '*', $group = '') {
        return parent::selectPagination($where, $join, $order, $limit, $select, $group);
    }

    public function delete($where) {
        return parent::delete($where);
    }

    public function add($indices = '', $valores = '') {

        $first = true;
        
        if (!empty($this->historia_id)) {
            if ($first) {
                $indices .= "historia_id";
                $valores .= $this->historia_id;
                $first = false;
            } else {
                $indices .= ",historia_id";
                $valores .= "," . $this->historia_id;
            }
        }

        if (!empty($this->contenido)) {
            if ($first) {
                $indices .= "contenido";
                $valores .= "'" . $this->contenido . "'";
                $first = false;
            } else {
                $indices .= ",contenido";
                $valores .= ",'" . $this->contenido . "'";
            }
        }

        return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

        $where = 'pagina_id=' . $this->pagina_id;
        $first = true;


        if (!empty($this->historia_id)) {
            if ($first) {
                $campos .= " historia_id=" . $this->historia_id;
                $first = false;
            } else {
                $campos .= ", historia_id=" . $this->historia_id;
            }
        }

        if (!empty($this->contenido)) {
            if ($first) {
                $campos .= " contenido='" . $this->contenido . "'";
                $first = false;
            } else {
                $campos .= ", contenido='" . $this->contenido . "'";
            }
        }
        
        return parent::update($campos, $where);
    }

    public function getPagina_id() {
        return $this->pagina_id;
    }

    public function getHistoria_id() {
        return $this->historia_id;
    }

    public function getContenido() {
        return $this->contenido;
    }

    public function setPagina_id($pagina_id): void {
        $this->pagina_id = $pagina_id;
    }

    public function setHistoria_id($historia_id): void {
        $this->historia_id = $historia_id;
    }

    public function setContenido($contenido): void {
        $this->contenido = $contenido;
    }


    
}
