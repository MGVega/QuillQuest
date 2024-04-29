<?php

/* 
 * Developed by wilowi
 */

class baseModel{
	
	protected $connector = null;
	protected $errorInfo = '';
	protected $table = '';
	
	protected function __construct() {
		$this->connector = new dbConnector();
	}
	
	protected function select($where = '',$as = '',$select = '*',$join=''){
		
		$query = 'SELECT '.$select.' FROM '.$this->table.' '.$as.' '.$join;
		
		if(!empty($where)){
			$query.= ' WHERE '.$where;
		}

		//echo $query;
		$result = $this->connector->query($query, 'select');

		return $result;
	}
	
	protected function selectPagination($where = '',$join='',$order = '',$limit = '', $select='*'){
		
		$query = 'SELECT '.$select.' FROM '.$this->table.' '.$join;
		
		if(!empty($where)){
			$query.= ' WHERE '.$where;
		}
		
		if(!empty($order)){
			$query.= ' ORDER BY '.$order;
		}
		
		if(!empty($limit)){
			$query.=' LIMIT '.$limit;
		}
		
		//echo $query;
		$result = $this->connector->query($query, 'select');
		
		//$numero = count($result);

		return $result;
	}
	
	protected function add($indices,$values){
		
		$query = 'INSERT INTO '.$this->table.' ( '.$indices.') VALUES('.$values.')';

		//echo $query;
		$result = $this->connector->query($query, 'insert');

		return $result;
		
	}
	
	protected function update($campos,$where=''){
		
		$query = 'UPDATE '.$this->table.' SET '.$campos;
                
		if(!empty($where)){
			$query.= ' WHERE '.$where;
		}
	
		//echo $query;
		$result = $this->connector->query($query, 'update');

		return $result;
	}
	
	
	protected function delete($where){
		
		$query = 'DELETE FROM '.$this->table.' WHERE '.$where;

                if(!empty($where)){
                    $result = $this->connector->query($query, 'delete');
                }
		
		return $result;
		
	}	
	
	protected function setTable($table){
		$this->table = $table;
	}
	
	protected function escapeChar($cadena){
	    
	    return $this->connector->escapeChar($cadena);
	    
	}
	
}


?>
