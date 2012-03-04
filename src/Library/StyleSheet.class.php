<?php
use Diagnostics as dd;

class StyleSheet
{
	protected static $_styleSheets = Array();
	protected static $_IESucks = "<!--[if IE]>
<script src=\"http://html5shiv.googlecode.com/svn/trunk/html5.js\"></script><![endif]-->
<!--[if lt IE 9]>
<script src=\"http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js\"></script>
<![endif]-->";	
	
	public static function Register($cssPath = NULL)
	{
		
		if(!empty($cssPath))
		{
			dd::Trace("Registering full path to css: " . $cssPath);
			self::$_styleSheets[] = $cssPath;
		}
		else
		{
			$trace=debug_backtrace();			
			$caller=$trace[1];
			$class = $caller['class'];
			dd::Trace("Registering CSS by convention for: " . $class);
			self::$_styleSheets[] = "/public/css/$class.css";
		}
	}

	
	public static function ToHtml()
	{
		// Prepend the main site stylesheet
		array_unshift(self::$_styleSheets,"/public/css/Site.css");		
		$htmlString = "";
		// add a link for each stylesheet
		foreach(self::$_styleSheets as $styleSheet)
		{
			$htmlString .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$styleSheet\" />\n";
		}
		$htmlString .= self::$_IESucks;
		
		return $htmlString;
	}	
}
