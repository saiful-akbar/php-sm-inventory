<!DOCTYPE html>
<html lang="en">


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?= $data['judul']; ?> - Sistem Informasi Manajemen Barang</title>
	
	<link rel="apple-touch-icon" href="<?= BASEURL; ?>/assets/img/pavicon-circle.png">
	<link rel="shortcut icon" href="<?= BASEURL; ?>/assets/img/pavicon-circle.png">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets/materialize/css/materialize.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets/font-awesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets/materialize/iconfont/material-icons.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets/DataTables/dataTables-materialize.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL; ?>/assets/custom/style.css">
</head>


<body class="grey darken-3">

	<!-- preloader -->
	<div class="preloader center-align">
		<div id="loading">
			<div class="preloader-wrapper active">
				<div class="spinner-layer spinner-blue">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-red">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-yellow">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
				<div class="spinner-layer spinner-green">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div>
					<div class="gap-patch">
						<div class="circle"></div>
					</div>
					<div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
			<br><span class="title grey-text text-darken-1 center-align">Harap Tunggu...</span>
		</div>
	</div>


	
	<!-- Notifikasi -->
	<div class="flash-data" data-flashpesan="<?= Flash::get_flash_pesan(); ?>" data-flashtipe="<?= Flash::get_flash_tipe(); ?>"></div>



	<!-- Form Login -->
	<div class="login-body">
		<div class="login-center">
			<div class="row">
				<div class="col s12">
					<div class="center-align grey-text login-title">
						<h4>Slow Motor Aplication</h4>
						<span>Sistem Informasi Manajemen Barang</span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 m6 l4 offset-l4 offset-m3">
					<form method="post" action="<?= BASEURL; ?>/Login/user_login" autocomplete="off">
						<div class="card grey lighten-3 z-depth-2">
							<br>
							<div class="card-content">
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">account_circle</i>
										<input class='validate' type='text' name='username' id='username' autofocus required />
										<label for='username'>Username</label>
									</div>
								</div>
								<div class="row">
									<div class="input-field col s12">
										<i class="material-icons prefix">lock</i>
										<i class="material-icons input-icon prefix" id="show-password">visibility_off</i>
										<input class='validate' type='password' name='password' id='password' required />
										<label for='password'>Password</label>
									</div>
								</div>
								<br>
								<div class='row'>
									<button type='submit' name='submit' class='col s12 btn-large waves-effect waves-light teal darken-1'>
										Login
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>





	<!-- javascript -->	
	<script type="text/javascript" src="<?= BASEURL; ?>/assets/jquery/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/assets/DataTables/datatables.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/assets/sweetalert/sweetalert2.all.min.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/assets/materialize/js/materialize.js"></script>
	<script type="text/javascript" src="<?= BASEURL; ?>/assets/custom/script.js"></script>

</body>
</html>
