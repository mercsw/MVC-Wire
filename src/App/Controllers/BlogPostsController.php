<?php
class BlogPostsController extends Controller {

	function view($id) {
		$bp = new BlogPost();
		$bp = BlogPost::GetRowById($id);
		if (sizeof($bp) == 0)
		{
			die("Record not found");
		}
		$this->set('model', $bp);
	}

	function viewall() {
		$blogPosts = array('item1', 'item2', 'item3');
		$this->set('title','All BlogPost - Blog');
		$this->set('blogPosts',$blogPosts);
	}

	function add() {
		$bp = new BlogPost();
		$bp->set('PostDate', time());
		$bp->save();
	}

	function delete($id = null) {
		$this->set('title','Success - Blog');
		die("Not implemented");
	}
}
