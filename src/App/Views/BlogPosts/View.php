<?php 
use HtmlHelpers as hh;
use BlogPostsController as cc;

Response::WriteLine($model->Id);
Response::WriteLine($model->PostDate);
Response::WriteLine(hh::UrlLink("Delete Post", cc::GetPath() . "/Delete/" . $model->Id));
Response::Write(hh::UrlLink("Click here", cc::GetPath() . "/ViewAll"));
Response::Write(" to go back.");

