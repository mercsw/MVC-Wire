<?php
use HtmlHelpers as hh;
use BlogPostsController as cc;

Response::WriteLine("Blog post successfully deleted. ");
Response::Write(hh::UrlLink("Click here", cc::GetPath() . "/ViewAll"));
Response::Write(" to go back.");