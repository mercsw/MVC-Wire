<?php
use BlogPostsController as cc;
use HtmlHelpers as hh;

$posts = $model; 

//Build an array for ItemUrlList
function filterResults($result)
{
	return Array($result->PostDate, "View/" . $result->Id);	
}
$posts = array_map("filterResults", $posts);

Response::Write(hh::ItemUrlList($posts, hh::UnorderedType, "Post dated: "));
Response::Write(hh::UrlLink("Click here", "../BlogPosts/Add"));
Response::Write(" to add a new post");