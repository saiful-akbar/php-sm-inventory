<?php 

/**
 * class laporan return penjualan
 */
class Laporan_return_penjualan extends Controller
{
	
	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method laporan return penjualan
	public function index( $tanggal_awal = null, $tanggal_akhir = null, $no_transaksi = null, $item = null )
	{
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,
			'no_return_penjualan' => $no_transaksi,
			'item' => $item
		];

		if ( !empty($no_transaksi) && !empty($item) ) {
			$data['url_cetak'] = BASEURL.'/Laporan_return_penjualan/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$no_transaksi.'/'.$item;
		}
		else if ( !empty($no_transaksi) ) {
			$data['url_cetak'] = BASEURL.'/Laporan_return_penjualan/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$no_transaksi.'/0';
		}
		else if ( !empty($item) ) {
			$data['url_cetak'] = BASEURL.'/Laporan_return_penjualan/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/0/'.$item;
		}
		else {
			$data['url_cetak'] = BASEURL.'/Laporan_return_penjualan/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/0/0';			
		}

		$data['laporan_return_penjualan'] = $this->model('Laporan_model')->get_lap_return_penjualan($data);
		$data['grand_total'] = $this->model('Laporan_model')->get_grand_total_lap_return_penjualan($data);
		$data['total_qty'] = $this->model('Laporan_model')->get_total_qty_lap_return_penjualan($data);

		$data['judul'] = 'Laporan Return Penjualan';

		$this->view('templates/header', $data);
		$this->view('gudang/laporan/laporan_return_penjualan', $data);
		$this->view('templates/footer', $data);
	}



	// cetak laporan return penjualan
	public function cetak( $tanggal_awal = null, $tanggal_akhir = null, $no_transaksi = null, $item = null )
	{
		$data['mpdf'] = $this->mpdfl();
		$data['filter'] = [
			'tanggal_awal' => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir,
			'no_return_penjualan' => $no_transaksi,
			'item' => $item
		];
		
		$data['laporan_return_penjualan'] = $this->model('Laporan_model')->get_lap_return_penjualan($data);
		$data['grand_total'] = $this->model('Laporan_model')->get_grand_total_lap_return_penjualan($data);
		$data['total_qty'] = $this->model('Laporan_model')->get_total_qty_lap_return_penjualan($data);
		
		$data['judul'] = 'LAPORAN RETURN PENJUALAN';

		$this->view('gudang/laporan/cetak_lap_return_penjualan', $data);
	}
}

?>