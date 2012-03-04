<?php    
use Diagnostics as dd;

class Request 
{
	static function Register()
	{
		register_shutdown_function('Request::End');
		self::Begin();
	}
	 
    static function Begin()
	{
		dd::Start();
		dd::Trace("Begin Request");				
	}
	static function End()
	{
		dd::Trace("End Request");
		dd::End();				
	}
}
