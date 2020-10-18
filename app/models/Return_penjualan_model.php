<?php

/**
 *  Class return penjualan model
 */
class Return_penjualan_model
{
	private $db;
	


	// inisialisasi class database
	public function __construct()
	{
		$this->db = new Database;
	}



	// ambil data tabel return_penjualan
	public function get_return_penjualan($data = null)
	{
		$query = "SELECT * FROM return_penjualan ";

		if ( !empty($data['tanggal_awal']) && !empty($data['tanggal_akhir']) ) {
			
			$query .= "WHERE tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ORDER BY tanggal ASC";
			$this->db->query($query);
			$this->db->bind('tanggal_awal', $data['tanggal_awal']);
			$this->db->bind('tanggal_akhir', $data['tanggal_akhir']);

			return $this->db->all();
		}
		else if ( !empty($data['no_return_penjualan']) ) {

			$query .= " rpj JOIN return_penjualan_detail rpjd ON rpj.no_return_penjualan = rpjd.no_return_penjualan
				JOIN barang brg ON rpjd.item = brg.item
				JOIN user usr ON rpj.id_user = usr.id_user
				WHERE rpj.no_return_penjualan = :no_return_penjualan
				ORDER BY rpjd.item ASC";
			$this->db->query($query);
			$this->db->bind('no_return_penjualan', $data['no_return_penjualan']);
			return $this->db->all();
		}
		else {
			
			$tanggal = date('Y-m-d');
			$query .= "WHERE tanggal = :tanggal ORDER BY no_return_penjualan DESC";
			$this->db->query($query);
			$this->db->bind('tanggal', $tanggal);
			return $this->db->all();
		}
	}



	// membuat no return penjualan
	public function get_no_return_penjualan()
	{

		$bulan = date('ym');
		$query = "SELECT max(no_return_penjualan) AS max FROM return_penjualan WHERE no_return_penjualan LIKE :bulan";
		
		$this->db->query($query);
		$this->db->bind('bulan', "%$bulan%");

		$data = $this->db->single();
		$no = $data['max'];

		$urut = substr($no, 9, 4);
		$tambah = (int) $urut + 1;

		if (strlen($tambah) == 1) {
			$format = "RPJ"."-".$bulan."-"."000".$tambah;
		}
		else if (strlen($tambah) == 2) {
			$format = "RPJ"."-".$bulan."-"."00".$tambah;
		}
		else if (strlen($tambah) == 3) {
			$format = "RPJ"."-".$bulan."-"."0".$tambah;
		}
		else {
			$format = "RPJ"."-".$bulan."-".$tambah;
		}
		return $format;

		return $format; 
	}



	// mengambil data tabel return_penjualan_list
	public function get_return_penjualan_list()
	{
		$query = "SELECT * FROM return_penjualan_list";
		$this->db->query($query);
		return $this->db->all();
	}



	// tambah data tabel return_penjualan_list
	public function tambah_rpj_list($data)
	{
		$no_rpj = $this->get_no_return_penjualan();
		$subtotal = $data['qty'] * $data['harga_jual'];

		$query = "INSERT INTO return_penjualan_list(no_return_penjualan, item, deskripsi, harga_jual, qty, subtotal)
			VALUES(:no_return_penjualan, :item, :deskripsi, :harga_jual, :qty, :subtotal)";

		$this->db->query($query);

		$this->db->bind('no_return_penjualan', $no_rpj);
		$this->db->bind('item', strtoupper($data['item']));
		$this->db->bind('deskripsi', $data['deskripsi']);
		$this->db->bind('harga_jual', $data['harga_jual']);
		$this->db->bind('qty', $data['qty']);
		$this->db->bind('subtotal', $subtotal);

		$this->db->execute();

		return $this->db->rowCount();
	}



	// mengambil grand total list return penjualan
	public function get_grand_total()
	{
		$no_rpj = $this->get_no_return_penjualan();
		$query = "SELECT SUM(subtotal) AS total FROM return_penjualan_list WHERE no_return_penjualan = :no_return_penjualan";

		$this->db->query($query);
		$this->db->bind('no_return_penjualan', $no_rpj);
		$data = $this->db->single();

		return $data['total'];
	}



	// hapus data return_penjualan_list
	public function hapus_rpj_list_by_id($id)
	{
		$query = "DELETE FROM return_penjualan_list WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// tambah data tabel return_penjualan
	public function tambah_rpj($data)
	{
		$user  = $_SESSION['gudang']['id'];
		$grand_total = $this->get_grand_total();

		$query = "INSERT INTO return_penjualan(no_return_penjualan, id_user, tanggal, keterangan, grand_total)
				VALUES(:no_return_penjualan, :id_user, :tanggal, :keterangan, :grand_total)";

		$this->db->query($query);
		$this->db->bind('no_return_penjualan', $data['no_return_penjualan']);
		$this->db->bind('id_user', $user);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('keterangan', $data['keterangan']);
		$this->db->bind('grand_total', $grand_total);

		$this->db->execute();

		return $this->db->rowCount();
	}



	// tambah data tabel return_penjualan_detail
	public function tambah_rpj_detail($data)
	{
		$query = "INSERT INTO return_penjualan_detail (no_return_penjualan, item, qty, subtotal) SELECT no_return_penjualan, item, qty, subtotal FROM return_penjualan_list WHERE no_return_penjualan = :no_return_penjualan";

		$this->db->query($query);
		$this->db->bind( 'no_return_penjualan', $data['no_return_penjualan']);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// hapus semua data tabel return_penjualan_list
	public function hapus_semua_rpj_list()
	{
		$query = "DELETE FROM return_penjualan_list";
		$this->db->query($query);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// menjumlahkan qty return penjualan list
	public function get_sum_qty_list()
	{
		$query = "SELECT SUM(qty) AS sum FROM return_penjualan_list";
		$this->db->query($query);
		$result = $this->db->single();

		return $result['sum'];
	}



	// menjumlahkan qty return penjualan detail
	public function get_sum_qty_detail($data)
	{
		$query = "SELECT SUM(qty) AS sum FROM return_penjualan_detail WHERE no_return_penjualan = :no_return_penjualan";
		$this->db->query($query);
		$this->db->bind('no_return_penjualan', $data);
		$result = $this->db->single();

		return $result['sum'];
	}
}

?>