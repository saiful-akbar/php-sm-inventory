<?php 

/**
 * class login
 */
class Login extends controller
{

	public function __construct()
	{
		if ( !empty($_SESSION['gudang']) ) {
			header('location:'.BASEURL.'/Beranda');
		}
		else if ( !empty($_SESSION['admin']) ) {
			header('location:'.BASEURL.'/User');
		}
	}

	
	// method index login
	public function index()
	{
		$data['judul'] = 'Login';
		$this->view('auth/index', $data);
	}



	// methode login user
	public function user_login()
	{
		if ( isset($_POST['submit']) ){

			if ( !empty($_POST['username']) && !empty($_POST['password']) ) {

				$user = $this->model('Login_model')->cek_user($_POST);

				if ( !empty($user) ) {
					$data = [
						'id' => $user['id_user'],
						'level' => $user['level'],
						'nama' => $user['nama_user']
					];

					if ( $user['level'] == 'admin' ) {
						$_SESSION['admin'] = $data;
						header('location:'.BASEURL.'/User');
					}
					else if ( $user['level'] == 'gudang' ) {
						$_SESSION['gudang'] = $data;
						header('location:'.BASEURL.'/Beranda');
					}
					else {
						Flash::set_flash('Login gagal, Level user tidak ada', 'error');
						header('location:'.BASEURL.'/Login');
					}
				}
				else {
					Flash::set_flash('Login gagal, username / password salah', 'error');
					header('location:'.BASEURL.'/Login');
					exit();
				}
			}
			else {
				Flash::set_flash('Username & password tidak boleh kosong', 'info');
				header('location:'.BASEURL.'/Login');
				exit();
			}
		}
		else {
			header('location:'.BASEURL.'/Login');
			exit();
		}
	}



	public function logout()
	{
		session_destroy();
		header('location:'.BASEURL.'/Login');
		exit();
	}
}


?>