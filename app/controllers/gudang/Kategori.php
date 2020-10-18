<?php


/**
 * class Kategori Barang
 */
class Kategori extends Controller
{
	
	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method index kategori barang
	public function index()
	{
		$data['judul'] = 'Kategori';
		$data['kategori'] = $this->model('Kategori_model')->get_kategori();

		$this->view('templates/header', $data);
		$this->view('gudang/kategori/index', $data);
		$this->view('templates/footer', $data);
	}



	// method tambah data kategori
	public function tambah()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['nama_kategori']) ) {

				if ( $this->model('Kategori_model')->get_kategory_by_nama($_POST) == null ) {

					if ( $this->model('Kategori_model')->tambah_data($_POST) > 0 ) {
						Flash::set_flash('Data kategori berhasil ditambahkan', 'success');
						header('location:'.BASEURL.'/Kategori');
						exit;
					}
					else {
						Flash::set_flash('Data gagal ditambahkan', 'error');
						header('location:'.BASEURL.'/Kategori');
						exit;
					}
				}
				else {
					Flash::set_flash('Nama kategori sudah digunakan', 'warning');
					header('location:'.BASEURL.'/Kategori');
					exit;
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Kategori');
				exit;
			}
		}
		else {
			header('location:'.BASEURL.'/Kategori');
			exit;
		}
	}



	// methode ajax json kategori
	public function get_ubah()
	{
		echo json_encode( $this->model('Kategori_model')->get_kategori($_POST) );
	}



	// method ubah data kategori
	public function ubah()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['nama_kategori']) ) {

				if ( $this->model('Kategori_model')->ubah_validasi($_POST) == null ) {

					if ( $this->model('Kategori_model')->ubah_data($_POST) > 0 ) {
						Flash::set_flash('Data katgori berhasil diubah', 'success');
						header('location:'.BASEURL.'/Kategori');
						exit;
					}
					else {
						Flash::set_flash('Data kategori gagal diubah', 'error');
						header('location:'.BASEURL.'/Kategori');
						exit;
					}
				}
				else {
					Flash::set_flash('Nama kategori sudah digunakan', 'warning');
					header('location:'.BASEURL.'/Kategori');
					exit;
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Kategori');
				exit;
			}
			
		}
		else {
			header('location:'.BASEURL.'/Kategori');
			exit;
		}
	}



	// method hapus data kategori
	public function hapus( $id = null )
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);

			for ($i=0; $i < $count; $i++) :
				$jml = $this->model('Kategori_model')->hapus_data( $_POST['data'][$i] );
			endfor;

			if ( $jml > 0 ) {
				Flash::set_flash($count.' Data kategori berhasil dihapus', 'success');
				header('location:'.BASEURL.'/Kategori');
				exit;
			}
			else {
				Flash::set_flash('Data kategori gagal dihapus', 'error');
				header('location:'.BASEURL.'/Kategori');
				exit;
			}
		}
		else {
			header('location:'.BASEURL.'/Kategori');
			exit();
		}
	}
}



?>