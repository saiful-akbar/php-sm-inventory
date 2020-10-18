<?php 

/**
 * class model kategori
 */
class Kategori_model
{
	private $db;
	
	public function __construct()
	{
		$this->db = new Database;
	}


	public function get_kategori( $data = null )
	{
		$query = "SELECT * FROM kategori_barang ";

		if ( !empty($data) ) {
			$query .= "WHERE id_kategori = :id";
			$this->db->query($query);
			$this->db->bind('id', $data['id']);
			return $this->db->single();
		}
		else {
			$query .= "ORDER BY nama_kategori ASC";
			$this->db->query($query);
			return $this->db->all();
		}
	}



	public function get_kategory_by_nama( $data )
	{
		$query = "SELECT * FROM kategori_barang WHERE nama_kategori = :nama_kategori";

		$this->db->query($query);
		$this->db->bind('nama_kategori', strtoupper($data['nama_kategori']));
		
		return $this->db->single();
	}




	public function tambah_data($data)
	{
		$query = "INSERT INTO kategori_barang(nama_kategori) VALUES(:nama_kategori) ";
		$this->db->query($query);
		$this->db->bind('nama_kategori', strtoupper($data['nama_kategori']));
		$this->db->execute();
		return $this->db->rowCount();
	}



	// validasi ubah data kategori barang
	public function ubah_validasi($data)
	{
		$query = "SELECT * FROM kategori_barang WHERE nama_kategori = :nama_kategori AND id_kategori != :id";
		$this->db->query($query);
		$this->db->bind('nama_kategori', strtoupper($data['nama_kategori']));
		$this->db->bind('id', $data['id_kategori']);

		return $this->db->single();
	}



	public function ubah_data($data)
	{
		$query = "UPDATE kategori_barang SET nama_kategori = :nama_kategori WHERE id_kategori = :id";
		$this->db->query($query);
		$this->db->bind('id', $data['id_kategori']);
		$this->db->bind('nama_kategori', strtoupper($data['nama_kategori']));
		$this->db->execute();
		return $this->db->rowCount();
	}



	public function hapus_data($id)
	{
		$query = "DELETE FROM kategori_barang WHERE id_kategori = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}
}



?>	