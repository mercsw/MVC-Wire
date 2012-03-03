<?php
  class ValidatorException extends SystemException 
    {
		
		protected $_validationMessage;
		
		public function __construct($message, $code = 0, Exception $previous = null) 
		{			
			$this->message = $message;
			$this->code = $code;
			$this->previous = $previous;
			$this->_validationMessage = $message;				    				
    	}
						
		static function Count()
		{
			return parent::$_exceptionCount; 
		}
		
		public function GetError()
		{
			return $this->_validationMessage;
		}
    }