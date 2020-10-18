<?php 


/**
 * class pembelian
 */
class Pembelian extends Controller
{
	
	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}
	


	// method index pembelian
	public function index($tanggal_awal = null, $tanggal_akhir = null)
	{
		$data['judul'] = 'Pembelian';		
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir
		];

		if ( $tanggal_awal != null && $tanggal_akhir != null ) {
			$data['pembelian'] = $this->model('Pembelian_model')->get_pembelian($data['filter']);
		}
		else{
			$data['pembelian'] = $this->model('Pembelian_model')->get_pembelian();
		}

		$this->view('templates/header', $data);
		$this->view('gudang/pembelian/index', $data);
		$this->view('templates/footer', $data);
	}



	// method halaman transaksi pembelian
	public function transaksi()
	{
		$data['judul'] = 'Tambah Pembelian';
		$data['spl'] = $this->model('Supplier_model')->get_supplier();
		$data['brg'] = $this->model('Barang_model')->get_barang();
		$data['no_pembelian'] = $this->model('Pembelian_model')->get_no_pembelian();
		$data['list_pembelian'] = $this->model('Pembelian_model')->get_list_pembelian();
		$data['grand_total'] = $this->model('Pembelian_model')->get_grand_total();
		$data['sum_qty'] = $this->model('Pembelian_model')->get_sum_qty_list();

		$this->view('templates/header', $data);
		$this->view('gudang/modal/modal_view_barang', $data);
		$this->view('gudang/pembelian/transaksi', $data);
		$this->view('templates/footer', $data);
	}



	// method tambah list pembelian
	public function tambah()
	{
		if ( isset($_POST['tambah']) ) {

			if ( !empty($_POST['item']) && !empty($_POST['deskripsi']) && !empty($_POST['harga_beli']) && !empty($_POST['qty']) ) {

				if (  !empty($this->model('Barang_model')->get_barang_by_item($_POST['item'])) ) {

					if ( $this->model('Pembelian_model')->tambah_pembelian_list($_POST) > 0 ) {
						Flash::set_flash('Ditambahkan kedalam list', 'success');
						header('location:'.BASEURL.'/Pembelian/transaksi');
						exit();
					}
					else {
						Flash::set_flash('Gagal ditambahkan kedalam list', 'error');
						header('location:'.BASEURL.'/Pembelian/transaksi');
						exit();
					}
				}
				else {
					Flash::set_flash('Item tidak ada', 'info');
					header('location:'.BASEURL.'/Pembelian/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Pembelian/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Pembelian/transaksi');
			exit();
		}
	}



	// method hapus list pembelian
	public function hapus()
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);

			for ($i = 0; $i < $count; $i++) : 
				$jml = $this->model('Pembelian_model')->hapus_pembelian_list_by_id($_POST['data'][$i]);
			endfor;

			if ( $jml > 0 ) {
				Flash::set_flash($count.' List pembelian berhasil dihapus', 'success');
				header('location:'.BASEURL.'/Pembelian/transaksi');
				exit();
			}
			else {
				Flash::set_flash('List pembelian gagal dihapus', 'error');
				header('location:'.BASEURL.'/Pembelian/transaksi');
				exit();
			}

		}
		else {
			header('location:'.BASEURL.'/Pembelian/transaksi');
			exit();
		}
	}



	// method simpan transaksi pembelian
	public function simpan()
	{
		if ( isset($_POST['simpan']) ) {
			
			if ( !empty($_POST['supplier']) && !empty($_POST['no_pembelian']) && !empty($_POST['tanggal']) ) {

				$tambah_pembelian = $this->model('Pembelian_model')->tambah_pembelian($_POST);
				$tambah_detail = $this->model('Pembelian_model')->tambah_pembelian_detail($_POST);
				$hapus_list = $this->model('Pembelian_model')->hapus_semua_pembelian_list();
				
				if ( $tambah_pembelian > 0 && $tambah_detail > 0 && $hapus_list > 0) {
					Flash::set_flash('Lanjut cetak nota pembelian ?', 'success', BASEURL.'/pembelian/cetak/'.$_POST['no_pembelian'] );
					header('location:'.BASEURL.'/Pembelian/transaksi');
					exit();
				}
				else {
					Flash::set_flash('Pembelian gagal disimpan', 'error');
					header('location:'.BASEURL.'/Pembelian/transaksi');
					exit();
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/Pembelian/transaksi');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Pembelian/transaksi');
			exit();
		}
	}



	// contrller cetak pembelian
	public function cetak( $no_pembelian = null )
	{
		if ( $no_pembelian != null ) {

			$data['no_pembelian'] = $no_pembelian;

			$data['judul'] = 'Cetak Nota Pembelian - '.$no_pembelian;
			$data['mpdf'] = $this->mpdf();
			$data['pembelian'] = $this->model('Pembelian_model')->get_pembelian($data);
			$data['sum_qty'] = $this->model('Pembelian_model')->get_sum_qty_detail($no_pembelian);
			
			$this->view('gudang/Pembelian/cetak', $data);
		}
		else {
			header('location:'.BASEURL.'/Pembelian');
			exit;
		}
	}
}




?>