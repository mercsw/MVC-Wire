<?php
class Controller {

	protected $_model;
	protected $_controller;
	protected $_action;
	protected $_template;

	function __construct($model, $controller, $action) {

		$this->_controller = $controller;
		$this->_action = $action;
		$this->_model = $model;

		$this->$model = new $model;
		$this->_template = new Template($controller,$action);

	}

	function __set($name,$value) {		
		// If its not whitelisted or coming from our database (data that should already have been validated)
		// Then we html encode it
		$v = "";
		if(array_search($name, $this::$NoHTMLEncode, FALSE) || "Model" == get_parent_class($name) || $name == "model")
		{
			$v = $value;
		}
		else 
		{
			$v = Utils::HtmlEncode($value);	 
		}
		$this->_template->$name = $v;
	}

	function __destruct() {
		// Render View
		if(SystemException::Count() == 0)
		{
			$this->_template->render();
		}
		// Close database connection
		R::close();
			
	}

}

