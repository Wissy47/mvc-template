<?php 

 /**
  * 
  * A class that is used to load the views and models.
  *	
  */
Class Controller
{

	/**
	 * If the file exists, return the file, otherwise return the 404 page
	 * 
	 * @param view The name of the view you want to load.
	 * 
	 * @return The view file.
	 */
	protected function view($view)
	{
		if(file_exists("app/views/". $view .".php"))
 		{
 			return "app/views/". $view .".php";
 		}else{
 			return "app/views/404.php";
 		}
	}

	/**
	 * It checks if the model file exists, if it does, it includes it and returns a new instance of the
	 * model.
	 * 
	 * @param model The name of the model to load.
	 * 
	 * @return The model is being returned.
	 */
	protected function loadModel($model)
	{
		if(file_exists("app/models/". $model .".php"))
 		{
 			include_once "app/models/". $model .".php";
 			return $model = new $model();
 		}

 		return false;
	}

	/**
	 * It loads a 404 page
	 * 
	 * @param view The view file to load.
	 */
	public function get404page($view="")
	{
		$data['page_title']="404";
		$this->template($this->view($view), $data);
	} 

	/**
	 * It includes the header, nav, content, and footer files
	 * 
	 * @param content The name of the view file to be included.
	 * @param data This is an array of data that you want to pass to the view.
	 */
	protected function template($content, $data=[])
	{
		include "app/views/includes/header.inc.php";
		include "app/views/includes/nav.inc.php";
		include ($content);
		include "app/views/includes/footer.inc.php";
	}
	
}