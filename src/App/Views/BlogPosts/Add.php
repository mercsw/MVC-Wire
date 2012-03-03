<?php
use HtmlHelpers as hh;

if(!empty($ErrMsg))
{
	Response::WriteLine($ErrMsg);	
}
else 
{
	Response::Write("Blog post successfully added. ");	
}
Response::Write(hh::UrlLink("Click here", BlogPostsController::GetPath() . "/ViewAll"));
Response::Write(" to go back.");
