<?php
use Diagnostics as dd;

class Response 
{
   static public function Write($output)
	{
		echo $output;
	}
	
	static public function WriteLine($output)
	{
		echo $output;
		self::BreakLine();
	}
	
	static public function BreakLine($sendToClient = TRUE)
	{
		$tag = "<br/>";
		if($sendToClient)
		{
			echo $tag;
		}
		else 
		{
			return $tag;
		}
	}
}