<?php
session_start();
error_reporting(0);

	//date_default_timezone_set('Asia/Jakarta');

if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}


					$kode_dokter = $_POST['kode_dokter'];
					$url="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/jumlah_pasien_perdokter/$kode_dokter";				
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
					$ch7 = curl_init($url);
					curl_setopt($ch7, CURLOPT_HTTPHEADER, $headers); 
					curl_setopt($ch7, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch7, CURLOPT_TIMEOUT, 5);
					curl_setopt($ch7, CURLOPT_HTTPGET, 1);
					curl_setopt($ch7, CURLOPT_SSL_VERIFYPEER, false);	
					$content7 = curl_exec($ch7); // json
					curl_close($ch7);	
					$resultarr7=json_decode($content7, true);	// array
					$datax['status'] = $resultarr7['status'];
					//echo"$datax[status] | $kode_dokter<br>";
					//print_r($resultarr);	
					if($datax['status']=="200"){						
						echo"<table class='table table-hover table-condensed table-bordered'>
						<thead>			
							<tr style='background-color:#FFFFFF;'>								
								<th style='text-align:left;' colspan='2'>
									Visite : <span class='badge badge-primary badge-pill'>".$resultarr7['data']['list_sudah']."</span>&nbsp; <b> | </b> &nbsp;
									<b style='color:red;'>Belum </b> : <span class='badge badge-primary badge-pill'>".$resultarr7['data']['list_belum']."</span>
								</th>								
							</tr>							
							<tr style='background-color:#7FFFD4;'>
								<th style='text-align:center;'>RM</th>
								<th style='text-align:center;'>Nama</th>
								
							</tr>							
						</thead>";
						
							$no=1;
							foreach ($resultarr7 as $name => $xdata){											
								foreach ($xdata as $name1 => $value7){
									foreach ($value7 as $name2 => $value2x){	
									/*$uri="192.168.1.223:1317/webservicesms/pasien/service/kunjungan_pasien_id/$value2x[rawatId]";	
   $uri2="192.168.1.223:1317/webservicesms/pasien/service/jp_detail_tindakan_id/$value2x[rawatId]";	   
   $uri3="192.168.1.223:1317/webservicesms/pasien/service/jp_detail_lab_id/$value2x[rawatId]";
   $uri4="192.168.1.223:1317/webservicesms/pasien/service/jp_detail_radio_id/$value2x[rawatId]";
   $uri5="192.168.1.223:1317/webservicesms/inquerybpd/service/obat_id_new_idkunjungan/$value2x[rawatId]";  
   $uri6="192.168.1.223:1317/webservicesms/inquerybpd/service/bhp_id_new_idkunjungan/$value2x[rawatId]";	
	
	$ch = curl_init($uri);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_HTTPGET, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);	
	$content = curl_exec($ch); // json
	curl_close($ch);	
	$resultarr=json_decode($content, true);	// array
	$kodedata = $resultarr['status'];
	if($kodedata=="200"){
		$rawatid = $resultarr['data']['list'][0]['rawatId'];
		$rawatrm = $resultarr['data']['list'][0]['rawatRm'];
		$rawatnama = $resultarr['data']['list'][0]['rawatNama'];
		$tgl_daftar = $resultarr['data']['list'][0]['rawatTglDaftar'];
		$tgl_pindah = $resultarr['data']['list'][0]['rawatTglPindah'];
		$tgl_keluar_ranap = $resultarr['data']['list'][0]['rawatTglKeluarRanap'];
		$rawat_jenis = $resultarr['data']['list'][0]['rawatJenis'];
		$jenis_ruangan = $resultarr['data']['list'][0]['jenis_ruangan'];
		$rawat_ruangan = $resultarr['data']['list'][0]['rawatRuangan'];
		$ruang = $resultarr['data']['list'][0]['ruang'];
		$rawat_poli = $resultarr['data']['list'][0]['rawatPoli'];
		$klinik = $resultarr['data']['list'][0]['klinik'];
		$rawat_dokter_id = $resultarr['data']['list'][0]['rawatDokterId'];
		$dokter = $resultarr['data']['list'][0]['dokter'];
		$rawat_tujuan_pindah = $resultarr['data']['list'][0]['rawatTujuanPindah'];
		$rawat_status_keluar = $resultarr['data']['list'][0]['rawatStatusKeluar'];
		$rawat_status = $resultarr['data']['list'][0]['rawatStatus'];
		$tgl_closing = $resultarr['data']['list'][0]['rawatTglClosing'];
		$create_time = $resultarr['data']['list'][0]['rawatCreateTime'];
		
	}	
	// tindakan
	$ch2 = curl_init($uri2);
	curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch2, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch2, CURLOPT_HTTPGET, 1);
	curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);	
	$content2 = curl_exec($ch2); // json
	curl_close($ch2);	
	$resultarr2=json_decode($content2, true);	// array
	$kodedata2 = $resultarr2['status'];		
		foreach ($resultarr2 as $name => $data){											
			foreach ($data as $name1 => $value1){								
				foreach ($value1 as $name2 => $value2){																										
					$jumlah_total_judulx = $jumlah_total_judulx+$value2['total'];
					$ftotal_jumlah_judulx = number_format($jumlah_total_judulx,0,",",".");
				}
			}																										
		}
	
	
	// laboratorium
	$ch3 = curl_init($uri3);
	curl_setopt($ch3, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch3, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch3, CURLOPT_HTTPGET, 1);
	curl_setopt($ch3, CURLOPT_SSL_VERIFYPEER, false);	
	$content3 = curl_exec($ch3); // json
	curl_close($ch3);	
	$resultarr3=json_decode($content3, true);	// array
	$kodedata3 = $resultarr3['status'];		
		foreach ($resultarr3 as $name => $data){											
			foreach ($data as $name1 => $value1){								
				foreach ($value1 as $name2 => $value2){																																				
					$xcek_total_lx= ($value2['jp']+$value2['js']+$value2['bhp'])*$value2['qty'];								
					$jumlah_total_judul_lx = $jumlah_total_judul_lx+$xcek_total_lx;
					$ftotal_jumlah_judul_lx = number_format($jumlah_total_judul_lx,0,",",".");
				}
			}																										
		}
	// radiologi
	$ch4 = curl_init($uri4);
	curl_setopt($ch4, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch4, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch4, CURLOPT_HTTPGET, 1);
	curl_setopt($ch4, CURLOPT_SSL_VERIFYPEER, false);	
	$content4 = curl_exec($ch4); // json
	curl_close($ch4);	
	$resultarr4=json_decode($content4, true);	// array
	$kodedata4 = $resultarr4['status'];		
		foreach ($resultarr4 as $name => $data){											
			foreach ($data as $name1 => $value1){								
				foreach ($value1 as $name2 => $value2){																																				
					$xcek_total_rx= ($value2['jp']+$value2['js']+$value2['bhp'])*$value2['qty'];								
					$jumlah_total_judul_rx = $jumlah_total_judul_rx+$xcek_total_rx;
					$ftotal_jumlah_judul_rx = number_format($jumlah_total_judul_rx,0,",",".");
				}
			}																										
		}
	// obat
	$ch5 = curl_init($uri5);
	curl_setopt($ch5, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch5, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch5, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch5, CURLOPT_HTTPGET, 1);
	curl_setopt($ch5, CURLOPT_SSL_VERIFYPEER, false);	
	$content5 = curl_exec($ch5); // json
	curl_close($ch5);	
	$resultarr5=json_decode($content5, true);	// array
	$kodedata5 = $resultarr5['status'];
		foreach ($resultarr5 as $name1 => $data1){									
			foreach ($data1 as $name2 => $valuex){									
				foreach ($valuex as $name3 => $value3){
					$xharga_jual_obat_total_judulx = $xharga_jual_obat_total_judulx+round($value3['harga_jual_obat'],4);																												
				}
			}
		}
	// bhp
	$ch6 = curl_init($uri6);
	curl_setopt($ch6, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt($ch6, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch6, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch6, CURLOPT_HTTPGET, 1);
	curl_setopt($ch6, CURLOPT_SSL_VERIFYPEER, false);	
	$content6 = curl_exec($ch6); // json
	curl_close($ch6);	
	$resultarr6=json_decode($content6, true);	// array
	$kodedata6 = $resultarr6['status'];
		foreach ($resultarr6 as $name1 => $data1){									
			foreach ($data1 as $name2 => $valuex){									
				foreach ($valuex as $name3 => $value3){												
					$xharga_jual_bhp_total_judulx = round($xharga_jual_bhp_total_judulx+$value3['harga_jual_bhp'],4);
				}
			}
		}
	$jumlah_total_biaya_pasien = $jumlah_total_judulx+$jumlah_total_judul_lx+$jumlah_total_judul_rx+$xharga_jual_obat_total_judulx+$xharga_jual_bhp_total_judulx;
	$fjumlah_total_biaya_pasien = number_format($jumlah_total_biaya_pasien,0,",",".");	*/
									$jumlen = strlen($value2x['rawatNama']);
									$nama = substr($value2x['rawatNama'],0,15);
									if($jumlen>10){
										$nama = substr($value2x['rawatNama'],0,15).'...';
									}else{
										$nama = $value2x['rawatNama'];
									}	
									if($value2x['visite']>0){
										$visite = "Sudah";
										$xnama = $nama;
									}else{
										$visite = "<b style='color:yellow;'>Belum</b>";
										$xnama = "<b style='font-weight:bold; color:red;'>".$nama."</b>";
									}		
									echo"
									<tr class='table-active' style='background-color:#FFFFFF;'>
										<td  align='center' style='vertical-align: top; width:5%; background-color:#F0FFFF; color:#000000;'><b>$value2x[rawatRm]</b></td>
										<td  align='left' style='vertical-align: top;'><span class='badge badge-primary badge-pill'>$visite</span>&nbsp;$xnama</td>	
																				
									</tr>
									<tr class='table-active' style='background-color:#FFFFFF;'>										
										<td  align='left' style='vertical-align: top;'>$value2x[selisih_hari] hari</td>	
										<td  align='left' style='vertical-align: top;'>$value2x[ruangan]</td>											
									</tr>
									";
									
									}
								}
							}																		
											
					echo"</table>";						
					}else{
						echo"Mohon maaf not found kode dokter ";
					}
					
				?>	
		
	