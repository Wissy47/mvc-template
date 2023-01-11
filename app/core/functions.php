<?php 
// Write all site-wide function here, All function written here can be access site-wide


/**
 * If there is an error message, display it and then unset it.
 */
function error_message()
{
	if(isset($_SESSION['error']) && $_SESSION['error'] != "")
	{
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
}