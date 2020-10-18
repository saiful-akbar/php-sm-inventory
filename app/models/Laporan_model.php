<?php

/**
 * CLASS LAPORAN_MODEL
 */
class Laporan_model extends Controller
{
	private $db;
	


	public function __construct()
	{
		$this->db = new Database;
	}






	/**
	 * METHOD LAPORAN PEMBELIAN
	 */

	// menampilkan data laporan pembelian
	public function get_lap_pembelian($data)
	{
		$query = "SELECT * FROM pembelian pem
			JOIN pembelian_detail dpem ON pem.no_pembelian = dpem.no_pembelian
			JOIN barang brg ON dpem.item = brg.item
			JOIN supplier sup ON pem.id_supplier = sup.id
			WHERE pem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_pembelian'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND pem.no_pembelian = :no_pembelian AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_pembelian', strtoupper($data['filter']['no_pembelian']));
			$this->db->bind('item', $data['filter']['item']);
		}
		else if ( $data['filter']['no_pembelian'] != '0') {
			$query .= "AND pem.no_pembelian = :no_pembelian";
			
			$this->db->query($query);
			$this->db->bind('no_pembelian', $data['filter']['no_pembelian']);
		}
		else if ( $data['filter']['item'] != '0') {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', $data['filter']['item']);
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);
		
		return $this->db->all();
	}



	// menampilkan data grand total laporan pembelian 
	public function get_grand_total_lap_pembelian($data)
	{
		$query = "SELECT sum(subtotal) AS sum FROM pembelian_detail dpem
			JOIN pembelian pem ON pem.no_pembelian = dpem.no_pembelian
			JOIN barang brg ON dpem.item = brg.item
			JOIN supplier sup ON pem.id_supplier = sup.id
			WHERE pem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_pembelian'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND pem.no_pembelian = :no_pembelian AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_pembelian', strtoupper($data['filter']['no_pembelian']));
			$this->db->bind('item', strtoupper($data['filter']['item']));			
		}
		else if ( $data['filter']['no_pembelian'] != '0' ) {
			$query .= "AND pem.no_pembelian = :no_pembelian";
			
			$this->db->query($query);
			$this->db->bind('no_pembelian', strtoupper($data['filter']['no_pembelian']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}



	// menampilkan data total qty laporan pembelian 
	public function get_total_qty_lap_pembelian($data)
	{
		$query = "SELECT sum(qty) AS sum FROM pembelian_detail dpem
			JOIN pembelian pem ON pem.no_pembelian = dpem.no_pembelian
			JOIN barang brg ON dpem.item = brg.item
			JOIN supplier sup ON pem.id_supplier = sup.id
			WHERE pem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_pembelian'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND pem.no_pembelian = :no_pembelian AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_pembelian', strtoupper($data['filter']['no_pembelian']));
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else if ( $data['filter']['no_pembelian'] != '0' ) {
			$query .= "AND pem.no_pembelian = :no_pembelian";
			
			$this->db->query($query);
			$this->db->bind('no_pembelian', strtoupper($data['filter']['no_pembelian']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}






	/**
	 * METHOD LAPORAN PENJUALAN
	 */

	// menampilkan data laporan penjualan
	public function get_lap_penjualan($data)
	{
		$query = "SELECT * FROM penjualan pem
			JOIN penjualan_detail dpem ON pem.no_penjualan = dpem.no_penjualan
			JOIN barang brg ON dpem.item = brg.item
			WHERE pem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_penjualan'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND pem.no_penjualan = :no_penjualan AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_penjualan', strtoupper($data['filter']['no_penjualan']));
			$this->db->bind('item', $data['filter']['item']);
		}
		else if ( $data['filter']['no_penjualan'] != '0') {
			$query .= "AND pem.no_penjualan = :no_penjualan";
			
			$this->db->query($query);
			$this->db->bind('no_penjualan', $data['filter']['no_penjualan']);
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', $data['filter']['item']);
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);
		
		return $this->db->all();
	}



	// menampilkan data grand total laporan penjualan 
	public function get_grand_total_lap_penjualan($data)
	{
		$query = "SELECT sum(subtotal) AS sum FROM penjualan_detail dpem
			JOIN penjualan pem ON pem.no_penjualan = dpem.no_penjualan
			JOIN barang brg ON dpem.item = brg.item
			WHERE pem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_penjualan'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND pem.no_penjualan = :no_penjualan AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_penjualan', strtoupper($data['filter']['no_penjualan']));
			$this->db->bind('item', strtoupper($data['filter']['item']));			
		}
		else if ( $data['filter']['no_penjualan'] != '0' ) {
			$query .= "AND pem.no_penjualan = :no_penjualan";
			
			$this->db->query($query);
			$this->db->bind('no_penjualan', strtoupper($data['filter']['no_penjualan']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}



	// menampilkan data total qty laporan penjualan 
	public function get_total_qty_lap_penjualan($data)
	{
		$query = "SELECT sum(qty) AS sum FROM penjualan_detail dpem
			JOIN penjualan pem ON pem.no_penjualan = dpem.no_penjualan
			JOIN barang brg ON dpem.item = brg.item
			WHERE pem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_penjualan'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND pem.no_penjualan = :no_penjualan AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_penjualan', strtoupper($data['filter']['no_penjualan']));
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else if ( $data['filter']['no_penjualan'] != '0' ) {
			$query .= "AND pem.no_penjualan = :no_penjualan";
			
			$this->db->query($query);
			$this->db->bind('no_penjualan', strtoupper($data['filter']['no_penjualan']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}






	/**
	 * METHODE LAPORAN RETURN PEMBELIAN
	 */

	// menampilkan data laporan return pembelian
	public function get_lap_return_pembelian($data)
	{
		$query = "SELECT * FROM return_pembelian rpem
			JOIN return_pembelian_detail rdpem ON rpem.no_return_pembelian = rdpem.no_return_pembelian
			JOIN barang brg ON rdpem.item = brg.item
			WHERE rpem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_return_pembelian'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND rpem.no_return_pembelian = :no_return_pembelian AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_return_pembelian', strtoupper($data['filter']['no_return_pembelian']));
			$this->db->bind('item', $data['filter']['item']);
		}
		else if ( $data['filter']['no_return_pembelian'] != '0') {
			$query .= "AND rpem.no_return_pembelian = :no_return_pembelian";
			
			$this->db->query($query);
			$this->db->bind('no_return_pembelian', $data['filter']['no_return_pembelian']);
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', $data['filter']['item']);
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);
		
		return $this->db->all();
	}



	// menampilkan data grand total laporan return pembelian 
	public function get_grand_total_lap_return_pembelian($data)
	{
		$query = "SELECT sum(subtotal) AS sum FROM return_pembelian_detail rdpem
			JOIN return_pembelian rpem ON rpem.no_return_pembelian = rdpem.no_return_pembelian
			JOIN barang brg ON rdpem.item = brg.item
			WHERE rpem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_return_pembelian'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND rpem.no_return_pembelian = :no_return_pembelian AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_return_pembelian', strtoupper($data['filter']['no_return_pembelian']));
			$this->db->bind('item', strtoupper($data['filter']['item']));			
		}
		else if ( $data['filter']['no_return_pembelian'] != '0' ) {
			$query .= "AND rpem.no_return_pembelian = :no_return_pembelian";
			
			$this->db->query($query);
			$this->db->bind('no_return_pembelian', strtoupper($data['filter']['no_return_pembelian']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}



	// menampilkan data total qty laporan return pembelian 
	public function get_total_qty_lap_return_pembelian($data)
	{
		$query = "SELECT sum(qty) AS sum FROM return_pembelian_detail rdpem
			JOIN return_pembelian rpem ON rpem.no_return_pembelian = rdpem.no_return_pembelian
			JOIN barang brg ON rdpem.item = brg.item
			WHERE rpem.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_return_pembelian'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND rpem.no_return_pembelian = :no_return_pembelian AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_return_pembelian', strtoupper($data['filter']['no_return_pembelian']));
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else if ( $data['filter']['no_return_pembelian'] != '0' ) {
			$query .= "AND rpem.no_return_pembelian = :no_return_pembelian";
			
			$this->db->query($query);
			$this->db->bind('no_return_pembelian', strtoupper($data['filter']['no_return_pembelian']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}






	/**
	 * METHODE LAPORAN RETURN PENJUALAN
	 */

	// menampilkan data laporan return penjualan
	public function get_lap_return_penjualan($data)
	{
		$query = "SELECT * FROM return_penjualan rpen
			JOIN return_penjualan_detail rdpen ON rpen.no_return_penjualan = rdpen.no_return_penjualan
			JOIN barang brg ON rdpen.item = brg.item
			WHERE rpen.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_return_penjualan'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND rpen.no_return_penjualan = :no_return_penjualan AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_return_penjualan', strtoupper($data['filter']['no_return_penjualan']));
			$this->db->bind('item', $data['filter']['item']);
		}
		else if ( $data['filter']['no_return_penjualan'] != '0') {
			$query .= "AND rpen.no_return_penjualan = :no_return_penjualan";
			
			$this->db->query($query);
			$this->db->bind('no_return_penjualan', $data['filter']['no_return_penjualan']);
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', $data['filter']['item']);
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);
		
		return $this->db->all();
	}



	// menampilkan data grand total laporan return penjuualan
	public function get_grand_total_lap_return_penjualan($data)
	{
		$query = "SELECT sum(subtotal) AS sum FROM return_penjualan_detail rdpen
			JOIN return_penjualan rpen ON rpen.no_return_penjualan = rdpen.no_return_penjualan
			JOIN barang brg ON rdpen.item = brg.item
			WHERE rpen.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_return_penjualan'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND rpen.no_return_penjualan = :no_return_penjualan AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_return_penjualan', strtoupper($data['filter']['no_return_penjualan']));
			$this->db->bind('item', strtoupper($data['filter']['item']));			
		}
		else if ( $data['filter']['no_return_penjualan'] != '0' ) {
			$query .= "AND rpen.no_return_penjualan = :no_return_penjualan";
			
			$this->db->query($query);
			$this->db->bind('no_return_penjualan', strtoupper($data['filter']['no_return_penjualan']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}



	// menampilkan data total qty laporan return penjualan 
	public function get_total_qty_lap_return_penjualan($data)
	{
		$query = "SELECT sum(qty) AS sum FROM return_penjualan_detail rdpen
			JOIN return_penjualan rpen ON rpen.no_return_penjualan = rdpen.no_return_penjualan
			JOIN barang brg ON rdpen.item = brg.item
			WHERE rpen.tanggal BETWEEN :tanggal_awal AND :tanggal_akhir ";

		if ( $data['filter']['no_return_penjualan'] != '0' && $data['filter']['item'] != '0' ) {			
			$query .= "AND rpen.no_return_penjualan = :no_return_penjualan AND brg.item = :item";
			
			$this->db->query($query);
			$this->db->bind('no_return_penjualan', strtoupper($data['filter']['no_return_penjualan']));
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else if ( $data['filter']['no_return_penjualan'] != '0' ) {
			$query .= "AND rpen.no_return_penjualan = :no_return_penjualan";
			
			$this->db->query($query);
			$this->db->bind('no_return_penjualan', strtoupper($data['filter']['no_return_penjualan']));
		}
		else if ( $data['filter']['item'] != '0' ) {
			$query .= "AND brg.item = :item";
			$this->db->query($query);
			$this->db->bind('item', strtoupper($data['filter']['item']));
		}
		else {
			$this->db->query($query);
		}

		$this->db->bind('tanggal_awal', $data['filter']['tanggal_awal']);
		$this->db->bind('tanggal_akhir', $data['filter']['tanggal_akhir']);

		$sum = $this->db->single();
		return $sum['sum'];
	}
}


?>