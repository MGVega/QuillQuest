<?php

/* 
 * Developed by wilowi
 */
final class preguntasSelectModel extends baseModel {

    private $pregunta_id = 0;
    private $select_id = 0;
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_preguntas_select');
    }

    public function select($where = '', $as = '', $select = '*', $join = '') {
	return parent::select($where, $as, $select, $join);
    }
    
    public function selectPagination($where = '', $join = '', $order = '', $limit = '', $select = '*',$group='') {
	return parent::selectPagination($where, $join, $order, $limit, $select,$group);
    }

    public function delete($where) {
	return parent::delete($where);
    }
    
    public function add($indices = '', $valores = '') {

	$first = true;

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
        
	return parent::add($indices, $valores);
    }
    
    public function update($campos = '', $where = '') {

	$where = 'pregunta_id=' . $this->pregunta_id;
	$first = true;

	if (!empty($this->pregunta_id)) {
	    if ($first) {
		$campos .= " pregunta_id='" . $this->pregunta_id . "'";
		$first = false;
	    } else {
		$campos .= ", pregunta_id='" . $this->pregunta_id . "'";
	    }
	}
	
	if (!empty($this->select_id)) {
	    if ($first) {
		$campos .= " select_id='" . $this->select_id . "'";
		$first = false;
	    } else {
		$campos .= ", select_id='" . $this->select_id . "'";
	    }
	}
        
        return parent::update($campos, $where);
    }
    
    
    public function getPregunta_id() {
        return $this->pregunta_id;
    }

    public function getSelect_id() {
        return $this->select_id;
    }

    public function setPregunta_id($pregunta_id): void {
        $this->pregunta_id = $pregunta_id;
    }

    public function setSelect_id($select_id): void {
        $this->select_id = $select_id;
    }


}
