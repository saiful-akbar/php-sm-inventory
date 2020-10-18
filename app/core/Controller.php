<?php 

/**
 * class Controler
 */
class Controller
{

	public function view($view, $data = [])
	{
		require_once 'app/views/'.$view.'.php';
	}


	public function model( $model )
	{
		require_once 'app/models/'.$model.'.php';
		return new $model;
	}



	// pdf potrait
	public function mpdf()
	{
		require_once 'assets/mpdf/autoload.php';
		
		return new \Mpdf\Mpdf([
			'setAutoTopMargin'  => 'stretch',
			'setAutoBottomMargin' => 'stretch',
			'autoMarginPadding' => 5,
			'mode' => 'utf-8',
			'format' => 'A4-P'
		]);
	}



	// pdf lanscape
	public function mpdfl()
	{
		require_once 'assets/mpdf/autoload.php';
		
		return new \Mpdf\Mpdf([
			'setAutoTopMargin'  => 'stretch',
			'setAutoBottomMargin' => 'stretch',
			'autoMarginPadding' => 5,
			'mode' => 'utf-8',
			'format' => 'A4-L'
		]);
	}
}

?>