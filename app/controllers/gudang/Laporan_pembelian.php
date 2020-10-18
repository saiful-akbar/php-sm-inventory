<?php 

/**
 * class laporan
 */
class Laporan_pembelian extends Controller
{
	
	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method laporan pembelian
	public function index( $tanggal_awal = null, $tanggal_akhir = null, $no_transaksi = null, $item = null )
	{		
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,
			'no_pembelian' => $no_transaksi,
			'item' => $item
		];

		if ( !empty($no_transaksi) && !empty($item) ) {
			$data['url_cetak'] = BASEURL.'/Laporan_pembelian/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$no_transaksi.'/'.$item;
		}
		else if ( !empty($no_transaksi) ) {
			$data['url_cetak'] = BASEURL.'/Laporan_pembelian/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$no_transaksi.'/0';
		}
		else if ( !empty($item) ) {
			$data['url_cetak'] = BASEURL.'/Laporan_pembelian/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/0/'.$item;
		}
		else {
			$data['url_cetak'] = BASEURL.'/Laporan_pembelian/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/0/0';			
		}
		
		$data['laporan_pembelian'] = $this->model('Laporan_model')->get_lap_pembelian($data);
		$data['grand_total'] = $this->model('Laporan_model')->get_grand_total_lap_pembelian($data);
		$data['total_qty'] = $this->model('Laporan_model')->get_total_qty_lap_pembelian($data);		
		$data['judul'] = 'Laporan Pembelian';

		$this->view('templates/header', $data);
		$this->view('gudang/laporan/laporan_pembelian', $data);
		$this->view('templates/footer', $data);
	}



	// cetak laporan pembelian
	public function cetak( $tanggal_awal = null, $tanggal_akhir = null, $no_transaksi = null, $item = null )
	{
		$data['mpdf'] = $this->mpdfl();		
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,
			'no_pembelian' => $no_transaksi,
			'item' => $item
		];
		
		$data['laporan_pembelian'] = $this->model('Laporan_model')->get_lap_pembelian($data);
		$data['grand_total'] = $this->model('Laporan_model')->get_grand_total_lap_pembelian($data);
		$data['total_qty'] = $this->model('Laporan_model')->get_total_qty_lap_pembelian($data);
		
		$data['judul'] = 'LAPORAN PEMBELIAN';

		$this->view('gudang/laporan/cetak_lap_pembelian', $data);
	}
}

?>