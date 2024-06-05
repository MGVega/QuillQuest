<?php

/*
 * Developed by wilowi
 */

final class historiasModel extends baseModel {

    private $historia_id = 0;
    private $titulo = '';
    private $historia_genero_id = 0;
    private $portada = '';
    private $sinopsis = '';
    private $autor_id = 0;
    private $visible = 0;

    function __construct() {

        parent::__construct();
        parent::setTable('wi_historias');
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
        
        if (!empty($this->historia_genero_id)) {
            if ($first) {
                $indices .= "historia_genero_id";
                $valores .= $this->historia_genero_id;
                $first = false;
            } else {
                $indices .= ",historia_genero_id";
                $valores .= "," . $this->historia_genero_id;
            }
        }

        if (!empty($this->portada)) {
            if ($first) {
                $indices .= "portada";
                $valores .= "'" . $this->portada . "'";
                $first = false;
            } else {
                $indices .= ",portada";
                $valores .= ",'" . $this->portada . "'";
            }
        }

        if (!empty($this->sinopsis)) {
            if ($first) {
                $indices .= "sinopsis";
                $valores .= "'" . $this->sinopsis . "'";
                $first = false;
            } else {
                $indices .= ",sinopsis";
                $valores .= ",'" . $this->sinopsis . "'";
            }
        }
        
        if (!empty($this->autor_id)) {
            if ($first) {
                $indices .= "autor_id";
                $valores .= $this->autor_id;
                $first = false;
            } else {
                $indices .= ",autor_id";
                $valores .= "," . $this->autor_id;
            }
        }

        return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

        $where = 'historia_id=' . $this->historia_id;
        $first = true;

        if (!empty($this->titulo)) {
            if ($first) {
                $campos .= " titulo='" . $this->titulo . "'";
                $first = false;
            } else {
                $campos .= ", titulo='" . $this->titulo . "'";
            }
        }


        if (!empty($this->historia_genero_id)) {
            if ($first) {
                $campos .= " historia_genero_id=" . $this->historia_genero_id;
                $first = false;
            } else {
                $campos .= ", historia_genero_id=" . $this->historia_genero_id;
            }
        }

        if (!empty($this->portada)) {
            if ($first) {
                $campos .= " portada='" . $this->portada . "'";
                $first = false;
            } else {
                $campos .= ", portada='" . $this->portada . "'";
            }
        }

        if (!empty($this->sinopsis)) {
            if ($first) {
                $campos .= " sinopsis='" . $this->sinopsis . "'";
                $first = false;
            } else {
                $campos .= ", sinopsis='" . $this->sinopsis . "'";
            }
        }


        if (!empty($this->autor_id)) {
            if ($first) {
                $campos .= " autor_id=" . $this->autor_id;
                $first = false;
            } else {
                $campos .= ", autor_id=" . $this->autor_id;
            }
        }
        
        return parent::update($campos, $where);
    }
    
    public function updateVisible() {

        $where = 'historia_id=' . $this->historia_id;

        $campos = " visible=" . $this->visible;
        return parent::update($campos, $where);
    }
    
    public function getHistoria_id() {
        return $this->historia_id;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getHistoria_genero_id() {
        return $this->historia_genero_id;
    }

    public function getPortada() {
        return $this->portada;
    }

    public function getSinopsis() {
        return $this->sinopsis;
    }

    public function setHistoria_id($historia_id): void {
        $this->historia_id = $historia_id;
    }

    public function setTitulo($titulo): void {
        $this->titulo = $titulo;
    }

    public function setHistoria_genero_id($historia_genero_id): void {
        $this->historia_genero_id = $historia_genero_id;
    }

    public function setPortada($portada): void {
        $this->portada = $portada;
    }

    public function setSinopsis($sinopsis): void {
        $this->sinopsis = $sinopsis;
    }
    
    public function getAutor_id() {
        return $this->autor_id;
    }

    public function setAutor_id($autor_id): void {
        $this->autor_id = $autor_id;
    }

    public function getVisible() {
        return $this->visible;
    }

    public function setVisible($visible): void {
        $this->visible = $visible;
    }


    
}
