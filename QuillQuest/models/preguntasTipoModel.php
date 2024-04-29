<?php

/*
 * Developed by wilowi
 */

final class preguntasTipoModel extends baseModel {

    private $pregunta_tipo_id = 0;
    private $nombre_tipo = '';

    function __construct() {

        parent::__construct();
        parent::setTable('wi_preguntas_tipo');
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

        if (!empty($this->nombre_tipo)) {
            if ($first) {
                $indices .= "nombre_tipo";
                $valores .= "'" . $this->nombre_tipo . "'";
                $first = false;
            } else {
                $indices .= ",nombre_tipo";
                $valores .= ",'" . $this->nombre_tipo . "'";
            }
        }

        return parent::add($indices, $valores);
    }

    public function update($campos = '', $where = '') {

        $where = 'pregunta_tipo_id=' . $this->pregunta_tipo_id;
        $first = true;

        if (!empty($this->nombre_tipo)) {
            if ($first) {
                $campos .= " nombre_tipo='" . $this->nombre_tipo . "'";
                $first = false;
            } else {
                $campos .= ", nombre_tipo='" . $this->nombre_tipo . "'";
            }
        }

        return parent::update($campos, $where);
    }

    public function getPregunta_tipo_id() {
        return $this->pregunta_tipo_id;
    }

    public function getNombre_tipo() {
        return $this->nombre_tipo;
    }

    public function setPregunta_tipo_id($pregunta_tipo_id): void {
        $this->pregunta_tipo_id = $pregunta_tipo_id;
    }

    public function setNombre_tipo($nombre_tipo): void {
        $this->nombre_tipo = $nombre_tipo;
    }

}
