<?php 

/**
 * class return penjualan
 */
class Return_penjualan extends Controller
{
	
	function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method halaman index
	public function index( $tanggal_awal = null, $tanggal_akhir = null )
	{
		$data['judul'] = 'Return Penjualan';
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir
		];

		if ( $tanggal_awal != null && $tanggal_akhir != null ) {
			$data['return_penjualan'] = $this->model('Return_penjualan_model')->get_return_penjualan($data['filter']);
		}
		else{
			$data['return_penjualan'] = $this->model('Return_penjualan_model')->get_return_penjualan();
		}


		$this->view('templates/header', $data);
		$this->view('gudang/return_penjualan/index', $data);
		$this->view('templates/footer', $data);
	}



	// method halaman transaksi/tambah return penjualan
	public function transaksi()
	{
		$data['judul'] = 'Tambah Return Penjualan';
		$data['no_return_penjualan'] = $this->model('Return_penjualan_model')->get_no_return_penjualan();
		$data['return_penjualan_list'] = $this->model('Return_penjualan_model')->get_return_penjualan_list();
		$data['brg'] = $this->model('Barang_model')->get_barang();
		$data['grand_total'] = $this->model('Return_penjualan_model')->get_grand_total();
		$data['sum_qty'] = $this->model('Return_penjualan_model')->get_sum_qty_list();

		$this->view('templates/header', $data);
		$this->view('gudang/return_penjualan/transaksi', $data);
		$this->view('gudang/modal/modal_view_barang', $data);
		$this->view('templates/footer', $data);
	}



	//method tambah list return penjualan
	public function tambah()
	{
		if ( isset($_POST['tambah']) ) {

			if ( !empty($_POST['item']) && !empty($_POST['deskripsi']) && !empty($_POST['harga_jual']) && !empty($_POST['qty']) ) {

				if ( $this->model('Barang_model')->get_barang_by_item($_POST['item']) != null ) {

					if ( $this->model('Return_penjualan_model')->tambah_rpj_list($_POST) > 0 ) {
						Flash::set_flash('Ditambahkan kedalam list', 'success');
						header('location:'.BASEURL.'/Return_penjualan/transaksi');
						exit();
					}
					else {
						Flash::set_flash('Gagal ditambahkan kedalam list', 'error');
						header('location:'.BASEURL.'/Return_penjualan/transaksi');
						exit();
					}
				}
				else {
					Flash::set_flash('Item tidak ada', 'info');
					header('location:'.BASEURL.'/Return_penjualan/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Return_penjualan/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Return_penjualan/transaksi');
		}
	}



	// hapus list return penjualan by id
	public function hapus()
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);

			for ($i = 0; $i < $count; $i++) : 
				$jml = $this->model('Return_penjualan_model')->hapus_rpj_list_by_id($_POST['data'][$i]);
			endfor;

			if ( $jml > 0 ) {
				Flash::set_flash($count.' List return penjualan berhasil dihapus', 'success');
				header('location:'.BASEURL.'/Return_penjualan/transaksi');
				exit();
			}
			else {
				Flash::set_flash('List return penjualan gagal dihapus', 'error');
				header('location:'.BASEURL.'/Return_penjualan/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Return_penjualan/transaksi');
			exit();
		}
	}



	// simpan transaksi return pmbelian
	public function simpan()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['no_return_penjualan']) && !empty($_POST['keterangan']) && !empty($_POST['tanggal']) ) {

				$tambah_rpj = $this->model('Return_penjualan_model')->tambah_rpj($_POST);
				$tambah_rpj_detail = $this->model('Return_penjualan_model')->tambah_rpj_detail($_POST);
				$hapus_rpj_list = $this->model('Return_penjualan_model')->hapus_semua_rpj_list();

				if ( $tambah_rpj > 0 && $tambah_rpj_detail > 0 && $hapus_rpj_list > 0) {
					Flash::set_flash('Lanjut cetak nota return penjualan ?', 'success', BASEURL.'/return_penjualan/cetak/'.$_POST['no_return_penjualan']);
					header('location:'.BASEURL.'/Return_penjualan/transaksi');
					exit();
				}
				else {
					Flash::set_flash('Return penjualan gagal disimpan', 'error');
					header('location:'.BASEURL.'/Return_penjualan/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Return_penjualan/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Return_penjualan/transaksi');
			exit();
		}
	}



	// method cetak transaksi return penjualan
	public function cetak( $no_return_penjualan = null )
	{
		if ( $no_return_penjualan != null ) {

			$data['no_return_penjualan'] = $no_return_penjualan;
			$data['judul'] = 'Cetak Nota Return Penjualan - '.$no_return_penjualan;
			$data['mpdf'] = $this->mpdf();
			$data['return_penjualan'] = $this->model('Return_penjualan_model')->get_return_penjualan($data);
			$data['sum_qty'] = $this->model('Return_penjualan_model')->get_sum_qty_detail($no_return_penjualan);

			$this->view('gudang/return_penjualan/cetak', $data);
		}
		else {
			header('location:'.BASEURL.'/Return_penjualan');
			exit;
		}
	}
}

?>