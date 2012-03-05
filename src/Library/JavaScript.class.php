<?php
use Diagnostics as dd;

class JavaScript 
{
	protected static $_scripts = Array();
	
	public static function Register($script = NULL)
	{
		if(!empty($script))
		{
			dd::Trace("Registering full path to javascript: " . $script);
			self::$_scripts[] = $script;
		}
		else
		{
			
			$trace=debug_backtrace();
			$caller=$trace[1];
			$class = $caller['class'];
			dd::Trace("Registering JavaScript by convention for: " . $class);
			self::$_scripts[] = "/public/js/$class.js";
		}
	}

	
	public static function ToHtml($isPartial = FALSE)
	{
		dd::Trace("Building Javascript Include HTML");
		if(! $isPartial)
		{
			// Load JQuery everywhere
			array_unshift(self::$_scripts,"https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js");
			array_unshift(self::$_scripts,"https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js");
		}				
		$htmlString = "";
		// add a link for each stylesheet
		foreach(self::$_scripts as $script)
		{
			$htmlString .= "<script src=\"$script\"></script>\n";
		}
		return $htmlString;
	}	
}