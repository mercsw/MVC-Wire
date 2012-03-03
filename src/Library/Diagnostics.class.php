<?php
class Diagnostics 
{
	private static $_trace = Array();
	
	public static function Trace($message)
	{
		if(DEVELOPMENT_ENVIRONMENT)
		{
			$_trace[] = $message;
		}
	}
	
	public static function GetTrace()
	{
		return $_trace;
	}
}
