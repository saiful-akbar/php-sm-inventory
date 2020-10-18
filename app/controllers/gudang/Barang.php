<?php 

/**
* class barang
*/
class Barang extends Controller
{

	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method halaman utama data barang
	public function index()
	{
		$data['judul'] = 'Barang';

		$data['barang'] = $this->model('Barang_model')->get_barang();
		$data['kategori'] = $this->model('Kategori_model')->get_kategori();

		$this->view('templates/header', $data);
		$this->view('gudang/barang/index', $data);
		$this->view('templates/footer', $data);
	}



	// method tambah barang
	public function tambah()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['kategori']) && !empty($_POST['item']) && !empty($_POST['deskripsi']) && !empty($_POST['unit']) && !empty($_POST['harga_beli']) && !empty($_POST['harga_jual']) ) {

				if ($_POST['harga_beli'] < 0 || $_POST['harga_jual'] < 0) {
					Flash::set_flash('Harga tidak boleh bernilai minus', 'error');
				}
				else {					
					if ( empty($this->model('Barang_model')->get_barang_by_item($_POST['item'])) ) {

						if ( $this->model('Barang_model')->tambah_data_barang($_POST) > 0 ) {
							Flash::set_flash('Data barang berhasil ditambah', 'success');
						}
						else{
							Flash::set_flash('Data gagal ditambah', 'error');
						}
					}
					else {
						Flash::set_flash('Item sudah digunakan', 'warning');
					}
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus disi', 'warning');
			}
		}
		else {
			Flash::set_flash('Silakan isi form tambah data barang', 'warning');
		}

		return header('location:'.BASEURL.'/Barang');
	}



	// method hapus data barang
	public function hapus()
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);
			
			for ($i=0; $i < $count; $i++) :
				$jml[] = $this->model('Barang_model')->hapus_data_barang( $_POST['data'][$i] );
			endfor;

			$sumLoop = array_sum($jml);
			$failed = $count - $sumLoop;
			
			if ( $sumLoop == $count ) {
				Flash::set_flash($sumLoop.' Data barang berhasil dihapus', 'success');				
			}
			else {
				Flash::set_flash($failed.' Data barang gagal dihapus', 'error');				
			}
		}
		return header('location:'.BASEURL.'/Barang');
	}



	// method ubah data barang
	public function ubah( $id = null )
	{
		$id = base64_decode($id);

		if ( !empty($id) ) {			
			$data['barang'] = $this->model('Barang_model')->get_barang_by_id($id);

			if ( !empty($data['barang']) ) {

				$data['judul'] = 'Ubah Data Barang';
				$data['kategori'] = $this->model('Kategori_model')->get_kategori();
				$this->view('templates/header', $data);
				$this->view('gudang/barang/ubah', $data);
				$this->view('templates/footer', $data);
			}
			else {
				Flash::set_flash('Item tidak ada', 'warning');
				header('location:'.BASEURL.'/Barang');
				exit;
			}
		}
		else {
			if (isset($_POST['submit'])) {

				if ( !empty($_POST['kategori']) && !empty($_POST['item']) && !empty($_POST['deskripsi']) && !empty($_POST['unit']) && !empty($_POST['harga_beli']) && !empty($_POST['harga_jual']) ) {				

					if ( empty($this->model('Barang_model')->ubah_validasi($_POST)) ) {

						if ( $this->model('Barang_model')->ubah_data_barang($_POST) > 0 ) {
							Flash::set_flash('Data barang berhasil diubah', 'success');
							header('location:'.BASEURL.'/Barang');
							exit;
						}
						else {
							Flash::set_flash('Data gagal diubah', 'error');
							header('location:'.BASEURL.'/Barang/');
							exit;
						}
					}
					else {
						Flash::set_flash('Item sudah digunakan', 'warning');
						header('location:'.BASEURL.'/Barang/ubah/'.base64_encode($_POST['id']));
						exit;
					}
				}
				else {
					Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
					header('location:'.BASEURL.'/Barang/ubah/'.base64_encode($_POST['id']));
					exit;
				}
			}
			else {
				header('location:'.BASEURL.'/Barang');
				exit;
			}
		}
	}



	// method ambil data barang dengan ajax json
	public function get_barang_json()
	{
		$data = strtoupper($_POST['item']);

		if ( !empty($data) ) {
			$result = $this->model('Barang_model')->get_barang_by_item($data);

			if ( !empty($result) ) {
				echo json_encode($result);
			}
			else {				
				echo json_encode('');
			}
		}
	}



	// method cetak data barang
	public function cetak()
	{
		$data['judul'] = 'Cetak - Laporan Data Barang';
		$data['mpdf'] = $this->mpdfl();		
		$data['barang'] = $this->model('Barang_model')->get_barang();
		$data['kategori'] = $this->model('Kategori_model')->get_kategori();

		$this->view('gudang/barang/cetak', $data);
	}
}

?>