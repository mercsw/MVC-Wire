<?php

class BlogPost extends Model {
	
	//function name must match property name in all lowercase with the string "Validator" appended to it
	function postdateValidator($field, $value)
	{
		Validators::MatchesRegex($field, $value, '/^\d{10}$/', "Field $field must be 10 digits");
	}
}

