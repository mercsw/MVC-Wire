<?php
use HtmlHelpers as hh;

Response::WriteLine("Blog post successfully deleted. ");
Response::Write(hh::UrlLink("Click here", "../../BlogPosts/ViewAll"));
Response::Write(" to go back.");