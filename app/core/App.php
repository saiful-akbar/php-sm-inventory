<?php 


/**
 * class App
 */
class App
{
	private $controller, $method = 'index', $params = [];
	
	public function __construct()
	{
                // Menjalankan fungsi parseURL()
		$url = $this->parseURL();
		
                /**
                 * Cek apakah ada session atau tidak
                 * Jika ada, cek apakah session-nya admin atau gudang
                 * Jika tidak ada arahkan ke halaman login
                 */
		if ( isset($_SESSION['admin']) ) {
			$this->routing('admin', $url, 'User');
		}
		else if ( isset($_SESSION['gudang']) ) {
			$this->routing('gudang', $url, 'Beranda');
		}
		else {
			$this->routing('auth', $url, 'login');
		}
	}


	public function parseURL()
	{
		$url=['/'];
		if (isset($_GET['url'])) {

			// mengilangkan tanda "/" pada akhir url
			$url = trim($_GET['url'], '/');

			// mencegah url berbahaya yang diinputkan
			$url = filter_var($url, FILTER_SANITIZE_URL);

			// membersihkan url dari tanda /
			$url = explode('/', $url);
		}
		return $url;
	}


	public function routing($folder, $url = [], $controller = [])
	{
		// cek apakah controller ada atau tidak
		if ( file_exists('app/controllers/'.$folder.'/'.$url[0].'.php') ) {
			$this->controller = $url[0];
			unset($url[0]);
		} else {
			$this->controller = $controller;
		}

                // Panggil dan jalankan controller
		require_once 'app/controllers/'.$folder.'/'.$this->controller.'.php';
		$this->controller = new $this->controller;

		// cek jika ada method atau tidak
		if ( isset($url[1]) ) {
			if ( method_exists($this->controller, $url[1]) ) {
				$this->method = $url[1];
				unset($url[1]);
			}
		}
		
		// cek jika masih ada url maka itu parameter
		if ( !empty($url) ) {
			$this->params = array_values($url);
		}

		// jalankan controller dan method, serta kirimkan params jika ada
		call_user_func_array([$this->controller, $this->method], $this->params);
	}
}


?>
