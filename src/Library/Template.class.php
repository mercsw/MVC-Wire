<?php
class Template {

	protected $variables = array();
	protected $_controller;
	protected $_action;

	function __construct($controller,$action) {
		$this->_controller = $controller;
		$this->_action = $action;
	}

	/** Set Variables **/

	function set($name, $value) {
		$this->variables[$name] = $value;	
	}

	/** Display Template **/

    function render() 
    {
		extract($this->variables);
       	include (ROOT . DS . 'App' . DS . 'Views' . DS . $this->_controller . DS . $this->_action . '.php');
	}
}