<?php
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
	
	static public function BreakLine()
	{
		echo "<br/>";
	}
}