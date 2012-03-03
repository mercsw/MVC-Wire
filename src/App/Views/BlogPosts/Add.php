<?php
use HtmlHelpers as hh;

Response::Write("Blog post successfully added. ");
Response::Write(hh::UrlLink("Click here", "../BlogPosts/ViewAll"));
Response::Write(" to go back.");
