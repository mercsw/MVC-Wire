<?php
class Utils 
{
	static public function StartsWith($haystack, $needle)
	{
	    $length = strlen($needle);
	    return (substr($haystack, 0, $length) === $needle);
	}

	static public function EndsWith($haystack, $needle)
	{
	    $length = strlen($needle);
	    $start  = $length * -1; //negative
	    return (substr($haystack, $start) === $needle);
	}
	
	static public function DumpVar($var, $label = NULL, $highlight = FALSE)
	{
		if(DEVELOPMENT_ENVIRONMENT)
		{
			Response::Write("<pre>");
			if(!empty($highlight))
			{
				Response::WriteLine("<== Start ==>");
			}
			if(!empty($label))
			{
				Response::Write("$label: ");
			}
			print_r($var);
			if(!empty($highlight))
			{
				Response::BreakLine();
				Response::WriteLine("<== End ==>");
			}
			Response::Write("</pre>");
		}
	}
	
	static public function DumpGlobals()
	{
		if(DEVELOPMENT_ENVIRONMENT)
		{
			Response::Write("<pre>");
			var_dump($GLOBALS);
			Response::Write("</pre>");
		}
	}
	
	static public function HtmlEncode($plain)
	{
		return htmlentities($plain, 0, "UTF-8", TRUE);
	}
	
	static public function HtmlDecode($encoded)
	{
		return html_entity_decode($encoded, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5, "UTF-8");
	}
	
	static public function Left($string, $count)
	{
		$strlen = strlen($string);
		if($strlen > $count)
		{
			return $string; 
		}
		return substr($string, 0, $count);
	}
	
	static public function Right($string, $count)
	{
		$strlen = strlen($string);
		if($strlen > $count)
		{
			return $string; 
		}
		return substr($string, $strlen - $count - 1, $count);
	}
}