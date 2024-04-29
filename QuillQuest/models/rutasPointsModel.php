<?php

/*
 * Developed by wilowi
 */

final class rutasPointsModel extends baseModel {

    private $ruta_id = 0;
    private $title = '';
    private $lat = '';
    private $lon = '';

    function __construct() {

        parent::__construct();
        parent::setTable('wi_rutas_points');
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

        if (!empty($this->title)) {
            if ($first) {
                $indices .= "title";
                $valores .= "'" . $this->title . "'";
                $first = false;
            } else {
                $indices .= ",title";
                $valores .= ",'" . $this->title . "'";
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

	if (!empty($this->title)) {
	    if ($first) {
		$campos .= " title='" . $this->title . "'";
		$first = false;
	    } else {
		$campos .= ", title='" . $this->title . "'";
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

        if (!empty($this->lat)) {
            if ($first) {
                $campos .= " lat='" . $this->lat . "'";
                $first = false;
            } else {
                $campos .= ", lat='" . $this->lat . "'";
            }
        }


        return parent::update($campos, $where);
    }

    public function getRuta_id() {
        return $this->ruta_id;
    }

    public function getTitle() {
        return $this->title;
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

    public function setTitle($title): void {
        $this->title = $title;
    }

    public function setLat($lat): void {
        $this->lat = $lat;
    }

    public function setLon($lon): void {
        $this->lon = $lon;
    }



}
