<?php
class Diagnostics 
{
	static $_trace = Array();
	
	static function Trace($message)
	{
		if(DEVELOPMENT_ENVIRONMENT)
		{
			$_trace[] = $message;
		}
	}
}
