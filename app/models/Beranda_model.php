<?php 

/**
 * CLASS BERANDA
 */
class Beranda_model extends Controller
{
	private $db;



	public function __construct()
	{
		$this->db = new Database;
	}



	// mengambil jumlah transaksi pembelian berdasarkan bulan
	public function get_count_pembelian($bulan)
	{
		$query = "SELECT count(no_pembelian) AS count FROM pembelian WHERE tanggal LIKE :bulan";
		
		$this->db->query($query);
		$this->db->bind('bulan', "%$bulan%");
		
		$count =  $this->db->single();
		$data = $count['count'];
		return $data;
	}



	// mengambil jumlah transaksi penjualan berdasarkan bulan
	public function get_count_penjualan($bulan)
	{
		$query = "SELECT count(no_penjualan) AS count FROM penjualan WHERE tanggal LIKE :bulan";
		
		$this->db->query($query);
		$this->db->bind('bulan', "%$bulan%");
		
		$count =  $this->db->single();
		$data = $count['count'];
		return $data;
	}



	// mengambil jumlah transaksi return pembelian berdasarkan bulan
	public function get_count_return_pembelian($bulan)
	{
		$query = "SELECT count(no_return_pembelian) AS count FROM return_pembelian WHERE tanggal LIKE :bulan";
		
		$this->db->query($query);
		$this->db->bind('bulan', "%$bulan%");
		
		$count =  $this->db->single();
		$data = $count['count'];
		return $data;
	}



	//mengambil jumlah transaksi return penjualan berdasarkan bulan
	public function get_count_return_penjualan($bulan)
	{
		$query = "SELECT count(no_return_penjualan) AS count FROM return_penjualan WHERE tanggal LIKE :bulan";
		
		$this->db->query($query);
		$this->db->bind('bulan', "%$bulan%");
		
		$count =  $this->db->single();
		$data = $count['count'];
		return $data;
	}


}



?>