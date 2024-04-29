<?php

/* 
 * Developed by wilowi
 */
final class selectModel extends baseModel {

    private $select_id = 0;
    private $nombre = '';
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_select');
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
        
	return parent::add($indices, $valores);
         }
             
    public function update($campos = '', $where = '') {

	$where = 'select_id=' . $this->select_id;
	$first = true;

	if (!empty($this->nombre)) {
	    if ($first) {
		$campos .= " nombre='" . $this->nombre . "'";
		$first = false;
	    } else {
		$campos .= ", nombre='" . $this->nombre . "'";
	    }
	}
        
                return parent::update($campos, $where);
         }
         
         public function getSelect_id() {
             return $this->select_id;
         }

         public function getNombre() {
             return $this->nombre;
         }

         public function setSelect_id($select_id): void {
             $this->select_id = $select_id;
         }

         public function setNombre($nombre): void {
             $this->nombre = $nombre;
         }


         
         
}
