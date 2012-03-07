<?php
use HtmlHelpers as hh;
use BlogPostsController as cc;

if(!empty($ErrMsg))
{
	Response::WriteLine($ErrMsg);
}
else 
{
	$posts = $model; 
	
	//Build an array for ItemUrlList
	function filterResults($result)
	{
		return Array($result->PostDate, "View/" . $result->Id);	
	}
	$posts = array_map("filterResults", $posts);
	
	Response::Write(hh::ItemUrlList($posts, hh::UnorderedType, "Post dated: "));
}
Response::BreakLine();
Response::Write(hh::UrlLink("Click here", cc::GetPath() . "/Add"));
Response::Write(" to add a new post");