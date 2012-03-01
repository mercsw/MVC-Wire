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
}