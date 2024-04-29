<?php

/* 
 * Developed by wilowi
 */
final class preguntasOpcionesModel extends baseModel {

    private $opcion_id = 0;
    private $pregunta_id = 0;
    private $nombre = '';
    private $orden = 0;
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_preguntas_opciones');
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
        
                  if (!empty($this->nombre)) {
	    if ($first) {
		$indices .= "nombre";
		$valores .= "'" . $this->nombre . "'";
		$first = false;
	    } else {
		$indices .= ",nombre";
		$valores .= ",'" . $this->nombre . "'";
	    }
	}
        
	if (!empty($this->orden)) {
	    if ($first) {
		$indices .= "orden";
		$valores .= "'" . $this->orden . "'";
		$first = false;
	    } else {
		$indices .= ",orden";
		$valores .= ",'" . $this->orden . "'";
	    }
	}
        
	return parent::add($indices, $valores);
    }
    
    public function update($campos = '', $where = '') {

	$where = 'opcion_id=' . $this->opcion_id;
	$first = true;

	if (!empty($this->pregunta_id)) {
	    if ($first) {
		$campos .= " pregunta_id='" . $this->pregunta_id . "'";
		$first = false;
	    } else {
		$campos .= ", pregunta_id='" . $this->pregunta_id . "'";
	    }
	}
	
	if (!empty($this->nombre)) {
	    if ($first) {
		$campos .= " nombre='" . $this->nombre . "'";
		$first = false;
	    } else {
		$campos .= ", nombre='" . $this->nombre . "'";
	    }
	}
	
	if (!empty($this->orden)) {
	    if ($first) {
		$campos .= " orden='" . $this->orden . "'";
		$first = false;
	    } else {
		$campos .= ", orden='" . $this->orden . "'";
	    }
	}
	
        return parent::update($campos, $where);
    }
    
    public function getOpcion_id() {
        return $this->opcion_id;
    }

    public function getPregunta_id() {
        return $this->pregunta_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getOrden() {
        return $this->orden;
    }

    public function setOpcion_id($opcion_id): void {
        $this->opcion_id = $opcion_id;
    }

    public function setPregunta_id($pregunta_id): void {
        $this->pregunta_id = $pregunta_id;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setOrden($orden): void {
        $this->orden = $orden;
    }


}
