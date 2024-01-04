<?php
error_reporting(E_ALL ^ E_DEPRECATED);

	$server		= "localhost"; 
	$user		= "rsud"; 
	$password	= "g5Aadrhx"; 
	$database	= "rsud"; 
	
	$connect = mysql_connect($server, $user, $password) or die ("Koneksi gagal!");
	mysql_select_db($database) or die ("Database belum siap!");
?>	