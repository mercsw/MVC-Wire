<?php
use HtmlHelpers as hh;
use BlogPostsController as cc;

if(!empty($ErrMsg))
{
	Response::WriteLine($ErrMsg);	
}
else 
{
	Response::Write("Blog post successfully added. ");	
}
Response::Write(hh::UrlLink("Click here", cc::GetPath() . "/ViewAll"));
Response::Write(" to go back.");
