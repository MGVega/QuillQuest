<?php

/*
 * Developed by wilowi
 */

final class eleccionesModel extends baseModel {

    private $eleccion_id = 0;
    private $pagina_id = 0;
    private $texto = '';
    private $pagina_destino_id = 0;
    private $historia_id = 0;

    function __construct() {

        parent::__construct();
        parent::setTable('wi_elecciones');
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
        
        if (!empty($this->pagina_id)) {
            if ($first) {
                $indices .= "pagina_id";
                $valores .= $this->pagina_id;
                $first = false;
            } else {
                $indices .= ",pagina_id";
                $valores .= "," . $this->pagina_id;
            }
        }

        if (!empty($this->texto)) {
            if ($first) {
                $indices .= "texto";
                $valores .= "'" . $this->texto . "'";
                $first = false;
            } else {
                $indices .= ",texto";
                $valores .= ",'" . $this->texto . "'";
            }
        }
        
        if (!empty($this->pagina_destino_id)) {
            if ($first) {
                $indices .= "pagina_destino_id";
                $valores .= $this->pagina_destino_id;
                $first = false;
            } else {
                $indices .= ",pagina_destino_id";
                $valores .= "," . $this->pagina_destino_id;
            }
        }
        
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

        return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

        $where = 'eleccion_id=' . $this->eleccion_id;
        $first = true;

        if (!empty($this->pagina_id)) {
            if ($first) {
                $campos .= " pagina_id=" . $this->pagina_id;
                $first = false;
            } else {
                $campos .= ", pagina_id=" . $this->pagina_id;
            }
        }

        if (!empty($this->texto)) {
            if ($first) {
                $campos .= " texto='" . $this->texto . "'";
                $first = false;
            } else {
                $campos .= ", texto='" . $this->texto . "'";
            }
        }

        if (!empty($this->pagina_destino_id)) {
            if ($first) {
                $campos .= " pagina_destino_id=" . $this->pagina_destino_id;
                $first = false;
            } else {
                $campos .= ", pagina_destino_id=" . $this->pagina_destino_id;
            }
        }

        if (!empty($this->historia_id)) {
            if ($first) {
                $campos .= " historia_id=" . $this->historia_id;
                $first = false;
            } else {
                $campos .= ", historia_id=" . $this->historia_id;
            }
        }
        
        return parent::update($campos, $where);
    }

    public function getEleccion_id() {
        return $this->eleccion_id;
    }

    public function getPagina_id() {
        return $this->pagina_id;
    }

    public function getTexto() {
        return $this->texto;
    }

    public function getPagina_destino_id() {
        return $this->pagina_destino_id;
    }

    public function setEleccion_id($eleccion_id): void {
        $this->eleccion_id = $eleccion_id;
    }

    public function setPagina_id($pagina_id): void {
        $this->pagina_id = $pagina_id;
    }

    public function setTexto($texto): void {
        $this->texto = $texto;
    }

    public function setPagina_destino_id($pagina_destino_id): void {
        $this->pagina_destino_id = $pagina_destino_id;
    }
    
    public function getHistoria_id() {
        return $this->historia_id;
    }

    public function setHistoria_id($historia_id): void {
        $this->historia_id = $historia_id;
    }


    
}
