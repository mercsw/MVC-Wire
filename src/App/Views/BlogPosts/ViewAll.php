<?php
use HtmlHelpers as hh;
use BlogPostsController as cc;

$posts = $model; 

//Build an array for ItemUrlList
function filterResults($result)
{
	return Array($result->PostDate, "View/" . $result->Id);	
}
$posts = array_map("filterResults", $posts);

Response::Write(hh::ItemUrlList($posts, hh::UnorderedType, "Post dated: "));
Response::Write(hh::UrlLink("Click here", cc::GetPath() . "/Add"));
Response::Write(" to add a new post");