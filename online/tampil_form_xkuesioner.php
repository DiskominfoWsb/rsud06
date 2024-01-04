<script src="assets/jquery-1.11.3-jquery.min.js"></script>
<script>
// ini menyiapkan dokumen agar siap grak :)
$(document).ready(function(){	
		$("#simpan_kuesioner").click(function(){				
			fsimpan_kuesioner();			
		});			
		var input_cek = $("#input_cek").val();	
		if(parseInt(input_cek)>0){
			$("#simpan_kuesioner").fadeOut();	
		}else{
			$("#simpan_kuesioner").fadeIn();	
		}	
		function fsimpan_kuesioner(){									
			var n = $("#n").val();
			var id_master_pelayanan_umum = $("#id_master_pelayanan_umum").val();			
			for(var i =1; i <= n-1 ; ++i){	
				var xid_responden = $("#xid_responden"+i).val();						
				var xid_master_kuesioner = $("#xid_master_kuesioner"+i).val();
				var xjawaban = $("#xjawaban"+i).val();						
				var xketerangan_jawaban = $("#xketerangan_jawaban"+i).val();	
				$.ajax({
					type 	: "POST",
					url		: "simpan-kuesioner-rsud-krt-setjonegoro-wonosobo.html",						
					data 	: "option=jawaban_kuesioner&n="+n+
					"&id_responden="+xid_responden+
					"&jawaban="+xjawaban+
					"&id_master_pelayanan_umum="+id_master_pelayanan_umum+
					"&id_master_kuesioner="+xid_master_kuesioner+
					"&keterangan_jawaban="+xketerangan_jawaban,					
					dataType : "json",
					success	: function(data){
						//alert('Kuesioner Berhasil Di Simpan '+data.pesan);	
						if(data.status==1){				
							if(data.pesan>=n-2){								
								alert('Kuesioner Berhasil di Simpan');
								$("#simpan_kuesioner").fadeOut();
								$("#tampil_data_kuesioner").load('tampil-kuesioner-rsud-krt-setjonegoro-wonosobo.html');	
							}else{
								//alert('Cek dua : '+data.pesan+' | n : '+n);
							}		
						}else if(data.status==2){							
								//alert('Cek tiga : '+data.pesan+' | n : '+n);	
						}						
					}							
				});																	
			}		
		}
});	
					
</script>
<?php
session_start();
error_reporting(0);
if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}
					$idx = explode("#",$_POST['id_master']);				
					$uri="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/tampil_pertanyaan_kuesioner/$idx[0]";	
					$url="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/cek_jawaban_yang_masuk/$_SESSION[xusername]/$idx[0]";
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
							<tr style='background-color:#7FFFD4;'>	
								<th style='text-align:center;'>No</th>
								<th style='text-align:center;'>Pertanyaan</th>
								
							</tr>							
						</thead>";
						
							$no=1;
							foreach ($resultarr as $name => $xdata){											
								foreach ($xdata as $name1 => $value1){
									echo"
									<tr class='table-active' style='background-color:#FFFFFF;'>
										<td  align='center' style='vertical-align: top; width:5%; background-color:#F0FFFF; color:red;'><b>$no</b></td>
										<td align='left' style='vertical-align: middle;'>	";																						 
											echo"
											<input type='hidden' name='xid_responden$no' id='xid_responden$no' value='$_SESSION[xusername]' value='' class='form-control' placeholder='ID Responden' />											
											<input type='hidden' name='xid_master_kuesioner$no' id='xid_master_kuesioner$no' value='$value1[id_master_kuesioner]' class='form-control' placeholder='ID Master Kuesioner' />
											<b>$value1[pertanyaan]</b>";														 
										echo"</td>																												
									</tr>
									<tr class='table-active' style='background-color:#FFFFFF;'>																		
										<td  align='left' style='vertical-align: top;' colspan='2'>	
											<div class='input-group'>																
												<select class='form-control' id='xjawaban$no'>";												
													if($value1['jawaban_a']!="kosong" AND $value1['jawaban_b']=="kosong" AND $value1['jawaban_c']=="kosong" AND $value1['jawaban_d']!="kosong"){
														echo"<option value='$value1[jawaban_a]#$value1[nilai_jawaban_a]'>$value1[jawaban_a]</option>										
															<option value='$value1[jawaban_d]#$value1[nilai_jawaban_d]'>$value1[jawaban_d]</option>														
														";
													}else if($value1['jawaban_a']!="kosong" AND $value1['jawaban_b']!="kosong" AND $value1['jawaban_c']=="kosong" AND $value1['jawaban_d']!="kosong"){
														echo"<option value='$value1[jawaban_a]#$value1[nilai_jawaban_a]'>$value1[jawaban_a]</option>	
															<option value='$value1[jawaban_b]#$value1[nilai_jawaban_b]'>$value1[jawaban_b]</option>	
															<option value='$value1[jawaban_d]#$value1[nilai_jawaban_d]'>$value1[jawaban_d]</option>														
														";
													}else if($value1['jawaban_a']!="kosong" AND $value1['jawaban_b']=="kosong" AND $value1['jawaban_c']!="kosong" AND $value1['jawaban_d']!="kosong"){
														echo"<option value='$value1[jawaban_a]#$value1[nilai_jawaban_a]'>$value1[jawaban_a]</option>	
															<option value='$value1[jawaban_c]#$value1[nilai_jawaban_c]'>$value1[jawaban_c]</option>	
															<option value='$value1[jawaban_d]#$value1[nilai_jawaban_d]'>$value1[jawaban_d]</option>														
														";
													}else if($value1['jawaban_a']!="kosong" AND $value1['jawaban_b']!="kosong" AND $value1['jawaban_c']!="kosong" AND $value1['jawaban_d']!="kosong"){
														echo"<option value='$value1[jawaban_a]#$value1[nilai_jawaban_a]'>$value1[jawaban_a]</option>	
															<option value='$value1[jawaban_b]#$value1[nilai_jawaban_b]'>$value1[jawaban_b]</option>
															<option value='$value1[jawaban_c]#$value1[nilai_jawaban_c]'>$value1[jawaban_c]</option>	
															<option value='$value1[jawaban_d]#$value1[nilai_jawaban_d]'>$value1[jawaban_d]</option>														
														";
													}else{
														echo"<option value='#'>Mohon Maaf Error</option>";
													}  														
												echo"</select>
											</div>
										</td>																											
									</tr>
									<tr class='table-active' style='background-color:#FFFFFF;'>																												
										<td  align='left' style='vertical-align: top;' colspan='2'>	
											<input type='text' name='xketerangan_jawaban$no' id='xketerangan_jawaban$no' class='form-control' placeholder='Alasannya?' />
										</td>																		
									</tr>
								";
								$no++;	
								}
							}											
							echo"<tr class='table-active' style='background-color:#7FFFD4;'>
									<td align='left' colspan='19' style='font-weight:bold; margin:0; padding:0;' >
									<input type='hidden' id='n' value='".$no."'/>
									<input type='hidden' id='id_master_pelayanan_umum' value='".$idx[0]."'/>";
									// cek apakah data sudah masuk atau belum	
									$chx = curl_init($url);
									curl_setopt($chx, CURLOPT_HTTPHEADER, $headers); 
									curl_setopt($chx, CURLOPT_RETURNTRANSFER, 1);
									curl_setopt($chx, CURLOPT_TIMEOUT, 5);
									curl_setopt($chx, CURLOPT_HTTPGET, 1);
									curl_setopt($chx, CURLOPT_SSL_VERIFYPEER, false);	
									$contentx = curl_exec($chx); // json
									curl_close($chx);	
									$resultarrx=json_decode($contentx, true);	// array
									$dataxx['num_cek'] = $resultarrx['data']['jml_data'];									
									if($dataxx['num_cek']<=0){
										echo"<button type='submit' class='btn btn-danger' id='simpan_kuesioner' name='btn-signup'>																																			
											<span id='kunci_kuesioner' class='glyphicon glyphicon-floppy-save'></span>&nbsp; SIMPAN
										</button>";	
									}else{
										echo"<p style='color:red'>&nbsp; Maaf Kuesioner Sudah Di Input Padah Hari ini</p>";
									}								
									echo"
									<input type='hidden' name='input_cek' id='input_cek' value='$dataxx[num_cek]' class='form-control' placeholder='input cek' />						
							</td>
								</tr>";
											
					echo"</table>";						
					}else{
						echo"Mohon maaf kuesioner <b><u><i>$idx[1]</i></u></b> belum di buat";
					}	
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>