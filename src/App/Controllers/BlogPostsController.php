<?php
class BlogPostsController extends Controller {

	function view($id = null,$name = null) {
		$this->set('title', $name . ' - Blog');
		$this->set('blogPost',"Post id: $id");
	}

	function viewall() {
		$blogPosts = array('item1', 'item2', 'item3');
		$this->set('title','All BlogPost - Blog');
		$this->set('blogPosts',$blogPosts);
	}

	function add() {
		$todo = $_POST['todo'];
		$this->set('title','Success - Blog');
		die("Not implemented");
	}

	function delete($id = null) {
		$this->set('title','Success - Blog');
		die("Not implemented");
	}
}
