<?php 
ob_start();

if ( !session_id() ) {
	session_start();
}

date_default_timezone_set('Asia/Jakarta');

require_once "app/init.php";

$app = new App; 
$controller = new Controller;


ob_end_flush();
?>