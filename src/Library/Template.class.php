<?php
class Template {

	protected $variables = array();
	protected $_controller;
	protected $_action;

	function __construct($controller,$action) {
		$this->_controller = $controller;
		$this->_action = $action;
	}

	function __set($name, $value) {
		$this->variables[$name] = $value;	
	}

    function render() 
    {
		extract($this->variables);
       	include (ROOT . DS . 'App' . DS . 'Views' . DS . $this->_controller . DS . $this->_action . '.php');
		// Add diagnostics tab
		if(DEVELOPMENT_ENVIRONMENT)
		{
			
		}
	}
}