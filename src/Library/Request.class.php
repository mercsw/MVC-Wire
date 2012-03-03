<?php    
use Diagnostics as d;

class Request 
{
	static function Register()
	{
		register_shutdown_function('Request::End');
		self::Begin();
	}
	 
    static function Begin()
	{
		d::Trace("Begin Request");		
	}
	static function End()
	{
		d::Trace("End Request");
	}
}
