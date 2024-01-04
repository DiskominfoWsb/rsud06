<?php
session_start();
if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}
					error_reporting(0);
					// error_reporting(E_ALL);
					$uri="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/tampil_kritik_saran/$_SESSION[xusername]";	
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
					
					if($datax['status']=="200"){
						echo"<table class='table table-hover table-condensed table-bordered'>
								<thead>		
									<tr style='background-color:#e7e7e7;'>
										<th colspan='2'>List Kritik & Saran</th>
										
								</tr>
							</thead>
							<tbody>";				
							$no=1;
							//print_r($resultarr);
							//if(is_array($resultarr) || is_object($resultarr)){	
							foreach ($resultarr as $name => $xdata){											
								foreach ($xdata as $name1 => $value1){	
									$urix="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/tampil_kritik_saran_balasan/$value1[id_kritik_saran]";
										$chx = curl_init($urix);
										curl_setopt($chx, CURLOPT_HTTPHEADER, $headers); 
										curl_setopt($chx, CURLOPT_RETURNTRANSFER, 1);
										curl_setopt($chx, CURLOPT_TIMEOUT, 5);
										curl_setopt($chx, CURLOPT_HTTPGET, 1);
										curl_setopt($chx, CURLOPT_SSL_VERIFYPEER, false);	
										$contentx = curl_exec($chx); // json
										curl_close($chx);	
										$resultarrx=json_decode($contentx, true);	// array
										$dataxx['status'] = $resultarrx['status'];
										$dataxx['pesan'] = $resultarrx['data']['pesan'];
										
									echo "<tr style='background-color:#f1ee9b; vertical-align: top;'>";									
									echo"<td align='center'  style='vertical-align: top; width:5%; background-color:#F0FFFF; color:red;'>$no</td>";
									echo"<td align='left' style='vertical-align: top; color:red;'>$value1[tanggal]</td>";	
									echo"</tr>";
									echo "<tr style='background-color:#f1ee9b; vertical-align: top;'>";																	
									echo"<td align='left' colspan='2' style='vertical-align: top; text-align:justify;'>$value1[pesan]</td>";
									echo"</td></tr>";
									if($dataxx['status']=="200"){
										echo "<tr style='background-color:#f1ee9b; vertical-align: top;'>";																	
										echo"<td align='left' colspan='2' style='vertical-align: top; text-align:justify;'><b><u>Balasan </u></b> : $dataxx[pesan]</td>";
										echo"</td></tr>";
									}	
									$no++;									
								}
							}
							//}							
						echo"</tbody>
						</table>
						";
					}
?>