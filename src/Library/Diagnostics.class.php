<?php
use HtmlHelpers as hh;

class Diagnostics 
{
	private static $_trace = Array();
	
	public static function Trace($message)
	{
		$trace=debug_backtrace();
		if(DEVELOPMENT_ENVIRONMENT)
		{
			self::$_trace[] = "Class: " . $trace[1]['class'] . "\nFunction: " . $trace[1]['function'] . "\nArguments: " . implode(", ", $trace[1]['args']) . "\nMessage: $message\n";
		}
	}
	
	public static function GetTrace()
	{
		return self::$_trace;
	}
		
	public static function Start()
	{
		StyleSheet::Register();
		JavaScript::Register();
	}
	
	public static function End()
	{		
		if(DEVELOPMENT_ENVIRONMENT)
		{
			$htmlString = "<pre>";
			foreach(self::$_trace as $line)
			{
				$htmlString .= Utils::HtmlEncode($line) . Response::BreakLine(FALSE);
			}
			$htmlString .= "</pre>";
			$float = hh::FloatingWindow("devDiag", $htmlString);			
			Response::Write($float);
		}
	}
}
