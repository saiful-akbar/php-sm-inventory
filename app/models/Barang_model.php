<?php

/**
 * class model barang
 */
class Barang_model
{
	private $db;



	public function __construct()
	{
		$this->db = new Database;
	}



	// ambil data barang
	public function get_barang( $data = null )
	{	
		$query = "SELECT * FROM barang brg JOIN kategori_barang kbrg ON brg.id_kategori = kbrg.id_kategori ";

		if ( !empty($data) ) {
			$query .= "WHERE brg.item = :item ORDER BY brg.item ASC";
		}
		else {
			$query .= "ORDER BY brg.item ASC";
		}
		
		$this->db->query($query);
		$this->db->bind('item', $data);
		return $this->db->all();	
	}



	// ambil data barang by id
	public function get_barang_by_id($id)
	{
		$query = "SELECT * FROM barang brg JOIN kategori_barang kbrg ON brg.id_kategori = kbrg.id_kategori WHERE brg.id = :id";
		$this->db->query($query);
		$this->db->bind('id', $id);
		return $this->db->single();
	}



	// ambil data barang by item
	public function get_barang_by_item($item)
	{
		$query = "SELECT * FROM barang brg JOIN kategori_barang kbrg ON brg.id_kategori = kbrg.id_kategori WHERE brg.item = :item";
		$this->db->query($query);
		$this->db->bind('item', $item);
		return $this->db->single();
	}



	// tambah data barang
	public function tambah_data_barang($data)
	{
		$query = "INSERT INTO 
		barang (id_kategori, item, deskripsi, unit, harga_beli, harga_jual, stok) 
		VALUES(:id_kategori, :item, :deskripsi, :unit, :harga_beli, :harga_jual, :stok
	) ";

	$this->db->query($query);

	$this->db->bind('id_kategori', $data['kategori']);
	$this->db->bind('item', strtoupper($data['item']));
	$this->db->bind('deskripsi', $data['deskripsi']);
	$this->db->bind('unit', $data['unit']);
	$this->db->bind('harga_beli', $data['harga_beli']);
	$this->db->bind('harga_jual', $data['harga_jual']);
	$this->db->bind('stok', $data['stok']);

	$this->db->execute();

	return $this->db->rowCount();
}



	// hapus data barang
public function hapus_data_barang($id)
{
	$query = "DELETE FROM barang WHERE id = :id";
	$this->db->query($query);
	$this->db->bind('id', $id);
	$this->db->execute();
	return $this->db->rowCount();
}



	// validasi ubah data barang
public function ubah_validasi($data)
{
	$query = "SELECT * FROM barang WHERE item = :item AND id != :id";

	$this->db->query($query);
	$this->db->bind('item', strtoupper($data['item']));
	$this->db->bind('id', $data['id']);

	return $this->db->single();
}



	// ubah data barang
public function ubah_data_barang($data)
{
	$query = "UPDATE barang SET
	id_kategori = :id_kategori,
	item = :item,
	deskripsi = :deskripsi,
	unit = :unit,
	harga_beli = :harga_beli,
	harga_jual = :harga_jual,
	stok = :stok
	WHERE id = :id";
	
	$this->db->query($query);

	$this->db->bind('id_kategori', $data['kategori']);
	$this->db->bind('item', strtoupper($data['item']));
	$this->db->bind('deskripsi', $data['deskripsi']);
	$this->db->bind('unit', $data['unit']);
	$this->db->bind('harga_beli', $data['harga_beli']);
	$this->db->bind('harga_jual', $data['harga_jual']);
	$this->db->bind('stok', $data['stok']);
	$this->db->bind('id', $data['id']);

	$this->db->execute();

	return $this->db->rowCount();
}



	// mengambil qty barang by item
public function get_stok_by_item( $data )
{
	$query = "SELECT stok FROM barang WHERE item = :item";
	$this->db->query($query);
	$this->db->bind('item', strtoupper($data));
	return $this->db->single();
} 
}

?>

















