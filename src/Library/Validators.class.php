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
}
