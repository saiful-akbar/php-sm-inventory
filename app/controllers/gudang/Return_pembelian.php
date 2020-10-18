<?php

/**
 * CLASS RETURN PEMBELIAN
 */
class Return_pembelian extends Controller
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
		$data['judul'] = 'Return Pembelian';
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir
		];

		if ( $tanggal_awal != null && $tanggal_akhir != null ) {
			$data['return_pembelian'] = $this->model('Return_pembelian_model')->get_return_pembelian($data['filter']);
		}
		else{
			$data['return_pembelian'] = $this->model('Return_pembelian_model')->get_return_pembelian();
		}


		$this->view('templates/header', $data);
		$this->view('gudang/return_pembelian/index', $data);
		$this->view('templates/footer', $data);
	}



	// method halaman transaksi/tambah return pembelian
	public function transaksi()
	{
		$data['judul'] = 'Tambah Return Pembelian';
		$data['no_return_pembelian'] = $this->model('Return_pembelian_model')->get_no_return_pembelian();
		$data['return_pembelian_list'] = $this->model('Return_pembelian_model')->get_return_pembelian_list();
		$data['brg'] = $this->model('Barang_model')->get_barang();
		$data['grand_total'] = $this->model('Return_pembelian_model')->get_grand_total();
		$data['sum_qty'] = $this->model('Return_pembelian_model')->get_sum_qty_list();

		$this->view('templates/header', $data);
		$this->view('gudang/return_pembelian/transaksi', $data);
		$this->view('gudang/modal/modal_view_barang', $data);
		$this->view('templates/footer', $data);
	}



	//method tambah list return pembelian
	public function tambah()
	{
		if ( isset($_POST['tambah']) ) {

			if ( !empty($_POST['item']) && !empty($_POST['deskripsi']) && !empty($_POST['harga_beli']) && !empty($_POST['qty']) ) {

				if ( $this->model('Barang_model')->get_barang_by_item($_POST['item']) != null ) {

					if ( $this->model('Return_pembelian_model')->tambah_rpm_list($_POST) > 0 ) {
						Flash::set_flash('Ditambahkan kedalam list', 'success');
						header('location:'.BASEURL.'/Return_pembelian/transaksi');
						exit();
					}
					else {
						Flash::set_flash('Gagal ditambahkan kedalam list', 'error');
						header('location:'.BASEURL.'/Return_pembelian/transaksi');
						exit();
					}
				}
				else {
					Flash::set_flash('Item tidak ada', 'info');
					header('location:'.BASEURL.'/Return_pembelian/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Return_pembelian/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Return_pembelian/transaksi');
		}
	}



	// hapus list return pembelian by id
	public function hapus()
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);

			for ($i = 0; $i < $count; $i++) : 
				$jml = $this->model('Return_pembelian_model')->hapus_rpm_list_by_id($_POST['data'][$i]);
			endfor;

			if ( $jml > 0 ) {
				Flash::set_flash($count.' List return pembelian berhasil dihapus', 'success');
				header('location:'.BASEURL.'/Return_pembelian/transaksi');
				exit();
			}
			else {
				Flash::set_flash('List return pembelian gagal dihapus', 'error');
				header('location:'.BASEURL.'/Return_pembelian/transaksi');
				exit();
			}

		}
		else {
			header('location:'.BASEURL.'/Return_pembelian/transaksi');
			exit();
		}
	}



	// simpan transaksi return pmbelian
	public function simpan()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['no_return_pembelian']) && !empty($_POST['tanggal']) && !empty($_POST['keterangan']) ) {

				$tambah_rpm = $this->model('Return_pembelian_model')->tambah_rpm($_POST);
				$tambah_rpm_detail = $this->model('Return_pembelian_model')->tambah_rpm_detail($_POST);
				$hapus_rpm_list = $this->model('Return_pembelian_model')->hapus_semua_rpm_list();
				
				if ( $tambah_rpm > 0 && $tambah_rpm_detail > 0 && $hapus_rpm_list > 0) {
					Flash::set_flash('Lanjut cetak nota return pembelian ?', 'success', BASEURL.'/return_pembelian/cetak/'.$_POST['no_return_pembelian']);
					header('location:'.BASEURL.'/Return_pembelian/transaksi');
					exit();
				}
				else {
					Flash::set_flash('Return pembelian gagal disimpan', 'error');
					header('location:'.BASEURL.'/Return_pembelian/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Return_pembelian/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Return_pembelian/transaksi');
			exit();
		}
	}



	// method cetak transaksi return pembelian
	public function cetak( $no_return_pembelian = null )
	{
		if ( $no_return_pembelian != null ) {

			$data['no_return_pembelian'] = $no_return_pembelian;
			$data['judul'] = 'Cetak Nota Return Pembelian - '. $no_return_pembelian;
			$data['mpdf'] = $this->mpdf();
			$data['return_pembelian'] = $this->model('Return_pembelian_model')->get_return_pembelian($data);
			$data['sum_qty'] = $this->model('Return_pembelian_model')->get_sum_qty_detail($no_return_pembelian);
			
			$this->view('gudang/return_pembelian/cetak', $data);
		}
		else {
			header('location:'.BASEURL.'/Return_pembelian');
			exit;
		}
	}
}



?>