<?php

/**
 *  CLASS PENJUALAN MODEL
 */
class Penjualan_model extends Controller
{
	private $db;



	// instasiasi class database
	public function __construct()
	{
		$this->db = new Database;
	}



	// mengambil data table penjualan
	public function get_penjualan($data = null)
	{
		$query = "SELECT * FROM penjualan ";

		if ( !empty($data['tanggal_awal']) && !empty($data['tanggal_akhir']) ) {

			$query .= "WHERE tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ORDER BY tanggal ASC";
			$this->db->query($query);
			$this->db->bind('tanggal_awal', htmlspecialchars($data['tanggal_awal']));
			$this->db->bind('tanggal_akhir', htmlspecialchars($data['tanggal_akhir']));
			return $this->db->all();
		}
		else if ( !empty($data['no_penjualan']) ) {
			
			$query .= " pen JOIN penjualan_detail pend ON pen.no_penjualan = pend.no_penjualan
				JOIN barang brg ON pend.item = brg.item
				JOIN user usr ON pen.id_user = usr.id_user
				WHERE pen.no_penjualan = :no_penjualan
				ORDER BY brg.item ASC";

			$this->db->query($query);
			$this->db->bind('no_penjualan', $data['no_penjualan']);
			return $this->db->all();
		}
		else {
			
			$date = date('Y-m-d');
			$query .= "WHERE tanggal = :date ORDER BY no_penjualan DESC";
			$this->db->query($query);
			$this->db->bind('date', $date);
			return $this->db->all();
		}

	}



	// mengambil no penjualan otomatis
	public function get_no_penjualan()
	{
		$tanggal = date('ym');
		$query = "SELECT max(no_penjualan) AS max FROM penjualan WHERE no_penjualan LIKE :tanggal";
		
		$this->db->query($query);
		$this->db->bind('tanggal', "%$tanggal%");

		$data = $this->db->single();
		$no = $data['max'];
		$urut = substr($no, 8, 4);
		$tambah = (int) $urut + 1;

		if (strlen($tambah) == 1) {
			$format = "PJ"."-".$tanggal."-"."000".$tambah;
		}
		else if (strlen($tambah) == 2) {
			$format = "PJ"."-".$tanggal."-"."00".$tambah;
		}
		else if (strlen($tambah) == 3) {
			$format = "PJ"."-".$tanggal."-"."0".$tambah;
		}
		else {
			$format = "PJ"."-".$tanggal."-".$tambah;
		}
		return $format;
	}



	// ambil data list pemnjualan
	public function get_penjualan_list()
	{
		$query = "SELECT * FROM penjualan_list";
		$this->db->query($query);
		return $this->db->all();
	}



	// tambah data list penjualan
	public function tambah_penjualan_list($data)
	{
		$no_penjualan = $this->get_no_penjualan();

		$qty = $data['qty'];
		$harga_jual = $data['harga_jual'];
		$subtotal = $qty * $harga_jual;

		$query = "INSERT INTO penjualan_list(no_penjualan, item, deskripsi, harga_jual, qty, subtotal)
				VALUES(:no_penjualan, :item, :deskripsi, :harga_jual, :qty, :subtotal)";

		$this->db->query($query);

		$this->db->bind('no_penjualan', htmlspecialchars($no_penjualan));
		$this->db->bind('item', strtoupper( htmlspecialchars( $data['item'] ) ) );
		$this->db->bind('deskripsi', htmlspecialchars($data['deskripsi']));
		$this->db->bind('harga_jual', htmlspecialchars($data['harga_jual']));
		$this->db->bind('qty', htmlspecialchars($data['qty']));
		$this->db->bind('subtotal', htmlspecialchars($subtotal));

		$this->db->execute();

		return $this->db->rowCount();
	}



	// menghitung grand total list penjualan
	public function get_grand_total()
	{
		$no_penjualan = $this->get_no_penjualan();
		$query = "SELECT SUM(subtotal) AS total FROM penjualan_list WHERE no_penjualan = :no_penjualan";

		$this->db->query($query);
		$this->db->bind('no_penjualan', htmlspecialchars($no_penjualan));
		$data = $this->db->single();

		return $data['total'];
	}



	// hapus list penjualan by id
	public function hapus_penjualan_list_by_id($id)
	{
		$query = "DELETE FROM penjualan_list WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', htmlspecialchars($id));
		$this->db->execute();

		return $this->db->rowCount();
	}



	// tambah penjualan 
	public function tambah_penjualan($data)
	{
		$user = $_SESSION['gudang']['id'];
		$grand_total = $this->get_grand_total();

		$query = "INSERT INTO penjualan(no_penjualan, tanggal, id_user, pembayaran, grand_total)
				VALUES(:no_penjualan, :tanggal, :id_user, :pembayaran, :grand_total)";

		$this->db->query($query);

		$this->db->bind('no_penjualan', htmlspecialchars($data['no_penjualan']));
		$this->db->bind('tanggal', htmlspecialchars($data['tanggal']));
		$this->db->bind('id_user', htmlspecialchars($user));
		$this->db->bind('pembayaran', htmlspecialchars($data['pembayaran']));
		$this->db->bind('grand_total', htmlspecialchars($grand_total));

		$this->db->execute();
		return $this->db->rowCount();
	}



	// tambah tabel penjualan detail
	public function tambah_penjualan_detail($data)
	{
		$query = "INSERT INTO penjualan_detail(no_penjualan, item, qty, subtotal) SELECT no_penjualan, item, qty, subtotal FROM penjualan_list WHERE no_penjualan = :no_penjualan";
		$this->db->query($query);
		$this->db->bind('no_penjualan', htmlspecialchars($data['no_penjualan']));
		$this->db->execute();
		return $this->db->rowCount();

	}



	// hapus semua isi dari tabel penjualan list
	public function hapus_semua_penjualan_list()
	{
		$query = "DELETE FROM penjualan_list";
		$this->db->query($query);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// menjumlahkan qty penjualan list
	public function get_sum_qty_list()
	{
		$query = "SELECT SUM(qty) AS sum FROM penjualan_list";
		$this->db->query($query);
		$result = $this->db->single();

		return $result['sum'];
	}



	// menjumlahkan qty penjualan detail
	public function get_sum_qty_detail($data)
	{
		$query = "SELECT SUM(qty) AS sum FROM penjualan_detail WHERE no_penjualan = :no_penjualan";
		$this->db->query($query);
		$this->db->bind('no_penjualan', $data);
		$result = $this->db->single();

		return $result['sum'];
	}
}

?>