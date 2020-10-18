<?php 

/**
 * class Flash Message
 */
class Flash
{
	
	public static function set_flash($pesan, $tipe, $url = null)
	{
		$_SESSION['flash'] = [
			'pesan' => $pesan,
			'tipe' => $tipe,
			'url' => $url
		];
	}



	public static function get_flash_pesan()
	{
		if ( isset($_SESSION['flash']) ) {
			echo $_SESSION['flash']['pesan'];
		}
	}



	public static function get_flash_url()
	{
		if ( isset($_SESSION['flash']) ) {
			echo $_SESSION['flash']['url'];
		}
	}



	public static function get_flash_tipe()
	{
		if ( isset($_SESSION['flash']) ) {
			echo $_SESSION['flash']['tipe'];
			unset($_SESSION['flash']);
		}
	}
}

?>