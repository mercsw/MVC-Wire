<?php

class BlogPost extends Model {
	
	function postdateValidator($field, $value)
	{
		Validators::MatchesRegex($field, $value, '/^\d{10}$/', "Field $field must be 10 digits");
	}
}

