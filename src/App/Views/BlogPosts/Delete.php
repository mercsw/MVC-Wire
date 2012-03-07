<?php
use HtmlHelpers as hh;
use BlogPostsController as cc;

if(!empty($ErrMsg))
{
	Response::WriteLine($ErrMsg);
}
else 
{
	Response::WriteLine("Blog post successfully deleted. ");
}
Response::BreakLine();
Response::Write(hh::UrlLink("Click here", cc::GetPath() . "/ViewAll"));
Response::Write(" to go back.");