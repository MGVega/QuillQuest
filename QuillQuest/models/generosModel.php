<?php

/* 
 * Developed by wilowi
 */
final class generosModel extends baseModel {

    private $genero_id = 0;
    private $nombre_genero = '';
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_generos');
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

	if (!empty($this->nombre_genero)) {
	    if ($first) {
		$indices .= "nombre_genero";
		$valores .= "'" . $this->nombre_genero . "'";
		$first = false;
	    } else {
		$indices .= ",nombre_genero";
		$valores .= ",'" . $this->nombre_genero . "'";
	    }
	}
        
	return parent::add($indices, $valores);
         }
             
    public function update($campos = '', $where = '') {

	$where = 'genero_id=' . $this->genero_id;
	$first = true;

	if (!empty($this->nombre_genero)) {
	    if ($first) {
		$campos .= " nombre_genero='" . $this->nombre_genero . "'";
		$first = false;
	    } else {
		$campos .= ", nombre_genero='" . $this->nombre_genero . "'";
	    }
	}
        
                return parent::update($campos, $where);
         }
         
         public function getGenero_id() {
             return $this->genero_id;
         }

         public function getNombre_genero() {
             return $this->nombre_genero;
         }

         public function setGenero_id($genero_id): void {
             $this->genero_id = $genero_id;
         }

         public function setNombre_genero($nombre_genero): void {
             $this->nombre_genero = $nombre_genero;
         }
         
}
