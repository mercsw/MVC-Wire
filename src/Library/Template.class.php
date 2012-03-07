<?php
use HtmlHelpers as hh;
use Diagnostics as dd;

class Template {

	protected $variables = array();
	protected $_controller;
	protected $_action;
	protected $_isPartial = FALSE;

	function __construct($controller,$action) {
		$this->_controller = $controller;
		$this->_action = $action;
	}
	
	function SetIsPartial($value = TRUE)
	{
		$this->_isPartial = $value;
	}

	function __set($name, $value) {
		$this->variables[$name] = $value;	
	}

    function render() 
    {
		extract($this->variables);
		if(! $this->_isPartial)
		{
			StyleSheet::Register("/public/css/Default.css");
			StyleSheet::Register("/public/css/Default_IE.css");
			Response::Write(hh::BeginHtmlHeader());
			Response::Write(hh::Title());
			Response::Write(StyleSheet::ToHtml());
			Response::Write(hh::EndHtmlHeader());
		}
		include (ROOT . DS . 'App' . DS . 'Views' . DS . "Templates" . DS . "Default" . DS . 'top.html');
       	include (ROOT . DS . 'App' . DS . 'Views' . DS . $this->_controller . DS . $this->_action . '.php');
		include (ROOT . DS . 'App' . DS . 'Views' . DS . "Templates" . DS . "Default" . DS . 'bottom.html');
		Response::Write("\n");	
		Response::Write(JavaScript::ToHtml($this->_isPartial));
		// End Body and Html gets rendered in Request::End() to make sure we are done sending to the client  				
	}
}