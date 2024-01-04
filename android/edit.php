<?php
include "koneksi.php";
$id 	= $_POST['id'];
	
	class emp{}
	
	if (empty($id)) { 
		$response = new emp();
		$response->success = 0;
		$response->message = "Error Mengambil Data"; 
		die(json_encode($response));
	} else {
		$query 	= mysql_query("SELECT * FROM kamar WHERE id_kamar='".$id."'");
		$row 	= mysql_fetch_array($query);
		
		if (!empty($row)) {
			$response = new emp();
			$response->success = 1;
			$response->id_kamar = $row["id_kamar"];
                        $response->tipe_kelas = $row["tipe_kelas"];
			$response->nama_kelas = $row["nama_kelas"];
			$response->jumlah_kelas = $row["jumlah_kelas"];
                        $response->terisi = $row["terisi"];
			$response->kosong = $row["kosong"];
                        $response->tanggal = $row["tanggal"];
                        $response->jam = $row["jam"];
			die(json_encode($response));
		} else{ 
			$response = new emp();
			$response->success = 0;
			$response->message = "Error Mengambil Data";
			die(json_encode($response)); 
		}	
	}
?>		