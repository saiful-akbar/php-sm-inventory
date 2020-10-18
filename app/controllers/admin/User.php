<?php 


/**
 * class user
 */
class User extends Controller
{

	public function __construct()
	{
		if ( empty($_SESSION['admin']) ) {
			header('location:'.BASEURL.'/Logout');
		}
	}



	// method index user
	public function index()
	{
		$data['judul'] = 'Data User';
		$data['user'] = $this->model('User_model')->get_user();

		$this->view('templates/header', $data);
		$this->view('admin/user/index', $data);
		$this->view('templates/footer', $data);
	}



	// method tambah data user
	public function tambah()
	{
		if ( isset($_POST['simpan']) ) {

			if ( !empty($_POST['nama']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['level']) ) {

				if ( !empty($_POST['level']) ) {

					if ( $this->model('User_model')->get_user($_POST) == null ) {				

						if ( $this->model('User_model')->tambah_data_user($_POST) > null ) {
							Flash::set_flash('Data user berhasil ditambahkan', 'success');
							header('location:'.BASEURL.'/User');
							exit;
						}
						else {
							Flash::set_flash('Data user gagal ditambahkan', 'error');
							header('location:'.BASEURL.'/User');
							exit;
						}
					}
					else {
						Flash::set_flash('Username sudah digunakan', 'warning');
						header('location:'.BASEURL.'/User');
						exit;
					}
				}
				else {
					Flash::set_flash('level belum disi', 'warning');
					header('location:'.BASEURL.'/User');
					exit;
				}
			}
			else {
				Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
				header('location:'.BASEURL.'/User');
				exit;
			}
		}
		else {
			header('location:'.BASEURL.'/User');
			exit;
		}
	}



	// methot ubah data user
	public function ubah ( $id = null )
	{
		$id = base64_decode($id);

		if ( !empty($id) ) {
			$data['user'] = $this->model('User_model')->get_user_by_id($id);

			if ( !empty($data['user']) ) {

				$data['judul'] = "Ubah Data User";
				$this->view('templates/header', $data);
				$this->view('admin/user/ubah', $data);
				$this->view('templates/footer', $data);
			}
			else {
				Flash::set_flash('Data user tidak ada', 'warning');
				header('location:'.BASEURL.'/User');
				exit;
			}
		}
		else {
			if ( isset($_POST['submit']) ) {

				if ( !empty($_POST['nama_user']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['level']) ) {

					if ( empty($this->model('User_model')->validasi_ubah($_POST)) ) {

						if ( $this->model('User_model')->ubah_data_user($_POST) > 0 ) {
							Flash::set_flash('Data user berhasil diubah', 'success');
							header('location:'.BASEURL.'/User');
							exit();
						}
						else {
							Flash::set_flash('Data user gagal diubah', 'error');
							header('location:'.BASEURL.'/User');
							exit;
						}
					}
					else {
						Flash::set_flash('Username sudah digunakan', 'warning');
						header('location:'.BASEURL.'/User/ubah/'.base64_encode($_POST['id_user']));
						exit;
					}
				}
				else {
					Flash::set_flash('Form dengan tanda * harus diisi', 'warning');
					header('location:'.BASEURL.'/User');
					exit;
				}
			}
			else {
				header('location:'.BASEURL.'/User');
				exit();
			}
		}
	}



	// method hapus data user
	public function hapus( )
	{
		if ( isset($_POST['data']) ) {
			$count = count($_POST['data']);

			for ($i=0; $i < $count; $i++) :
				$jml = $this->model('User_model')->hapus_data_user( $_POST['data'][$i] );
			endfor;

			if ( $jml > 0 ) {
				Flash::set_flash($count.' Data user berhasil dihapus', 'success');
				header('location:'.BASEURL.'/User');
				exit;
			}
			else {
				Flash::set_flash('Data user gagal dihapus', 'error');
				header('location:'.BASEURL.'/User');
				exit;
			}
		}
		else {
			header('location:'.BASEURL.'/User');
			exit;
		}
	}



	// method cetak data user
	public function cetak()
	{
		$data['judul'] = 'LAPORAN DATA USER';
		$data['mpdf'] = $this->mpdfl();		
		$data['user'] = $this->model('User_model')->get_user();

		$this->view('admin/user/cetak', $data);
	}



	// mothot get user
	public function get_user()
	{
		$id = base64_decode($_POST['id']);
		$result = $this->model('User_model')->get_user_by_id($id);
		echo json_encode($result);
	}
}


?>