<?php

// Base Model Implementation with RedBean
class Model 
{
	static protected $_model = NULL;
	private $_redBean;
	static protected $_table = NULL;
	protected $id;

	// Functions that operate on an instance of a bean (one row of a table)
	function __construct() {
		self::$_model = get_class($this);
		
		if(self::$_table == NULL)
		{
			self::$_table = strtolower(self::$_model);
		}
		
		if(func_num_args() == 1) 
		{
			// If an argument is passed in to the constructor, it should be an existing RedBean
			$this->_redBean = func_get_arg(0);			
		}
		else 
		{
			// Otherwise we create a new empty RedBean			
			$this->_redBean = R::dispense(self::$_table);
		}
		
	}
	
	function Id(){
		return $this->id;
	}
	
	
	function __set($name, $value) {
		$tbname = strtolower($name);
		$this->_redBean->$tbname = $value;
	}
	
	
	function __get($name) {
		$tbname = strtolower($name);
		return $this->_redBean->$tbname;
	}
    
	function getValue($name)
	{
		$tbname = strtolower($name);
		return $this->$tbname;		
	}
	
	function save()
	{
		$this->id = R::store($this->_redBean);
		return $this->id;
	}

	function __destruct() {
	}
	
	// Functions that work with collections of beans (many rows from the table)
	static function getModelName()
	{
		if(self::$_model == NULL)
		{
			self::$_model = get_class($this);
		}
		return self::$_model;
	}
	
	static function getTableName()
	{
		if(self::$_table == NULL)
		{
			self::$_table = strtolower(getModelName());
		}
		return self::$_table;
	}
	
	static public function __callStatic($method,$arguments) 
	{
		$modelName = self::getModelName();
		$tableName = self::getTableName();
		
		if(Utils::StartsWith($method,"GetRowBy"))
		{			
			$getby = strtolower(substr($method,8));
		
	    	$res = R::find($modelName, "$getby = ?", $arguments);
			
			// if we didn't find anything, return an empty array
			if(empty($res))
			{
				return Array();
			}
			
			if(sizeof($res) != 1)
			{
				die("Scalar lookup did not return exactly one row");
			}
			
			return new $modelName($res);
		}
		elseif (Utils::StartsWith($method,"GetRowsBy")) 
		{
			die("Not implemented");			
		}
		else 
		{
			return false;
		}
	}  
}
