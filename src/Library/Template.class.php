<?php
use HtmlHelpers as hh;
use Diagnostics as dd;

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
		Response::Write(hh::BeginHtmlHeader());
		Response::Write(hh::Title());
		Response::Write(StyleSheet::ToHtml());
		Response::Write(hh::EndHtmlHeader());
       	include (ROOT . DS . 'App' . DS . 'Views' . DS . $this->_controller . DS . $this->_action . '.php');
		Response::Write("\n");	
		Response::Write(JavaScript::ToHtml());
		// End Body and Html gets rendered in Request::End() to make sure we are done sending to the client  				
	}
}