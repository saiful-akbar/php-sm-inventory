<?php

/**
 * class Beranda
 */
class Beranda extends Controller
{

	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method index beranda 
	public function index()
	{
		$bulan = date('Y-m');
		
		$data['judul'] = 'Beranda';
		$data['pembelian'] = $this->model('Beranda_model')->get_count_pembelian($bulan);
		$data['penjualan'] = $this->model('Beranda_model')->get_count_penjualan($bulan);
		$data['return_pembelian'] = $this->model('Beranda_model')->get_count_return_pembelian($bulan);
		$data['return_penjualan'] = $this->model('Beranda_model')->get_count_return_penjualan($bulan);

		$this->view('templates/header', $data);
		$this->view('gudang/beranda/index',$data);
		$this->view('templates/footer', $data);
	}
}

?>