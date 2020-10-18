<?php 

/**
 * class Login_model
 */
class Login_model
{
	private $db;
	
	// instansiati class database
	public function __construct()
	{
		$this->db = new Database;
	}


	// cek user hasil inputan user login
	public function cek_user($data)
	{
		$query = "SELECT * FROM user WHERE username = :user AND password = :pass";

		$this->db->query($query);
		$this->db->bind('user', $data['username']);
		$this->db->bind('pass', $data['password']);

		return $this->db->single();
	}
}

?>