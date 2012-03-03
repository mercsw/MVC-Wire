<?php 
use HtmlHelpers as hh;

Response::WriteLine($model->Id);
Response::WriteLine($model->PostDate);
Response::WriteLine(hh::UrlLink("Delete Post", "../../../BlogPosts/Delete/" . $model->Id));
Response::Write(hh::UrlLink("Click here", "../../../BlogPosts/ViewAll"));
Response::Write(" to go back.");

