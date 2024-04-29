<?php

/*
 * Developed by wilowi
 */

final class rutasModel extends baseModel {

    private $ruta_id = 0;
    private $titulo = '';
    private $descripcion = '';
    private $imagen = '';
    private $link_descarga = '';
    private $dificultad = 0;
    private $km = 0;
    private $tipo_ruta = 0;
    private $descargas = 0;
    private $visualizaciones = 0;
    private $center_lat = '';
    private $center_lon = '';

    function __construct() {

        parent::__construct();
        parent::setTable('wi_rutas');
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

        if (!empty($this->descripcion)) {
            if ($first) {
                $indices .= "descripcion";
                $valores .= "'" . $this->descripcion . "'";
                $first = false;
            } else {
                $indices .= ",descripcion";
                $valores .= ",'" . $this->descripcion . "'";
            }
        }

        if (!empty($this->imagen)) {
            if ($first) {
                $indices .= "imagen";
                $valores .= "'" . $this->imagen . "'";
                $first = false;
            } else {
                $indices .= ",imagen";
                $valores .= ",'" . $this->imagen . "'";
            }
        }

        if (!empty($this->link_descarga)) {
            if ($first) {
                $indices .= "link_descarga";
                $valores .= "'" . $this->link_descarga . "'";
                $first = false;
            } else {
                $indices .= ",link_descarga";
                $valores .= ",'" . $this->link_descarga . "'";
            }
        }


        if (!empty($this->dificultad)) {
            if ($first) {
                $indices .= "dificultad";
                $valores .= $this->dificultad;
                $first = false;
            } else {
                $indices .= ",dificultad";
                $valores .= "," . $this->dificultad;
            }
        }

        if (!empty($this->km)) {
            if ($first) {
                $indices .= "km";
                $valores .= $this->km;
                $first = false;
            } else {
                $indices .= ",km";
                $valores .= "," . $this->km;
            }
        }

        if (!empty($this->tipo_ruta)) {
            if ($first) {
                $indices .= "tipo_ruta";
                $valores .= "'" . $this->tipo_ruta . "'";
                $first = false;
            } else {
                $indices .= ",tipo_ruta";
                $valores .= ",'" . $this->tipo_ruta . "'";
            }
        }

        if (!empty($this->descargas)) {
            if ($first) {
                $indices .= "descargas";
                $valores .= "'" . $this->descargas . "'";
                $first = false;
            } else {
                $indices .= ",descargas";
                $valores .= ",'" . $this->descargas . "'";
            }
        }



        if (!empty($this->visualizaciones)) {
            if ($first) {
                $indices .= "visualizaciones";
                $valores .= $this->visualizaciones;
                $first = false;
            } else {
                $indices .= ",visualizaciones";
                $valores .= "," . $this->visualizaciones;
            }
        }
        
        if (!empty($this->center_lat)) {
	    if ($first) {
		$indices .= "center_lat";
		$valores .= "'" . $this->center_lat . "'";
		$first = false;
	    } else {
		$indices .= ",center_lat";
		$valores .= ",'" . $this->center_lat . "'";
	    }
	}
        
        if (!empty($this->center_lon)) {
	    if ($first) {
		$indices .= "center_lon";
		$valores .= "'" . $this->center_lon . "'";
		$first = false;
	    } else {
		$indices .= ",center_lon";
		$valores .= ",'" . $this->center_lon . "'";
	    }
	}

        return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

        $where = 'ruta_id=' . $this->ruta_id;
        $first = true;

        if (!empty($this->titulo)) {
            if ($first) {
                $campos .= " titulo='" . $this->titulo . "'";
                $first = false;
            } else {
                $campos .= ", titulo='" . $this->titulo . "'";
            }
        }

        if (!empty($this->descripcion)) {
            if ($first) {
                $campos .= " descripcion='" . $this->descripcion . "'";
                $first = false;
            } else {
                $campos .= ", descripcion='" . $this->descripcion . "'";
            }
        }

        if (!empty($this->imagen)) {
            if ($first) {
                $campos .= " imagen='" . $this->imagen . "'";
                $first = false;
            } else {
                $campos .= ", imagen='" . $this->imagen . "'";
            }
        }

        if (!empty($this->link_descarga)) {
            if ($first) {
                $campos .= " link_descarga='" . $this->link_descarga . "'";
                $first = false;
            } else {
                $campos .= ", link_descarga='" . $this->link_descarga . "'";
            }
        }


        if (!empty($this->dificultad)) {
            if ($first) {
                $campos .= " dificultad=" . $this->dificultad;
                $first = false;
            } else {
                $campos .= ", dificultad=" . $this->dificultad;
            }
        }

        if (!empty($this->km)) {
            if ($first) {
                $campos .= " km=" . $this->km;
                $first = false;
            } else {
                $campos .= ", km=" . $this->km;
            }
        }

        if (!empty($this->tipo_ruta)) {
            if ($first) {
                $campos .= " tipo_ruta=$this->tipo_ruta";
                $first = false;
            } else {
                $campos .= ", tipo_ruta=$this->tipo_ruta";
            }
        }

        if (!empty($this->descargas)) {
            if ($first) {
                $campos .= " descargas='" . $this->descargas . "'";
                $first = false;
            } else {
                $campos .= ", descargas='" . $this->descargas . "'";
            }
        }

        if (!empty($this->visualizaciones)) {
            if ($first) {
                $campos .= " visualizaciones='" . $this->visualizaciones . "'";
                $first = false;
            } else {
                $campos .= ", visualizaciones='" . $this->visualizaciones . "'";
            }
        }
        
        if (!empty($this->center_lat)) {
            if ($first) {
                $campos .= " center_lat='" . $this->center_lat . "'";
                $first = false;
            } else {
                $campos .= ", center_lat='" . $this->center_lat . "'";
            }
        }
        
        if (!empty($this->center_lon)) {
            if ($first) {
                $campos .= " center_lon='" . $this->center_lon . "'";
                $first = false;
            } else {
                $campos .= ", center_lon='" . $this->center_lon . "'";
            }
        }
        
        
        return parent::update($campos, $where);
    }
    
    
     public function updateLatLon($campos = '', $where = '') {

        $where = 'ruta_id=' . $this->ruta_id;
        $first = true;

        if (!empty($this->center_lat)) {
            if ($first) {
                $campos .= " center_lat='" . $this->center_lat . "'";
                $first = false;
            } else {
                $campos .= ", center_lat='" . $this->center_lat . "'";
            }
        }
        
        if (!empty($this->center_lon)) {
            if ($first) {
                $campos .= " center_lon='" . $this->center_lon . "'";
                $first = false;
            } else {
                $campos .= ", center_lon='" . $this->center_lon . "'";
            }
        }
        
        
        return parent::update($campos, $where);
    }

    public function getRuta_id() {
        return $this->ruta_id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getImage() {
        return $this->imagen;
    }

    public function getLink_descarga() {
        return $this->link_descarga;
    }

    public function getDificultad() {
        return $this->dificultad;
    }

    public function getKm() {
        return $this->km;
    }

    public function getTipo_ruta() {
        return $this->tipo_ruta;
    }

    public function getDescargas() {
        return $this->descargas;
    }

    public function getVisualizaciones() {
        return $this->visualizaciones;
    }

    public function setRuta_id($ruta_id): void {
        $this->ruta_id = $ruta_id;
    }

    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setImage($image): void {
        $this->imagen = $image;
    }

    public function setLink_descarga($link_descarga): void {
        $this->link_descarga = $link_descarga;
    }

    public function setDificultad($dificultad): void {
        $this->dificultad = $dificultad;
    }

    public function setKm($km): void {
        $this->km = $km;
    }

    public function setTipo_ruta($tipo_ruta): void {
        $this->tipo_ruta = $tipo_ruta;
    }

    public function setDescargas($descargas): void {
        $this->descargas = $descargas;
    }

    public function setVisualizaciones($visualizaciones): void {
        $this->visualizaciones = $visualizaciones;
    }
    
    public function getImagen() {
        return $this->imagen;
    }

    public function getCenter_lat() {
        return $this->center_lat;
    }

    public function getCenter_lon() {
        return $this->center_lon;
    }

    public function setImagen($imagen): void {
        $this->imagen = $imagen;
    }

    public function setCenter_lat($center_lat): void {
        $this->center_lat = $center_lat;
    }

    public function setCenter_lon($center_lon): void {
        $this->center_lon = $center_lon;
    }



}
