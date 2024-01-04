<?php
session_start();
if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}
$option = $_POST['option'];

// querysioner 
$n = $_POST['n'];
$id_responden = $_POST['id_responden'];
$id_master_kuesioner = $_POST['id_master_kuesioner'];
$jawaban = explode('#',$_POST['jawaban']);
$keterangan_jawaban = $_POST['keterangan_jawaban'];
$id_master_pelayanan_umum = $_POST['id_master_pelayanan_umum'];
// url kritik saran	

$url_kue = "https://simrsud.wonosobokab.go.id/webservicesms/insert/insert_jawaban_kuesioner";
$url_kue_cek = "https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/cek_jawaban_yang_masuk/$id_responden/$id_master_pelayanan_umum";
$datap = "123";
$secretKey = "123";
// Computes the timestamp          
$tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
// Computes the signature by hashing the salt with the secret key as the key
$signature = hash_hmac('sha256', $datap."&".$tStamp, $secretKey, true); 
// base64 encode…
$encodedSignature = base64_encode($signature);	
// urlencode…
// $encodedSignature = urlencode($encodedSignature);
$headers = array(             			
	"X-id:".$datap, 
	"X-timestamp: ".$tStamp,
	"X-signature: ".$encodedSignature,     
	"Content-Type: application/x-www-form-urlencoded" 
); 

 // jawaban kuesioner
$postdata_kue = http_build_query(
       array(
          'norm' => $id_responden,
          'id_master_kuesioner' => $id_master_kuesioner,
          'jawaban' => $jawaban[0],
          'nilai_jawaban' => $jawaban[1],
          'keterangan_jawaban' => $keterangan_jawaban
       )
   ); 


if ($option=="jawaban_kuesioner"){				
		// cek
		$ch = curl_init($url_kue_cek);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_HTTPGET, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	
		$content = curl_exec($ch); // json
		curl_close($ch);	
		$resultarr=json_decode($content, true);	// array
		$datax['status'] = $resultarr['status'];	
		$datax['cek'] = $resultarr['data']['jml_data'];	
		//echo '{"status":"1","pesan":"'.$datax['cek'].'","ket":"'.$jawaban[0].'"}';
		if($datax['cek']<$n){
			// insert
			$process_kue = curl_init($url_kue);
			curl_setopt($process_kue, CURLOPT_URL, $url_kue);		
			curl_setopt($process_kue, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt($process_kue, CURLOPT_TIMEOUT, 30);
			curl_setopt($process_kue, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($process_kue, CURLOPT_CUSTOMREQUEST, "POST");  //method yg digunakan..
			curl_setopt($process_kue, CURLOPT_POSTFIELDS, $postdata_kue);
			curl_setopt($process_kue, CURLOPT_RETURNTRANSFER, true);
			$return_kue = curl_exec($process_kue);
			curl_close($process_kue);
			$response_kue=json_decode($return_kue, true); 		
			$status_kue = $response_kue['status'];
			$message_kue = $response_kue['data']['message'];
			if($status_kue==200){
				echo '{"status":"1","pesan":"'.$datax['cek'].'"}';													
			}else{
				echo '{"status":"2","pesan":"'.$datax['cek'].'"}';												
			}																
		}else{
			echo '{"status":"2","pesan":"'.$datax['cek'].'"}';
		}
																
			
}
?>