<?php 


/**
 * class Logout
 */
class Logout extends controller
{
	
	// method logout
	public function __construct()
	{
		session_destroy();
		header('location:'.BASEURL.'/Login');
		exit();
	}
}



?>