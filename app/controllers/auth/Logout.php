<?php 


/**
 * class Logout
 */
class Logout extends controller
{
	
	public function __construct()
	{
		session_destroy();
		header('location:'.BASEURL.'/Login');
		exit();
	}
}



?>