<?php
class BlogPostsController extends Controller {

	// Whitelist values that should not get html encoded before being sent to the View
	static $NoHTMLEncode = Array("PostDate");

	function view($id) {
		$bp = BlogPost::GetRowById($id);
		if (empty($bp))
		{			          
			throw new SystemException("Record not found");
		}
		$this->model = $bp;
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
		$this->model = $bp;		
	}

	function add() {
		$bp = new BlogPost();
		try
		{
			$bp->PostDate = time();
			$bp->save();
		}
		catch(ValidatorException $ex)
		{
			$this->ErrMsg = $ex->GetError();
		}		
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
