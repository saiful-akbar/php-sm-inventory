<?php 


/**
 * CLASS SUMMARY
 */
class Summary extends Controller
{

	private $tanggal_awal, $tanggal_akhir;




	public function __construct()
	{
		if ( empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	} 



	// halaman index serta proses summary
	public function index( $tanggal_awal = null, $tanggal_akhir = null, $item = null )
	{
		$item = strtoupper($item);
		$this->tanggal_awal = $tanggal_awal;
		$this->tanggal_akhir = $tanggal_akhir;

		if ( !empty($tanggal_awal) && !empty($tanggal_akhir) ) {			

			if ( !empty($item) ) {
				
				if ( $this->get_barang($item) == true ) {
										
					$data['barang'] = $this->get_barang($item);	
					$data['pembelian'.$item] = $this->sum_pembelian($item);
					$data['total_pembelian'] = $this->sum_pembelian($item);
					$data['return_penjualan'.$item] = $this->sum_return_penjualan($item);
					$data['total_return_penjualan'] = $this->sum_return_penjualan($item);
					$data['penjualan'.$item] = $this->sum_penjualan($item);
					$data['total_penjualan'] = $this->sum_penjualan($item);
					$data['return_pembelian'.$item] = $this->sum_return_pembelian($item);
					$data['total_return_pembelian'] = $this->sum_return_pembelian($item);
				}
				else {
					
					$data['barang'] = [];
					$data['pembelian'.$item] = $this->sum_pembelian($item);
					$data['total_pembelian'] = $this->sum_pembelian($item);
					$data['return_penjualan'.$item] = $this->sum_return_penjualan($item);
					$data['total_return_penjualan'] = $this->sum_return_penjualan($item);
					$data['penjualan'.$item] = $this->sum_penjualan($item);
					$data['total_penjualan'] = $this->sum_penjualan($item);
					$data['return_pembelian'.$item] = $this->sum_return_pembelian($item);
					$data['total_return_pembelian'] = $this->sum_return_pembelian($item);
					Flash::set_flash('Item tidak ada', 'info');
				}
			}
			else {

				$data['barang'] = $this->get_barang();
				
				foreach ($data['barang'] as $brg) {
					$data[ 'pembelian'.$brg['item'] ] = $this->sum_pembelian($brg['item']);
					$data[ 'return_penjualan'.$brg['item'] ] = $this->sum_return_penjualan($brg['item']);
					$data[ 'penjualan'.$brg['item'] ] = $this->sum_penjualan($brg['item']);
					$data[ 'return_pembelian'.$brg['item'] ] = $this->sum_return_pembelian($brg['item']);
				}
				
				$data['total_pembelian'] = $this->sum_pembelian();
				$data['total_return_penjualan'] = $this->sum_return_penjualan();
				$data['total_penjualan'] = $this->sum_penjualan();
				$data['total_return_pembelian'] = $this->sum_return_pembelian();
				
			}
		}
		else {
			$data['barang'] = [];
			$data['total_pembelian'] = $this->sum_pembelian();
			$data['total_return_penjualan'] = $this->sum_return_penjualan();
			$data['total_penjualan'] = $this->sum_penjualan();
			$data['total_return_pembelian'] = $this->sum_return_pembelian();
		}


		$data['judul'] = 'Summary';
		$data['filter'] = $this->get_value($item);

		if ( !empty($tanggal_awal) && !empty($tanggal_akhir) ) {
			
			if ( !empty($item) ) {
				$data['url'] = BASEURL.'/Summary/cetak/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$item;
			}
			else {				
				$data['url'] = BASEURL.'/Summary/cetak/'.$tanggal_awal.'/'.$tanggal_akhir;
			}
		}
		else {
			$data['url'] = '#';
		}

		$data['brg'] = $this->model('Barang_model')->get_barang();
		$this->view('templates/header', $data);
		$this->view('gudang/modal/modal_view_barang', $data);
		$this->view('gudang/summary/index', $data);
		$this->view('templates/footer', $data);
	}



	// mengambil nilai yang diinput
	public function get_value( $item = null )
	{
		$array = [
			'tanggal_awal' => $this->tanggal_awal,
			'tanggal_akhir' => $this->tanggal_akhir,
			'item' => $item
		];

		return $array;
	}



	// mengambil data barang
	public function get_barang( $item = null )
	{
		return $this->model('Barang_model')->get_barang($item);
	}



	// mengitung total qty pembelian
	public function sum_pembelian( $item = null )
	{
		$data['filter'] = [
			'tanggal_awal' => $this->tanggal_awal,
			'tanggal_akhir' => $this->tanggal_akhir,
			'item' => $item
		];

		return $this->model('Summary_model')->get_sum_pembelian($data);
	}



	// mengitung total qty return penjualan
	public function sum_return_penjualan( $item = null )
	{
		$data['filter'] = [
			'tanggal_awal' => $this->tanggal_awal,
			'tanggal_akhir' => $this->tanggal_akhir,
			'item' => $item
		];

		return $this->model('Summary_model')->get_sum_return_penjualan($data);
	}



	// mengitung total qty penjualan
	public function sum_penjualan( $item = null )
	{
		$data['filter'] = [
			'tanggal_awal' => $this->tanggal_awal,
			'tanggal_akhir' => $this->tanggal_akhir,
			'item' => $item
		];

		return $this->model('Summary_model')->get_sum_penjualan($data);
	}



	// mengitung total qty return pembelian
	public function sum_return_pembelian( $item = null )
	{
		$data['filter'] = [
			'tanggal_awal' => $this->tanggal_awal,
			'tanggal_akhir' => $this->tanggal_akhir,
			'item' => $item
		];

		return $this->model('Summary_model')->get_sum_return_pembelian($data);
	}



	// method cetak laporan summary
	public function cetak( $tanggal_awal = null, $tanggal_akhir = null, $item = null )
	{
		$item = strtoupper($item);
		$this->tanggal_awal = $tanggal_awal;
		$this->tanggal_akhir = $tanggal_akhir;

		if ( !empty($tanggal_awal) && !empty($tanggal_akhir) ) {			

			if ( !empty($item) ) {
				
				if ( $this->get_barang($item) == true ) {
										
					$data['barang'] = $this->get_barang($item);	
					$data['pembelian'.$item] = $this->sum_pembelian($item);
					$data['total_pembelian'] = $this->sum_pembelian($item);
					$data['return_penjualan'.$item] = $this->sum_return_penjualan($item);
					$data['total_return_penjualan'] = $this->sum_return_penjualan($item);
					$data['penjualan'.$item] = $this->sum_penjualan($item);
					$data['total_penjualan'] = $this->sum_penjualan($item);
					$data['return_pembelian'.$item] = $this->sum_return_pembelian($item);
					$data['total_return_pembelian'] = $this->sum_return_pembelian($item);
				}
				else {
					
					$data['barang'] = [];
					$data['pembelian'.$item] = $this->sum_pembelian($item);
					$data['total_pembelian'] = $this->sum_pembelian($item);
					$data['return_penjualan'.$item] = $this->sum_return_penjualan($item);
					$data['total_return_penjualan'] = $this->sum_return_penjualan($item);
					$data['penjualan'.$item] = $this->sum_penjualan($item);
					$data['total_penjualan'] = $this->sum_penjualan($item);
					$data['return_pembelian'.$item] = $this->sum_return_pembelian($item);
					$data['total_return_pembelian'] = $this->sum_return_pembelian($item);
					Flash::set_flash('Item tidak ada', 'info');
					header('location:'.BASEURL.'/Summary');
					exit();
				}
			}
			else {

				$data['barang'] = $this->get_barang();
				
				foreach ($data['barang'] as $brg) {
					$data[ 'pembelian'.$brg['item'] ] = $this->sum_pembelian($brg['item']);
					$data[ 'return_penjualan'.$brg['item'] ] = $this->sum_return_penjualan($brg['item']);
					$data[ 'penjualan'.$brg['item'] ] = $this->sum_penjualan($brg['item']);
					$data[ 'return_pembelian'.$brg['item'] ] = $this->sum_return_pembelian($brg['item']);
				}
				
				$data['total_pembelian'] = $this->sum_pembelian();
				$data['total_return_penjualan'] = $this->sum_return_penjualan();
				$data['total_penjualan'] = $this->sum_penjualan();
				$data['total_return_pembelian'] = $this->sum_return_pembelian();
				
			}
		}
		else {
			$data['barang'] = [];
			$data['total_pembelian'] = $this->sum_pembelian();
			$data['total_return_penjualan'] = $this->sum_return_penjualan();
			$data['total_penjualan'] = $this->sum_penjualan();
			$data['total_return_pembelian'] = $this->sum_return_pembelian();
		}


		$data['mpdf'] = $this->mpdfl();
		$data['judul'] = 'LAPORAN SUMMARY';
		$data['filter'] = $this->get_value($item);

		$this->view('gudang/summary/cetak', $data);
	}
}


?>