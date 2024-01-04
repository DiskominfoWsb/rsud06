<?php
session_start();
error_reporting(0);

	//date_default_timezone_set('Asia/Jakarta');

if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}

					$kode_klinik = $_POST['kode_klinik'];
					if($_SESSION['xlevel']=="admin"){
						$url="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/tampil_online_klinik_kode/$kode_klinik";
					}else if($_SESSION['xlevel']=="dokter"){
						$url="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/tampil_online_klinik/$_SESSION[xsub_user_dokter]/$_SESSION[xkode_klinik]";
					}		
					
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
					$ch = curl_init($url);
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_TIMEOUT, 5);
					curl_setopt($ch, CURLOPT_HTTPGET, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	
					$content = curl_exec($ch); // json
					curl_close($ch);	
					$resultarr=json_decode($content, true);	// array
					$datax['status'] = $resultarr['status'];
					if($datax['status']=="200"){
							
						$varhari        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
						$hariberikutnya = date("Y-m-d", $varhari);
						$tglnow = tgl_indo_full($hariberikutnya);
						echo"<br><b><u>$tglnow</u></b><br>";
						echo"<table class='table table-hover table-condensed table-bordered'>
						<thead>			
							<tr style='background-color:#7FFFD4;'>
								<th style='text-align:center;'>No</th>
								<th style='text-align:center;'>RM</th>
								<th style='text-align:center;'>Nama</th>
								
							</tr>							
						</thead>";
						
							$no=1;
							foreach ($resultarr as $name => $xdata){											
								foreach ($xdata as $name1 => $value1){
									echo"
									<tr class='table-active' style='background-color:#FFFFFF;'>
										<td  align='center' style='vertical-align: top; width:5%; background-color:#F0FFFF; color:red;'><b>$value1[no_antrian_klinik]"; 										
										echo"</b></td>										
										<td  align='left' style='vertical-align: top;'>$value1[no_rm]</td>	
										<td  align='left' style='vertical-align: top;'>$value1[pasien_nm]</td>
											
									</tr>
									
								";								
								}
							}																		
											
					echo"</table>";						
					}else{
						echo"Mohon maaf not found kode klinik ";
					}
						function tgl_indo_full($tgl){
							$tanggal = substr($tgl,8,2);
							$bulan = getBulan_full(substr($tgl,5,2));
							$tahun = substr($tgl,0,4);
							return $tanggal.' '.$bulan.' '.$tahun;		 
						}
						function getBulan_full($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
	}
				?>	
		
	