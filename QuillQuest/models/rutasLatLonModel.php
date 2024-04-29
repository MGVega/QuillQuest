<?php

/* 
 * Developed by wilowi
 */
final class rutasLatLonModel extends baseModel {

    private $ruta_id = 0;
    private $lat = '';
    private $lon = '';

    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_rutas_latlon');
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

        if (!empty($this->lat)) {
            if ($first) {
                $indices .= "lat";
                $valores .= "'" . $this->lat . "'";
                $first = false;
            } else {
                $indices .= ",lat";
                $valores .= ",'" . $this->lat . "'";
            }
        }

        if (!empty($this->lon)) {
            if ($first) {
                $indices .= "lon";
                $valores .= "'" . $this->lon . "'";
                $first = false;
            } else {
                $indices .= ",lon";
                $valores .= ",'" . $this->lon . "'";
            }
        }

        if (!empty($this->ruta_id)) {
            if ($first) {
                $indices .= "ruta_id";
                $valores .= $this->ruta_id;
                $first = false;
            } else {
                $indices .= ",ruta_id";
                $valores .= "," . $this->ruta_id;
            }
        }


        return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

        $where = 'ruta_id=' . $this->ruta_id;
        $first = true;

        if (!empty($this->lat)) {
            if ($first) {
                $campos .= " lat='" . $this->lat . "'";
                $first = false;
            } else {
                $campos .= ", lat='" . $this->lat . "'";
            }
        }

        if (!empty($this->lon)) {
            if ($first) {
                $campos .= " lon='" . $this->lon . "'";
                $first = false;
            } else {
                $campos .= ", lon='" . $this->lon . "'";
            }
        }


        return parent::update($campos, $where);
    }

    
    public function getRuta_id() {
        return $this->ruta_id;
    }

    public function getLat() {
        return $this->lat;
    }

    public function getLon() {
        return $this->lon;
    }

    public function setRuta_id($ruta_id): void {
        $this->ruta_id = $ruta_id;
    }

    public function setLat($lat): void {
        $this->lat = $lat;
    }

    public function setLon($lon): void {
        $this->lon = $lon;
    }



}
