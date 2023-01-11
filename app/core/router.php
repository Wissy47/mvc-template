<?php

/*
* A class that is used to route the user to the correct page. 
*
* This is the single entrance to the web-app
*/
Class Router
{
	private $controller = "home";
	private $method = "index";
	private $params = [];

	/**
	 * If the url is valid, it will run the class and method, if not, it will run the 404 page.
	 */
	public function __construct()
	{

		$url = $this->splitURL();

 		if(file_exists("app/controllers/". strtolower($url[0]) .".php"))
 		{
 			$this->controller = strtolower($url[0]);
 			unset($url[0]);
 		}else{
			$route404 = new Controller();
			$route404->get404page();
			die;
		 }

 		require "app/controllers/". $this->controller .".php";
 		$this->controller = new $this->controller;

 		if(isset($url[1]))
 		{
 			if(method_exists($this->controller, $url[1]))
 			{
 				$this->method = $url[1];
 				unset($url[1]);
 			}
 		}

 		//run the class and method
 		$this->params = array_values($url);
 		call_user_func_array([$this->controller,$this->method], $this->params);
	}

	/**
	 * It takes the URL, splits it into an array, and returns the array.
	 * 
	 * @return The URL is being returned.
	 */
	private function splitURL(): array
	{
		$url = isset($_GET['url']) ? $_GET['url'] : "home";
		return explode("/", filter_var(trim($url,"/"),FILTER_SANITIZE_URL));
	}
}