<?php 
use HtmlHelpers as hh;

Response::WriteLine($model->Id);
Response::WriteLine($model->PostDate);
Response::WriteLine(hh::UrlLink("Delete Post", BlogPostsController::GetPath() . "/Delete/" . $model->Id));
Response::Write(hh::UrlLink("Click here", BlogPostsController::GetPath() . "/ViewAll"));
Response::Write(" to go back.");

