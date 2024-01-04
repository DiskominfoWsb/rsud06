<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$a=$_GET['tipe_kelas'];
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include "koneksi.php";

$connect = mysql_connect($server, $user, $password) or die ("Koneksi gagal!");
	mysql_select_db($database) or die ("Database belum siap!");

//$sql = "SELECT * FROM kamar WHERE tipe_kelas LIKE '%$a%' order by tipe_kelas asc";
$sql = "SELECT * FROM kamar WHERE tipe_kelas LIKE '%$a%' order by tipe_kelas asc, kosong desc";
$result = mysql_query($sql) or die ("Query error: " . mysql_error());

$records = array();

while($row = mysql_fetch_assoc($result)) {
 $records[] = $row;
}

mysql_close($connect);
$data = "{\"toilets\" : ".json_encode($records)."}";
echo $data;
//echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
?>