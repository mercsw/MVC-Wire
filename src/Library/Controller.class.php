<?php
use Diagnostics as dd;
class Controller {
	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;
	static protected $_path;

	function __construct($model, $controller, $action) {				
		$this->_controller = $controller;
		$this->_action = $action;
		$this->_model = $model;

		$this->$model = new $model;
		$this->_template = new Template($controller,$action);
		self::$_path =  "/$controller";

	}
	
	static public function GetPath()
	{		
		return self::$_path;
	}

	function __set($name,$value) {		
		// If its not whitelisted or coming from our database (data that should already have been validated)
		// Then we html encode it
		$v = "";
		if(array_search($name, $this::$NoHTMLEncode, FALSE) || "Model" == get_parent_class($name) || $name == "model")
		{
			//dd::Trace("Setter NOT HTML Encoding value");
			$v = $value;
		}
		else 
		{
			//dd::Trace("Setter HTML Encoding value");
			$v = Utils::HtmlEncode($value);	 
		}
		$this->_template->$name = $v;
	}

	function __destruct() {
		// Render View
		if(SystemException::Count() == 0)
		{
			//dd::Trace("Rendering template");
			$this->_template->render();
		}
		// Close database connection
		//dd::Trace("Closing database connection");
		R::close();
			
	}

}

