<?php
class Validators
{
	static function MatchesRegex($field, $value,$regex, $message = NULL)
	{
		if(!preg_match($regex, $value))
		{			
			$errMsg = "Failed Validation: " . $message;
			if($message == NULL)
			{
				$errMsg .= "Field $field must match pattern $regex";
			}
			throw new ValidatorException(Utils::HtmlEncode($errMsg));
		}
	}
	
	static function Validate($object, $name, $value)
	{
		//const POSTDATEVALIDATOR_REGEX = Array('/^\d{10}$/', 'Field $name must be 10 digits');
		$staticName = strtolower($name) . "Validator_Regex";
		$regexConfig = $object::$$staticName;
		$message = "";
		if(!empty($regexConfig[1]))
		{
			$message = $regexConfig[1];
		} 			
		self::MatchesRegex($name, $value, $regexConfig[0] , $message );
	}
}
