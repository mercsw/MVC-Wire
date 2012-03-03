<?php
use HtmlHelpers as hh;

Response::WriteLine("Blog post successfully deleted. ");
Response::Write(hh::UrlLink("Click here", BlogPostsController::GetPath() . "/ViewAll"));
Response::Write(" to go back.");