<?php

/*
 * Developed by wilowi
 */

final class preguntasModel extends baseModel {

    private $pregunta_id = 0;
    private $titulo = '';
    private $pregunta_tipo_id = 0;
    private $activar_otros = 0;
    private $num_select = 0;
    private $visible = 1;

    function __construct() {

        parent::__construct();
        parent::setTable('wi_preguntas');
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

        if (!empty($this->titulo)) {
            if ($first) {
                $indices .= "titulo";
                $valores .= "'" . $this->titulo . "'";
                $first = false;
            } else {
                $indices .= ",titulo";
                $valores .= ",'" . $this->titulo . "'";
            }
        }

        if (!empty($this->pregunta_tipo_id)) {
            if ($first) {
                $indices .= "pregunta_tipo_id";
                $valores .= "'" . $this->pregunta_tipo_id . "'";
                $first = false;
            } else {
                $indices .= ",pregunta_tipo_id";
                $valores .= ",'" . $this->pregunta_tipo_id . "'";
            }
        }

        if (!empty($this->activar_otros)) {
            if ($first) {
                $indices .= "activar_otros";
                $valores .= "'" . $this->activar_otros . "'";
                $first = false;
            } else {
                $indices .= ",activar_otros";
                $valores .= ",'" . $this->activar_otros . "'";
            }
        }

        if (!empty($this->num_select)) {
            if ($first) {
                $indices .= "num_select";
                $valores .= "'" . $this->num_select . "'";
                $first = false;
            } else {
                $indices .= ",num_select";
                $valores .= ",'" . $this->num_select . "'";
            }
        }
        
        if (!empty($this->visible)) {
            if ($first) {
                $indices .= "num_select";
                $valores .= $this->visible;
                $first = false;
            } else {
                $indices .= ",visible";
                $valores .= "," . $this->visible;
            }
        }

        return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

        $where = 'pregunta_id=' . $this->pregunta_id;
        $first = true;

        if (!empty($this->titulo)) {
            if ($first) {
                $campos .= " titulo='" . $this->titulo . "'";
                $first = false;
            } else {
                $campos .= ", titulo='" . $this->titulo . "'";
            }
        }

        if (!empty($this->pregunta_tipo_id)) {
            if ($first) {
                $campos .= " pregunta_tipo_id='" . $this->pregunta_tipo_id . "'";
                $first = false;
            } else {
                $campos .= ", pregunta_tipo_id='" . $this->pregunta_tipo_id . "'";
            }
        }

            if ($first) {
            $campos .= " activar_otros='" . $this->activar_otros . "'";
            $first = false;
        } else {
            $campos .= ", activar_otros='" . $this->activar_otros . "'";
        }

                  if (!empty($this->num_select)) {
	    if ($first) {
		$campos .= " num_select='" . $this->num_select . "'";
		$first = false;
	    } else {
		$campos .= ", num_select='" . $this->num_select . "'";
	    }
	}
        
        if (!empty($this->visible)) {
	    if ($first) {
		$campos .= " visible=" . $this->visible;
		$first = false;
	    } else {
		$campos .= ", visible=" . $this->visible;
	    }
	}
        
        return parent::update($campos, $where);
    }
    
    
    public function updateVisible() {

        $where = 'pregunta_id=' . $this->pregunta_id;

        $campos = " visible=" . $this->visible;
        return parent::update($campos, $where);
    }
    
    
    public function getPregunta_id() {
        return $this->pregunta_id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getPregunta_tipo_id() {
        return $this->pregunta_tipo_id;
    }

    public function getActivar_otros() {
        return $this->activar_otros;
    }

    public function getNum_select() {
        return $this->num_select;
    }

    public function setPregunta_id($pregunta_id): void {
        $this->pregunta_id = $pregunta_id;
    }

    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    public function setPregunta_tipo_id($pregunta_tipo_id): void {
        $this->pregunta_tipo_id = $pregunta_tipo_id;
    }

    public function setActivar_otros($activar_otros): void {
        $this->activar_otros = $activar_otros;
    }

    public function setNum_select($num_select): void {
        $this->num_select = $num_select;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible): void {
        $this->visible = $visible;
    }


    
}
