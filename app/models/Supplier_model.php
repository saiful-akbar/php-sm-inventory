<?php 


/**
 * class model supplier
 */
class Supplier_model
{
	
	private $db;



	public function __construct()
	{
		$this->db = new Database;
	}



	// mengambil data dari table supplier
	public function get_supplier($id = null)
	{	
		$query = "SELECT * FROM supplier ";
		
		if ( !empty($id) ) {
			$query .= "WHERE id = :id";
			$this->db->query($query);
			$this->db->bind('id', $id);
			return $this->db->single();
		}
		else {
			$this->db->query($query);
			return $this->db->all();
		}
	}



	// membuat kode supplier otomatis
	public function kode_otomatis()
	{
		$query = "SELECT max(kode) AS max FROM supplier ORDER BY kode DESC";
		$this->db->query($query);

		$data = $this->db->single();
		
		$kode = $data['max'];
		$urut = substr($kode, 5, 3);
		$tambah = (int) $urut + 1;

		if ( strlen($tambah) == 1 ) {
			$format = 'SPL-00'.$tambah;
		}
		else if ( strlen($tambah) == 2 ) {
			$format = 'SPL-0'.$tambah;
		}
		else if ( strlen($tambah) == 3 ) {
			$format = 'SPL-'.$tambah;
		}

		return $format;
	}



	// tambah data supplier
	public function tambah_data($data)
	{
		$query = "INSERT INTO supplier(kode, nama, kota, alamat, kontak) VALUES(:kode, :nama, :kota, :alamat, :kontak)";
		$this->db->query($query);
		$this->db->bind('kode', strtoupper($data['kode']));
		$this->db->bind('nama', ucwords($data['nama']));
		$this->db->bind('kota', ucwords($data['kota']));
		$this->db->bind('alamat', $data['alamat']);
		$this->db->bind('kontak', $data['kontak']);
		$this->db->execute();
		return $this->db->rowCount();
	}



	// hapus data supplier
	public function hapus_data($id)
	{
		$query = "DELETE FROM supplier WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();
		return $this->db->rowCount();
	}



	// merubah data supplier
	public function ubah_data($data)
	{
		$query = "UPDATE supplier SET kode = :kode, nama = :nama, kota = :kota, alamat = :alamat, kontak = :kontak WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('kode', strtoupper($data['kode']));
		$this->db->bind('nama', ucwords($data['nama']));
		$this->db->bind('kota', ucwords($data['kota']));
		$this->db->bind('alamat', $data['alamat']);
		$this->db->bind('kontak', $data['kontak']);
		$this->db->bind('id', $data['id']);
		$this->db->execute();
		return $this->db->rowCount();
	}
}



?>



















