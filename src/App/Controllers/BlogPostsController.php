<?php
class BlogPostsController extends Controller {

	function view($id) {
		$bp = BlogPost::GetRowById($id);
		if (empty($bp))
		{			          
			throw new SystemException("Record not found");
		}
		$this->set('model', $bp);
	}

	function viewall() {
		// To get a specific id's
		//$bp = BlogPost::GetRowsById(4,2,3,6);
		// Get all rows
		$bp = BlogPost::GetAll();
		if (empty($bp))
		{			          
			throw new SystemException("Record not found");
		}
		$this->set('model',$bp);		
	}

	function add() {
		$bp = new BlogPost();
		$bp->PostDate = time();
		$bp->save();
	}

	function delete($id = null) {
		$bp = BlogPost::GetRowById($id);
		if (empty($bp))
		{			          
			throw new SystemException("Record not found");
		}
		$bp->Delete();		
	}
}
