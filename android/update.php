<?php
	include "koneksi.php";
	
	$id_kamar 	= $_POST['id_kamar'];
	$tipe_kelas = $_POST['tipe_kelas'];
	$nama_kelas = $_POST['nama_kelas'];
	$jumlah_kelas = $_POST['jumlah_kelas'];
    $kamar_terisi = $_POST['kamar_terisi'];
	$kosong = $_POST['kosong'];
        //$tanggal = curdate();
        //$jam = curtime();
		
	class emp{}
	
	if (empty($id_kamar) || empty($tipe_kelas) || empty($nama_kelas) || empty($jumlah_kelas) || empty($kamar_terisi) || empty($kosong)) { 
		$response = new emp();
		$response->success = 0;
		$response->message = "Kolom isian tidak boleh kosong"; 
		die(json_encode($response));
	} else {
		$query = mysql_query("UPDATE kamar SET tipe_kelas='".$tipe_kelas."', nama_kelas='".$nama_kelas."' ,
		jumlah_kelas='".$jumlah_kelas."', terisi='".$kamar_terisi."', kosong='".$kosong."', tanggal= curdate(), jam= curtime() WHERE id_kamar='".$id_kamar."'");
		
		if ($query) {
			$response = new emp();
			$response->success = 1;
			$response->message = "Data berhasil di update";
			die(json_encode($response));
		} else{ 
			$response = new emp();
			$response->success = 0;
			$response->message = "Error update Data";
			die(json_encode($response)); 
		}	
	}
?>