<?php
session_start();
if(isset($_SESSION['xusername']) AND isset($_SESSION['xpassword'])){
	header("Location: xinfo.php");
}
//include("koneksi.php");
					
					$username	= $_POST['username'];
					$password	= $_POST['password'];					
					
					date_default_timezone_set('UTC');
					$uri="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/login_norm/$username/$password";	
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
						"Content-Type: application/json charset=utf-8" 
					);    
					$ch = curl_init($uri);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_TIMEOUT, 5);
					curl_setopt($ch, CURLOPT_HTTPGET, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	
					$content = curl_exec($ch); // json
					curl_close($ch);	
					$resultarr=json_decode($content, true);	// array
					$datax['status'] = $resultarr['status'];
					$datax['norm'] = $resultarr['data']['norm'];
					$datax['nik'] = $resultarr['data']['nik'];
					$datax['nama'] = $resultarr['data']['nama'];
					$datax['nohp'] = $resultarr['data']['nohp'];
					$datax['level'] = $resultarr['data']['level'];
					$datax['kode_klinik'] = $resultarr['data']['kode_klinik'];
					$datax['status_sub_user'] = $resultarr['data']['status_sub_user'];
					$exp_kode = explode("#",$datax['kode_klinik']);
					$exp_sub_user = explode("#",$datax['status_sub_user']);
					if($datax['status']=="200"){
						//echo"$datax[norm] | $datax[nama]";
						$_SESSION['xusername']= $datax['norm'];
						$_SESSION['xnamauser']= $datax['nama'];
						$_SESSION['xpassword']= $datax['nohp'];
						$_SESSION['xnik']= $datax['nik'];
						$_SESSION['xlevel']= $datax['level'];
						$_SESSION['xkode_klinik_1']= $exp_kode[0];
						$_SESSION['xkode_klinik_2']= $exp_kode[1];
						$_SESSION['xkode_klinik']=$datax['kode_klinik'];
						$_SESSION['xsub_user_dokter_dms']= $exp_sub_user[2]; // (D009) kode dokter rajal#user#9#D009
						$_SESSION['xsub_user_dokter']= $exp_sub_user[3]; // (D009) kode dokter rajal#user#9#D009
						header("Location: informasi-rsud-krt-setjonegoro-wonosobo.html");
					}else{
						header("Location: login-rsud-krt-setjonegoro-wonosobo.html");
					}
					//$_SESSION['xusername']= $datax['nama'];
					//$_SESSION['xpassword']= $datax['nik'];
					//header("Location: info.php");
?>

					
					