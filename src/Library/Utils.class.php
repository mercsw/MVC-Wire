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
	
	static public function DumpVar($var)
	{
		if(DEVELOPMENT_ENVIRONMENT)
		{
			echo "<pre>";
			print_r($var);
			echo "</pre>";
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
}