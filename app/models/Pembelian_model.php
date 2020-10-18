<?php 

/**
 * class Pembelian model
 */
class Pembelian_model
{
	private $db;



	//instasiasi class database
	public function __construct()
	{
		$this->db = new Database;
	}



	// ambil data pembelian
	public function get_pembelian($data = null)
	{
		$query = "SELECT * FROM pembelian pem JOIN supplier spl ON pem.id_supplier = spl.id ";

		if ( !empty($data['tanggal_awal']) && !empty($data['tanggal_akhir']) ) {

			$query .= "WHERE pem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ORDER BY pem.tanggal ASC";
			$this->db->query($query);
			$this->db->bind('tanggal_awal', $data['tanggal_awal']);
			$this->db->bind('tanggal_akhir', $data['tanggal_akhir']);
			return $this->db->all();
		}
		else if ( !empty($data['no_pembelian']) ) {
			
			$query .= " JOIN pembelian_detail pemd ON pem.no_pembelian = pemd.no_pembelian
				JOIN barang brg ON pemd.item = brg.item
				JOIN user usr ON pem.id_user = usr.id_user
				WHERE pem.no_pembelian = :no_pembelian ORDER BY pemd.item ASC";
			$this->db->query($query);
			$this->db->bind('no_pembelian', $data['no_pembelian']);
			return $this->db->all();
		}
		else {

			$date = date('Y-m-d');
			$query .= "WHERE pem.tanggal = :date ORDER BY pem.no_pembelian DESC";
			$this->db->query($query);
			$this->db->bind('date', $date);
			return $this->db->all();
		}

	}



	// ambil no pembelian otomatis
	public function get_no_pembelian()
	{
		$tanggal = date('ym');
		$query = "SELECT max(no_pembelian) AS max FROM pembelian WHERE no_pembelian LIKE :tanggal";
		
		$this->db->query($query);
		$this->db->bind('tanggal', "%$tanggal%");

		$data = $this->db->single();
		$no = $data['max'];
		$urut = substr($no, 8, 4);
		$tambah = (int) $urut + 1;

		if (strlen($tambah) == 1) {
			$format = "PM"."-".$tanggal."-"."000".$tambah;
		}
		else if (strlen($tambah) == 2) {
			$format = "PM"."-".$tanggal."-"."00".$tambah;
		}
		else if (strlen($tambah) == 3) {
			$format = "PM"."-".$tanggal."-"."0".$tambah;
		}
		else {
			$format = "PM"."-".$tanggal."-".$tambah;
		}
		return $format;
	}



	// ambil data list pebelian
	public function get_list_pembelian()
	{
		$query = "SELECT * FROM pembelian_list";
		$this->db->query($query);
		return $this->db->all();
	}



	// tambah data list pembeian
	public function tambah_pembelian_list($data)
	{
		$no_pembelian = $this->get_no_pembelian();
		$qty = $data['qty'];
		$harga_beli = $data['harga_beli'];
		$subtotal = $qty * $harga_beli;

		$query = "INSERT INTO pembelian_list(no_pembelian, item, deskripsi, harga_beli, qty, subtotal)
					VALUES(:no_pembelian, :item, :deskripsi, :harga_beli, :qty, :subtotal)";
		
		$this->db->query($query);
		$this->db->bind('no_pembelian', $no_pembelian);
		$this->db->bind('item', strtoupper($data['item']));
		$this->db->bind('deskripsi', $data['deskripsi']);
		$this->db->bind('harga_beli', $data['harga_beli']);
		$this->db->bind('qty', $data['qty']);
		$this->db->bind('subtotal', $subtotal);

		$this->db->execute();

		return $this->db->rowCount();
	}



	// ambil grand total list pembelian
	public function get_grand_total()
	{
		$no_pembelian = $this->get_no_pembelian();
		$query = "SELECT SUM(subtotal) AS total FROM pembelian_list WHERE no_pembelian = :no_pembelian";

		$this->db->query($query);
		$this->db->bind('no_pembelian', $no_pembelian);
		$data = $this->db->single();

		return $data['total'];
	}



	// hapus list pembelian
	public function hapus_pembelian_list_by_id($id)
	{
		$query = "DELETE FROM pembelian_list WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}



	//tambah pembelian 
	public function tambah_pembelian($data)
	{
		$user  = $_SESSION['gudang']['id'];
		$grand_total = $this->get_grand_total();

		$query = "INSERT INTO pembelian(no_pembelian, tanggal, id_supplier, id_user, grand_total)
				VALUES(:no_pembelian, :tanggal, :id_supplier, :id_user, :grand_total)";

		$this->db->query($query);
		$this->db->bind('no_pembelian', $data['no_pembelian']);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('id_supplier', $data['supplier']);
		$this->db->bind('id_user', $user);
		$this->db->bind('grand_total', $grand_total);

		$this->db->execute();

		return $this->db->rowCount();
	}



	// tambah detail pembelian
	public function tambah_pembelian_detail($data)
	{
		$query = "INSERT INTO pembelian_detail (no_pembelian, item, qty, subtotal) SELECT no_pembelian, item, qty, subtotal FROM pembelian_list WHERE no_pembelian = :no_pembelian";

		$this->db->query($query);
		$this->db->bind( 'no_pembelian', $data['no_pembelian']);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// hapus semua list pembelian
	public function hapus_semua_pembelian_list()
	{
		$query = "DELETE FROM pembelian_list";
		$this->db->query($query);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// menghitung jumlah qty detail pembelian
	public function get_sum_qty_detail($data) {
		$query = "SELECT SUM(qty) AS sum FROM pembelian_detail WHERE no_pembelian = :no_pembelian ";
		$this->db->query($query);
		$this->db->bind('no_pembelian', $data);
		$data = $this->db->single();

		return $data['sum'];
	}



	// menghitung jumlah qty list pembelian
	public function get_sum_qty_list() {
		$query = "SELECT SUM(qty) AS sum FROM pembelian_list";
		$this->db->query($query);
		$data = $this->db->single();

		return $data['sum'];
	}
}

?>