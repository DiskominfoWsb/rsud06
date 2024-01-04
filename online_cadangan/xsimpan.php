<?php
session_start();
if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}
$option = $_POST['option'];
$norm = $_POST['norm'];
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$pesan = $_POST['var_kritik_saran'];
$bintang = $_POST['bintang'];
// querysioner 
//$n = $_POST['n'];
//$id_responden = $_POST['id_responden'];
//$id_master_kuesioner = $_POST['id_master_kuesioner'];
//$jawaban = explode('#',$_POST['jawaban']);
//$keterangan_jawaban = $_POST['keterangan_jawaban'];
// url kritik saran	
$url = "https://simrsud.wonosobokab.go.id/webservicesms/insert/insert_kritik_saran";		
//$url_kue = "https://simrsud.wonosobokab.go.id/webservicesms/insert/insert_jawaban_kuesioner";
//$url_kue_cek = "https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/cek_jawaban_yang_masuk/$id_responden/$id_master_kuesioner";
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
// kritik dan saran
$postdata = http_build_query(
       array(
          'norm' => $_POST['norm'],
          'nama' => $_POST['nama'],
          'nik' => $_POST['nik'],
          'kritik_saran' => $_POST['var_kritik_saran'],
          'bintang' => $_POST['bintang']
       )
   ); 
 // jawaban kuesioner
/*$postdata_kue = http_build_query(
       array(
          'norm' => $id_responden,
          'id_master_kuesioner' => $id_master_kuesioner,
          'jawaban' => $jawaban[0],
          'nilai_jawaban' => $jawaban[1],
          'keterangan_jawaban' => $keterangan_jawaban
       )
   );  */


if ($option=="kritik_saran"){				
		$process = curl_init($url);
		curl_setopt($process, CURLOPT_URL, $url);		
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");  //method yg digunakan..
		curl_setopt($process, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
		$return = curl_exec($process);
		curl_close($process);
		$response=json_decode($return, true); 		
		$status = $response['status'];
		$message = $response['data']['message'];
		if($status==200){
			echo '{"status":"1","pesan":"'.$message.'"}';													
		}else{
			echo '{"status":"2","pesan":"'.$message.'"}';												
		}		
}
?>