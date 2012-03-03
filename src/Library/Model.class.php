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
		
	function __set($name, $value) {
		$colname = strtolower($name);
		if($colname == "id" )
		{
			throw new SystemException("Setting model id is not allowed");
		}
		
		//Validate the data against the model
		Validators::Validate($this, $name, $value);
		
		/*	
		$funcname = $colname . "Validator";
		if(!method_exists($this, $funcname))
		{
			throw new SystemException("Required Validator ($funcname()) for property $colname not found in class " . get_class($this));	
		} 
		$this->$funcname($name, $value);
		*/
		$this->_redBean->$colname = $value;
	}
	
	
	function __get($name) {
		$colname = strtolower($name);
		return $this->_redBean->$colname;
	}
    
	/*function getValue($name)
	{
		$tbname = strtolower($name);
		return $this->$tbname;		
	}*/
	
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
	
	static public function GetAll()
	{
		$modelName = self::getModelName();
		
		$res = R::find($modelName);	    	
		
		$mRows = Array();			 			
		foreach($res as $r)
		{
			$mRows[$r->id] = new $modelName($r);
		}						
		return $mRows;									
	}
	
	public function Delete()
	{
		R::trash($this->_redBean);
	}
	
	static public function __callStatic($method,$arguments) 
	{
		$modelName = self::getModelName();
		
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
				throw new SystemException("Scalar lookup did not return exactly one row");
			}
			
			return new $modelName(array_shift($res));			
		}
		elseif (Utils::StartsWith($method,"GetRowsBy")) 
		{
			$getby = strtolower(substr($method,9));					
			$res = R::find($modelName, "$getby IN (" . R::genSlots($arguments) . ") " , $arguments);	    	
			
			$mRows = Array();			 			
			foreach($res as $r)
			{
				$mRows[$r->id] = new $modelName($r);
			}						
			return $mRows;									
		}
		else 
		{
			return false;
		}
	}  
}
