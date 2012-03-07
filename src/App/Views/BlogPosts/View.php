<?php 
use HtmlHelpers as hh;
use BlogPostsController as cc;

if(!empty($ErrMsg))
{
	Response::WriteLine($ErrMsg);
}
else 
{
	Response::WriteLine("Post ID: " . $model->Id);
	Response::WriteLine("Post Date: " .$model->PostDate);
	Response::WriteLine(hh::UrlLink("Delete Post", cc::GetPath() . "/Delete/" . $model->Id));	
}
Response::BreakLine();
Response::Write(hh::UrlLink("Click here", cc::GetPath() . "/ViewAll"));
Response::Write(" to go back.");

