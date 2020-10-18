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


<body class="grey lighten-4 grey-text text-darken-3">

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



	<!-- flash message -->
	<div class="flash-data" data-flashpesan="<?= Flash::get_flash_pesan(); ?>" data-flashurl="<?= Flash::get_flash_url(); ?>" data-flashtipe="<?= Flash::get_flash_tipe();?>"></div>	




	<!-- header -->
	<header>		
		<div class="navbar-fixed">
			<nav>
				<div class="nav-wrapper teal">
					<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
					<span class="brand-logo left"><?= $data['judul'] ?></span>
					<ul id="nav-mobile" class="right">
						<li>
							<a class="dropdown-navbar" href="#!" data-activates="dropdown1">
								<i class="material-icons right">more_vert</i>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</header>



	<!-- Dropdown navbar -->
	<ul id="dropdown1" class="dropdown-content">
		<li>
			<a style="cursor: default;">
				<i class="material-icons left">person</i>
				<?php
				if ( isset($_SESSION['admin']) ) {
					echo $_SESSION['admin']['nama'];
				}
				elseif ( isset($_SESSION['gudang']) ) {
					echo $_SESSION['gudang']['nama'];
				}
				?>
			</a>
		</li>
		<li class="divider"></li>
		<li>
			<a href="<?= BASEURL; ?>/Logout" class="waves-effect waves-teal logout">
				<i class="material-icons teal-text">power_settings_new</i>Keluar
			</a>
		</li>
	</ul>



	<!-- navbar -->
	<ul id="slide-out" class="side-nav fixed">
		<li>
			<div class="user-view center-align">
				<a href="<?= BASEURL; ?>" class="logo">
					<img src="<?= BASEURL; ?>/assets/img/pavicon-circle.png">
					SLOW <span>MOTOR</span>
				</a>
			</div>
		</li>
		<?php if ( isset($_SESSION['admin']) ) { ?>
			<li>
				<span>Master</span>
			</li>
			<li><div class="divider"></div></li>
			<li class="active">
				<a href="<?= BASEURL; ?>/User" class="waves-effect waves-teal">
					<i class="material-icons teal-text">people</i>Data User
				</a>
			</li>
		<?php } else if ( isset($_SESSION['gudang']) ) { ?>
			<li>
				<span>Halaman Depan</span>			
			</li>
			<li><div class="divider"></div></li>
			<li  class="<?php if( $data['judul'] == 'Beranda' ) { echo('active');} ?>">
				<a href="<?= BASEURL; ?>/Beranda" class="waves-effect waves-teal">
					<i class="material-icons teal-text">dashboard</i>Beranda
				</a>
			</li>
			<li>
				<span>Master</span>			
			</li>
			<li><div class="divider"></div></li>
			<li class="<?php if( $data['judul'] == 'Barang' || $data['judul'] == 'Ubah Data Barang' || $data['judul'] == 'Kategori' ) { echo('active');} ?>">
				<a href="<?= BASEURL; ?>/Barang" class="waves-effect waves-teal">
					<i class="material-icons teal-text">view_list</i>Barang
				</a>
			</li>
			<li class="<?php if( $data['judul'] == 'Supplier' ) { echo('active');} ?>">
				<a href="<?= BASEURL; ?>/Supplier" class="waves-effect waves-teal">
					<i class="material-icons teal-text">people</i>Supplier
				</a>
			</li>
			<li>
				<span>Transaksi</span>
				<li><div class="divider"></div></li>
			</li>
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>

						<?php 

						if ( $data['judul'] == 'Pembelian' || $data['judul'] == 'Tambah Pembelian' || $data['judul'] == 'Penjualan' || $data['judul'] == 'Tambah Penjualan' || $data['judul'] == 'Return Pembelian' || $data['judul'] == 'Tambah Return Pembelian' || $data['judul'] == 'Return Penjualan' || $data['judul'] == 'Tambah Return Penjualan' ) {
							$active = 'active';
						}
						else {
							$active = '';
						}

						?>

						<a class="collapsible-header <?= $active ?>" id="transaksi">Transaksi<i class="fas fa-handshake teal-text"></i></a>
						<div class="collapsible-body">
							<ul>
								<li class="<?php if( $data['judul'] == 'Pembelian' || $data['judul'] == 'Tambah Pembelian' ) { echo('active');} ?>">
									<a href="<?= BASEURL; ?>/Pembelian" class="waves-effect waves-teal">
										Pembelian
									</a>
								</li>
								<li class="<?php if( $data['judul'] == 'Penjualan' || $data['judul'] == 'Tambah Penjualan' ) { echo('active');} ?>">
									<a href="<?= BASEURL; ?>/Penjualan" class="waves-effect waves-teal">
										Penjualan
									</a>
								</li>
								<li class="<?php if( $data['judul'] == 'Return Pembelian' || $data['judul'] == 'Tambah Return Pembelian' ) { echo('active');} ?>">
									<a href="<?= BASEURL; ?>/Return_pembelian" class="waves-effect waves-teal">
										Return Pembelian
									</a>
								</li>
								<li class="<?php if( $data['judul'] == 'Return Penjualan' || $data['judul'] == 'Tambah Return Penjualan' ) { echo('active');} ?>">
									<a href="<?= BASEURL; ?>/Return_penjualan" class="waves-effect waves-teal">
										Return Penjualan
									</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li>
				<span>Rekapitulasi</span>
			</li>
			<li><div class="divider"></div></li>
			<li class="<?php if( $data['judul'] == 'Laporan Pembelian' || $data['judul'] == 'Laporan Penjualan' || $data['judul'] == 'Laporan Return Pembelian' || $data['judul'] == 'Laporan Return Penjualan' ) { echo('active');} ?>">
				<a href="<?= BASEURL; ?>/Laporan_pembelian" class="waves-effect waves-teal">
					<i class="material-icons teal-text">multiline_chart</i>Laporan
				</a>
			</li>
			<li class="<?php if( $data['judul'] == 'Summary' ) { echo('active');} ?>">
				<a href="<?= BASEURL; ?>/Summary" class="waves-effect waves-teal">
					<i class="material-icons teal-text">assessment</i>Summary
				</a>
			</li>
		<?php } ?>	
		<li>
			<span>Keluar</span>			
		</li>
		<li><div class="divider"></div></li>
		<li>
			<a href="<?= BASEURL; ?>/Logout" class="waves-effect waves-teal logout">
				<i class="material-icons teal-text">power_settings_new</i>Keluar
			</a>
		</li>	
	</ul>	


	<!-- main content -->
	<main>