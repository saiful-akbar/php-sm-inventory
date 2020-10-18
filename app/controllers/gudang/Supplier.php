<?php


/**
 * Class Supplier
 */
class Supplier extends Controller
{	
	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/logout');
		}
	}



	// controler index supplier
	public function index()
	{
		$data['judul'] = 'Supplier';
		$data['spl'] = $this->model('Supplier_model')->get_supplier();
		$data['kode'] = $this->model('Supplier_model')->kode_otomatis();
		

		$this->view('templates/header', $data);
		$this->view('gudang/supplier/index', $data);
		$this->view('templates/footer', $data);
	}



	// controller tambah data supplier
	public function tambah()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['kode']) && !empty($_POST['nama']) && !empty($_POST['kontak']) && !empty($_POST['kota']) && !empty($_POST['alamat']) ) {

				if ( $this->model('Supplier_model')->tambah_data($_POST) > 0 ) {
					Flash::set_flash('Data Supplier berhasil ditambahkan', 'success');
					header('location:'.BASEURL.'/supplier');
					exit();
				}
				else {
					Flash::set_flash('Data Supplier gagal ditambahkan', 'error');
					header('location:'.BASEURL.'/supplier');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/supplier');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/supplier');
			exit();
		}
	}



	// controller ajax json supplier
	public function get_ubah()
	{
		echo json_encode( $this->model('Supplier_model')->get_supplier($_POST['id']) );
	}



	// controller ubah supplier
	public function ubah()
	{	
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['kode']) && !empty($_POST['nama']) && !empty($_POST['kontak']) && !empty($_POST['kota']) && !empty($_POST['alamat']) ) {

				if ( $this->model('Supplier_model')->ubah_data($_POST) > 0 ) {
					Flash::set_flash('Data Supplier berhasil diubah', 'success');
					header('location:'.BASEURL.'/supplier');
					exit();
				}
				else {
					Flash::set_flash('Data supplier gagal diubah', 'error');
					header('location:'.BASEURL.'/supplier');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/supplier');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/supplier');
			exit();
		}
	}



	// controller hapus supplier
	public function hapus()
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);

			for ($i=0; $i < $count; $i++) { 
				$hapus = $this->model('Supplier_model')->hapus_data($_POST['data'][$i]);
			}

			if ( $hapus > 0 ) {
				Flash::set_flash($count.' Data supplier berhasil dihapus', 'success');
				header('location:'.BASEURL.'/supplier');
				exit();
			}
			else {
				Flash::set_flash('Data supplier gagal dihapus', 'error');
				header('location:'.BASEURL.'/supplier');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/supplier');
			exit();
		}
	}



	// contrller cetak supplier
	public function cetak()
	{
		$data['judul'] = 'Cetak - Laporan Data Supplier';
		$data['mpdf'] = $this->mpdfl();
		$data['spl'] = $this->model('Supplier_model')->get_supplier();
		$data['kode'] = $this->model('Supplier_model')->kode_otomatis();

		$this->view('gudang/supplier/cetak', $data);
	}
}


?>