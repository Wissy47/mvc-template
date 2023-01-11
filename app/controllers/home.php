<?php
// Class name should be same a file name for the router to work properly

Class Home extends Controller 
{
	public function index()
	{ 	
 	 	$data['page_title'] = "My HomePage";
        // The file to render from views dir
		$content = $this->view("home-page");
		$this->template($content, $data);
	}

}