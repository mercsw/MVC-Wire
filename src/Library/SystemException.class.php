<?php
    
    class SystemException extends Exception 
    {
		static protected $_exceptionCount = 0;
		
		public function __construct($message, $code = 0, Exception $previous = null) 
		{
			self::$_exceptionCount++;
	    	parent::__construct($message, $code, $previous);			
    	}
						
		static function Count()
		{
			return self::$_exceptionCount; 
		}
    }