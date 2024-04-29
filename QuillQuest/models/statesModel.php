<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of statesModel
 *
 * @author Sandra
 */
final class statesModel extends baseModel{
    
    
    
    function __construct() {

	parent::__construct();
	parent::setTable('wi_states');
    }

    public function select($where = '', $as = '', $select = '*', $join = '') {
	return parent::select($where, $as, $select, $join);
    }
    
}
