<?php 
// Memanggil file config.php
require_once __DIR__.'/config/config.php';

/**
 * Fungsi untuk menjalankan semua class pada folder core
 * NB: Pastikan nama file disesuaikan dengan nama class-nya & jadikan 1 file untuk 1 class
 */
spl_autoload_register(function($class) {
	require_once __DIR__.'/core/'.$class.'.php';
});

?>
