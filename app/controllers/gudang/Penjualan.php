<?php


/**
 *  CLASS PENJUALAN
 */
class Penjualan extends Controller
{
	
	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method index penjualan
	public function index($tanggal_awal = null, $tanggal_akhir = null)
	{
		$data['judul'] = 'Penjualan';
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,
		];

		if ( $tanggal_awal != null && $tanggal_akhir != null ) {
			$data['penjualan'] = $this->model('Penjualan_model')->get_penjualan($data['filter']);
		}
		else{
			$data['penjualan'] = $this->model('Penjualan_model')->get_penjualan();
		}

		$this->view('templates/header', $data);
		$this->view('gudang/penjualan/index', $data);
		$this->view('templates/footer', $data);
	}



	// method halaman transaksi
	public function transaksi()
	{
		$data['judul'] = 'Tambah Penjualan';
		$data['brg'] = $this->model('Barang_model')->get_barang();
		$data['no_penjualan'] = $this->model('Penjualan_model')->get_no_penjualan();
		$data['penjualan_list'] = $this->model('Penjualan_model')->get_penjualan_list();
		$data['grand_total'] = $this->model('Penjualan_model')->get_grand_total();
		$data['sum_qty'] = $this->model('Penjualan_model')->get_sum_qty_list();

		$this->view('templates/header', $data);
		$this->view('gudang/penjualan/transaksi', $data);
		$this->view('gudang/modal/modal_view_barang', $data);
		$this->view('templates/footer', $data);
	}



	// method tambah list penjualan
	public function tambah()
	{
		if ( isset($_POST['tambah']) ) {

			if ( !empty($_POST['item']) && !empty($_POST['deskripsi']) && !empty($_POST['harga_jual']) && !empty($_POST['qty']) ) {

				if ( $this->model('Barang_model')->get_barang_by_item($_POST['item']) != null ) {

					$qty = $_POST['qty'];
					$stok = $this->model('Barang_model')->get_stok_by_item($_POST['item']);

					if ( $qty < $stok['stok'] ) {

						if ( $this->model('Penjualan_model')->tambah_penjualan_list($_POST) > 0 ) {
							Flash::set_flash('Ditambahkan kedalam list', 'success');
							header('location:'.BASEURL.'/Penjualan/transaksi');
							exit();
						}
						else {
							Flash::set_flash('Gagal ditambahkan kedalam list', 'error');
							header('location:'.BASEURL.'/Penjualan/transaksi');
							exit();
						}
					}
					else {
						Flash::set_flash('Jumlah stok yang tersedia tidak cukup', 'warning');
						header('location:'.BASEURL.'/Penjualan/transaksi');
						exit;
					}
				}
				else {
					Flash::set_flash('Item tidak ada', 'info');
					header('location:'.BASEURL.'/Penjualan/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Penjualan/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Penjualan/transaksi');
			exit();
		}
	}



	// method hapus list penjualan
	public function hapus()
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);

			for ($i = 0; $i < $count; $i++) : 
				$jml = $this->model('Penjualan_model')->hapus_penjualan_list_by_id($_POST['data'][$i]);
			endfor;

			if ( $jml > 0 ) {
				Flash::set_flash($count.' List penjualan berhasil dihapus', 'success');
				header('location:'.BASEURL.'/Penjualan/transaksi');
				exit();
			}
			else {
				Flash::set_flash('List penjualan gagal dihapus', 'error');
				header('location:'.BASEURL.'/Penjualan/transaksi');
				exit();
			}
		}
		else {
			Flash::set_flash('Item tidak ada', 'error');
			header('location:'.BASEURL.'/Penjualan/transaksi');
			exit();
		}
	}



	// method simpan transaksi penjualan
	public function simpan()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['no_penjualan']) && !empty($_POST['pembayaran']) && !empty($_POST['tanggal']) ) {

				$grand_total = $this->model('Penjualan_model')->get_grand_total();

				if ( $_POST['pembayaran'] >= $grand_total ) {

					$tambah_penjualan = $this->model('Penjualan_model')->tambah_penjualan($_POST);
					$tambah_detail = $this->model('Penjualan_model')->tambah_penjualan_detail($_POST);
					$hapus_list = $this->model('Penjualan_model')->hapus_semua_penjualan_list();

					if ( $tambah_penjualan > 0 && $tambah_detail > 0 && $hapus_list > 0) {
						Flash::set_flash('Lanjut cetak nota penjualan ?', 'success', BASEURL.'/penjualan/cetak/'.$_POST['no_penjualan']);
						header('location:'.BASEURL.'/Penjualan/transaksi');
						exit();
					}
				}
				else {
					Flash::set_flash('Pembayaran kurang', 'warning');
					header('location:'.BASEURL.'/Penjualan/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/pembelian/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Penjualan/transaksi');
			exit();
		}
	}



	// contrller cetak penjualan
	public function cetak( $no_penjualan = null )
	{
		if ( $no_penjualan != null ) {

			$data['no_penjualan'] = $no_penjualan;

			$data['judul'] = 'Cetak Nota Penjualan - '.$no_penjualan;
			$data['mpdf'] = $this->mpdf();
			$data['penjualan'] = $this->model('Penjualan_model')->get_penjualan($data);
			$data['sum_qty'] = $this->model('Penjualan_model')->get_sum_qty_detail($no_penjualan);
			
			$this->view('gudang/penjualan/cetak', $data);
		}
		else {
			header('location:'.BASEURL.'/Penjualan');
			exit;
		}
	}
}




?>