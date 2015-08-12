<?php
abstract class DatabaseTable {
	abstract function table_name();
	abstract function fields();
	
	function primary_key() {
		return '';
	}
	
	function extra_keys() {
	  return '';
	}
	
	function engine() {
	  return 'InnoDB';
	}
	
	function charset() {
	  return 'utf8';
	}
	
	function collate() {
	  'utf8_unicode_ci';
	}
	
	function drop_table() {
		$sql = 'DROP TABLE `'.$this->table_name().'`';
	}
	
	function create_table() {
		$sql = 'CREATE TABLE `'.$this->table_name().'` (';
		$first = true;
		foreach (array_keys($this->fields()) as $f) {
			if (!$first) $sql .= ', ';
			else $first = false;
			$sql .=  "`$f` " . $this->fields()[$f];
		}
		if ($this->primary_key()) {
		  $sql .= ', PRIMARY KEY (';
		  if (is_array($this->primary_key())) {
		    $first = true;
		    foreach ($this->primary_key() as $key) {
		      if (!$first) $sql .= ', ';
			    else $first = false;
			    $sql .= "`$key`";
		    }
		  } else {
			  $sql .= '`'.$this->primary_key().'`';
		  }
		  $sql .= ')';
		}
		if ($this->extra_keys()) {
		  if (is_array($this->extra_keys())) {
		    foreach ($this->extra_keys() as $key) {
			    $sql .= ", $key";
		    }
		  } else {
			  $sql .= ', ' . $this->extra_keys();
		  }
		}
		$sql .= ') ENGINE='.$this->engine().' CHARSET='.$this->charset().';';
		return $sql;
	}
	
	function insert($record) {
		$sql = 'INSERT INTO `'.$this->table_name().'` SET ';
		$first = true;
		foreach (array_keys($record) as $f) {
		  if (array_key_exists($f, $this->fields())) {
  			if (!$first) $sql .= ', ';
  			else $first = false;
  			$sql .= "`$f`='".$record[$f]."'";
		  }
		}
		return $sql;
	}
}
