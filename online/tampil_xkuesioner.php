<?php
session_start();
if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}
					error_reporting(0);
					// error_reporting(E_ALL);
					$uri="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/tampil_kuesioner/$_SESSION[xusername]";	
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
						$tgl_now=date("d-m-Y");
						echo"<table class='table table-hover table-condensed table-bordered'>
								<thead>	
									<tr style='background-color:#e7e7e7;'>
										<th colspan=5>Hari Ini $tgl_now</th>																				
									</tr>
									<tr style='background-color:#e7e7e7;'>
										<th valign='top'>Unit</th>										
										<th valign='top'>Kode 4</th>
										<th valign='top'>Kode 3</th>
										<th valign='top'>Kode 2</th>
										<th valign='top'>Kode 1</th>
									</tr>
							</thead>
							<tbody>";				
							$no=1;
							//print_r($resultarr);
							//if(is_array($resultarr) || is_object($resultarr)){	
							foreach ($resultarr as $name => $xdata){											
								foreach ($xdata as $name1 => $value1){	
									
										
									echo "<tr style='background-color:#f1ee9b; vertical-align: top;'>";																	
									echo"<td align='left' style='vertical-align: top; color:red;'>$value1[sub_unit]</td>";	
									echo"<td align='right' style='vertical-align: top; color:red;'>$value1[puas]</td>";	
									echo"<td align='right' style='vertical-align: top; color:red;'>$value1[kode_2]</td>";	
									echo"<td align='right' style='vertical-align: top; color:red;'>$value1[kode_1]</td>";	
									echo"<td align='right' style='vertical-align: top; color:red;'>$value1[tidak_puas]</td>";	
									echo"</tr>";
									
																
								}
							}
							//}							
						echo"</tbody>
						</table>
						";
					}
?>