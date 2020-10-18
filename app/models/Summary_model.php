<?php 


/**
 * CLASS SUMMARY_MODEL
 */
class Summary_model
{
	private $db;


	
	public function __construct()
	{
		$this->db = new Database;
	}



	// menampilkan serta menghitung total qty pembelian
	public function get_sum_pembelian($data)
	{
		$query = "SELECT SUM(qty) AS sum FROM pembelian_detail dpem
			JOIN pembelian pem ON dpem.no_pembelian = pem.no_pembelian WHERE pem.tanggal 
			BETWEEN :tanggal_awal AND :tanggal_akhir";

		if ( !empty($data['filter']['item']) ) {
			$query .= " AND dpem.item = :item";
			
			$this->db->query($query);
			$this->db->bind('item', htmlspecialchars($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', htmlspecialchars($data['filter']['tanggal_awal']));
		$this->db->bind('tanggal_akhir', htmlspecialchars($data['filter']['tanggal_akhir']));
		$sum = $this->db->single();

		return $sum['sum'];
	}



	// menampilkan serta menghitung total qty return penjualan
	public function get_sum_return_penjualan($data)
	{
		$query = "SELECT SUM(qty) AS sum FROM return_penjualan_detail drpj
			JOIN return_penjualan rpj ON drpj.no_return_penjualan = rpj.no_return_penjualan WHERE rpj.tanggal 
			BETWEEN :tanggal_awal AND :tanggal_akhir";

		if ( !empty($data['filter']['item']) ) {
			$query .= " AND drpj.item = :item";
			
			$this->db->query($query);
			$this->db->bind('item', htmlspecialchars($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', htmlspecialchars($data['filter']['tanggal_awal']));
		$this->db->bind('tanggal_akhir', htmlspecialchars($data['filter']['tanggal_akhir']));
		$sum = $this->db->single();

		return $sum['sum'];
	}



	// menampilkan serta menghitung total qty penjualan
	public function get_sum_penjualan($data)
	{
		$query = "SELECT SUM(qty) AS sum FROM penjualan_detail dpen
			JOIN penjualan pen ON dpen.no_penjualan = pen.no_penjualan WHERE pen.tanggal 
			BETWEEN :tanggal_awal AND :tanggal_akhir";

		if ( !empty($data['filter']['item']) ) {
			$query .= " AND dpen.item = :item";
			
			$this->db->query($query);
			$this->db->bind('item', htmlspecialchars($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', htmlspecialchars($data['filter']['tanggal_awal']));
		$this->db->bind('tanggal_akhir', htmlspecialchars($data['filter']['tanggal_akhir']));
		$sum = $this->db->single();

		return $sum['sum'];
	}



	// menampilkan serta menghitung total qty return pembelian
	public function get_sum_return_pembelian($data)
	{
		$query = "SELECT SUM(qty) AS sum FROM return_pembelian_detail drpm
			JOIN return_pembelian rpm ON drpm.no_return_pembelian = rpm.no_return_pembelian WHERE rpm.tanggal 
			BETWEEN :tanggal_awal AND :tanggal_akhir";

		if ( !empty($data['filter']['item']) ) {
			$query .= " AND drpm.item = :item";
			
			$this->db->query($query);
			$this->db->bind('item', htmlspecialchars($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', htmlspecialchars($data['filter']['tanggal_awal']));
		$this->db->bind('tanggal_akhir', htmlspecialchars($data['filter']['tanggal_akhir']));
		$sum = $this->db->single();

		return $sum['sum'];
	}
}


?>