<?php
abstract class DatabaseTable {
	abstract function table_name();
	abstract function fields();		
	
	function primary_key() {
		return '';
	}
	
	function drop_table() {
		$sql = 'DROP TABLE '.$this->table_name();
	}
	
	function create_table() {
		$sql = 'CREATE TABLE `'.$this->table_name().'` (';
		$first = true;
		foreach (array_keys($this->fields()) as $f) {
			if (!$first) $sql .= ', ';
			else $first = false;
			$sql .=  "`$f` " . $this->fields()[$f];
		}
		if (!empty($this->primary_key())) {
			$sql .= ", PRIMARY KEY (`{$this->primary_key()}`)";
		}
		$sql .= ')';
		return $sql;
	}
	
	function insert($record) {
		$sql = 'INSERT INTO `'.$this->table_name().'` SET ';
		$first = true;
		foreach (array_keys($this->fields()) as $f) {
			if (!$first) $sql .= ', ';
			else $first = false;
			$sql .= "`$f`='{$record['$f']}'";
		}
		return $sql;
	}
}