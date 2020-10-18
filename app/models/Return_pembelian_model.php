<?php 

/**
 * Class return pembelian model
 */
class Return_pembelian_model
{
	private $db;
	


	// inisialisasi class database
	public function __construct()
	{
		$this->db = new Database;
	}



	// ambil data tabel return_pembelian
	public function get_return_pembelian($data = null)
	{
		$query = "SELECT * FROM return_pembelian ";

		if ( !empty($data['tanggal_awal']) && !empty($data['tanggal_akhir']) ) {
			
			$query .= "WHERE tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ORDER BY tanggal ASC";
			$this->db->query($query);
			$this->db->bind('tanggal_awal', $data['tanggal_awal']);
			$this->db->bind('tanggal_akhir', $data['tanggal_akhir']);

			return $this->db->all();
		}
		elseif ( !empty($data['no_return_pembelian']) ) {
			
			$query .= " rpm JOIN return_pembelian_detail rpmd ON rpm.no_return_pembelian = rpmd.no_return_pembelian
				JOIN barang brg ON rpmd.item = brg.item
				JOIN user usr ON rpm.id_user = usr.id_user
				WHERE rpm.no_return_pembelian = :no_return_pembelian
				ORDER BY rpmd.item ASC";
			$this->db->query($query);
			$this->db->bind('no_return_pembelian', $data['no_return_pembelian']);
			return $this->db->all();
		}
		else {
			
			$tanggal = date('Y-m-d');
			$query .= "WHERE tanggal = :tanggal ORDER BY no_return_pembelian DESC";
			$this->db->query($query);
			$this->db->bind('tanggal', $tanggal);
			return $this->db->all();
		}
	}



	// membuat no return pembelian
	public function get_no_return_pembelian()
	{

		$bulan = date('ym');
		$query = "SELECT max(no_return_pembelian) AS max FROM return_pembelian WHERE no_return_pembelian LIKE :bulan";
		
		$this->db->query($query);
		$this->db->bind('bulan', "%$bulan%");

		$data = $this->db->single();
		$no = $data['max'];

		$urut = substr($no, 9, 4);
		$tambah = (int) $urut + 1;

		if (strlen($tambah) == 1) {
			$format = "RPM"."-".$bulan."-"."000".$tambah;
		}
		else if (strlen($tambah) == 2) {
			$format = "RPM"."-".$bulan."-"."00".$tambah;
		}
		else if (strlen($tambah) == 3) {
			$format = "RPM"."-".$bulan."-"."0".$tambah;
		}
		else {
			$format = "RPM"."-".$bulan."-".$tambah;
		}
		return $format;

		return $format; 
	}



	// mengambil data tabel return_pembelian_list
	public function get_return_pembelian_list()
	{
		$query = "SELECT * FROM return_pembelian_list";
		$this->db->query($query);
		return $this->db->all();
	}



	// tambah data tabel return_pembelian_list
	public function tambah_rpm_list($data)
	{
		$no_rpm = $this->get_no_return_pembelian();
		$subtotal = $data['qty'] * $data['harga_beli'];

		$query = "INSERT INTO return_pembelian_list(no_return_pembelian, item, deskripsi, harga_beli, qty, subtotal)
			VALUES(:no_return_pembelian, :item, :deskripsi, :harga_beli, :qty, :subtotal)";

		$this->db->query($query);

		$this->db->bind('no_return_pembelian', $no_rpm);
		$this->db->bind('item', $data['item']);
		$this->db->bind('deskripsi', $data['deskripsi']);
		$this->db->bind('harga_beli', $data['harga_beli']);
		$this->db->bind('qty', $data['qty']);
		$this->db->bind('subtotal', $subtotal);

		$this->db->execute();

		return $this->db->rowCount();
	}



	// mengambil grand total list return pembelian
	public function get_grand_total()
	{
		$no_rpm = $this->get_no_return_pembelian();
		$query = "SELECT SUM(subtotal) AS total FROM return_pembelian_list WHERE no_return_pembelian = :no_return_pembelian";

		$this->db->query($query);
		$this->db->bind('no_return_pembelian', $no_rpm);
		$data = $this->db->single();

		return $data['total'];
	}



	// hapus data return_pembelian_list
	public function hapus_rpm_list_by_id($id)
	{
		$query = "DELETE FROM return_pembelian_list WHERE id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// tambah data tabel return_pembelian
	public function tambah_rpm($data)
	{
		$user  = $_SESSION['gudang']['id'];
		$grand_total = $this->get_grand_total();

		$query = "INSERT INTO return_pembelian(no_return_pembelian, id_user, tanggal, keterangan, grand_total)
				VALUES(:no_return_pembelian, :id_user, :tanggal, :keterangan, :grand_total)";

		$this->db->query($query);
		$this->db->bind('no_return_pembelian', $data['no_return_pembelian']);
		$this->db->bind('id_user', $user);
		$this->db->bind('tanggal', $data['tanggal']);
		$this->db->bind('keterangan', $data['keterangan']);
		$this->db->bind('grand_total', $grand_total);

		$this->db->execute();

		return $this->db->rowCount();
	}



	// tambah data tabel return_pembelian_detail
	public function tambah_rpm_detail($data)
	{
		$query = "INSERT INTO return_pembelian_detail (no_return_pembelian, item, qty, subtotal) SELECT no_return_pembelian, item, qty, subtotal FROM return_pembelian_list WHERE no_return_pembelian = :no_return_pembelian";

		$this->db->query($query);
		$this->db->bind( 'no_return_pembelian', $data['no_return_pembelian']);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// hapus semua data tabel return_pembelian_list
	public function hapus_semua_rpm_list()
	{
		$query = "DELETE FROM return_pembelian_list";
		$this->db->query($query);
		$this->db->execute();

		return $this->db->rowCount();
	}



	// menjumlahkan qty return pembelian list
	public function get_sum_qty_list()
	{
		$query = "SELECT SUM(qty) AS sum FROM return_pembelian_list";
		$this->db->query($query);
		$result = $this->db->single();

		return $result['sum'];
	}



	// menjumlahkan qty return pembelian detail
	public function get_sum_qty_detail($data)
	{
		$query = "SELECT SUM(qty) AS sum FROM return_pembelian_detail WHERE no_return_pembelian = :no_return_pembelian";
		$this->db->query($query);
		$this->db->bind('no_return_pembelian', $data);
		$result = $this->db->single();

		return $result['sum'];
	}
}

?>