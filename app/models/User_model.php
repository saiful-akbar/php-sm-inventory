<?php

/**
 * class User_model
 */
class User_model extends Controller
{
	private $db;
	
	public function __construct()
	{
		$this->db = new Database;
	}



	// mengambil data user
	public function get_user( $data = null )
	{
		$query = "SELECT * FROM user ";

		if ( !empty($data) ) {
			$query .= "WHERE username = :username";
			$this->db->query($query);
			$this->db->bind('username', $data['username']);
			return $this->db->single();
		}
		else {
			$query .= "ORDER BY nama_user ASC";
			$this->db->query($query);
			return $this->db->all();
		}
	}



	// mengambil  data user by id
	public function get_user_by_id( $data )
	{
		$query = "SELECT * FROM user WHERE id_user = :id";
		$this->db->query($query);
		$this->db->bind('id', $data);
		return $this->db->single();
	}



	// method tambah data user
	public function tambah_data_user( $data )
	{
		$query = "INSERT INTO user(username, password, nama_user, level) VALUES(:username, :password, :nama_user, :level) ";
		$this->db->query($query);
		$this->db->bind('username', $data['username']);
		$this->db->bind('password', $data['password']);
		$this->db->bind('nama_user', ucwords($data['nama']));
		$this->db->bind('level', strtolower($data['level']));
		$this->db->execute();

		return $this->db->rowCount();
	}



	// validasi ubah data user
	public function validasi_ubah( $data )
	{
		$query = "SELECT * FROM user WHERE username = :username AND id_user != :id_user";
		$this->db->query($query);
		$this->db->bind('username', $data['username']);
		$this->db->bind('id_user', $data['id_user']);
		return $this->db->single();
	}



	// ubah data user
	public function ubah_data_user($data)
	{
		$query = "UPDATE user SET
		username = :username,
		password = :password,
		nama_user = :nama_user,
		level = :level
		WHERE id_user = :id_user
		";

		$this->db->query($query);
		$this->db->bind('username', $data['username']);
		$this->db->bind('password', $data['password']);
		$this->db->bind('nama_user', ucwords($data['nama_user']));
		$this->db->bind('level', $data['level']);
		$this->db->bind('id_user', $data['id_user']);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// hapus data user
	public function hapus_data_user($id_user)
	{
		$query = "DELETE FROM user WHERE id_user = :id_user";
		$this->db->query($query);
		$this->db->bind('id_user', $id_user);
		$this->db->execute();
		return $this->db->rowCount();
	}
}

?>