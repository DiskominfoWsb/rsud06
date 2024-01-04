<?php
session_start();
 error_reporting(0);
if(empty($_SESSION['xusername']) AND empty($_SESSION['xpassword'])){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login System</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/jquery-1.11.3-jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<style>
		body {
			background-color:#eee;
		}
		.row {
			margin:100px auto;
			width:300px;
			text-align:center;
		}
		.login {
			background-color:#fff;
			padding:20px;
			margin-top:20px;
		}
	</style>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<script>
$(document).ready(function(){
	$("#ruangan").change(function(){													
		var ruangan = $("#ruangan").val();		
		ftampil_pertanyaan(ruangan);
	});	
	function ftampil_pertanyaan(x){			
		var id_master = x;				
		$.ajax({
			type 	: "POST",
			url		: "form-pertanyaan-kuesioner-rsud-krt-setjonegoro-wonosobo.html",
			data 	: "id_master="+id_master,			
			success : function(data){				
				$("#tampil_form_pertanyaan_kuesioner").html(data);
			}
		});
	}
	$("#tampil_data_kuesioner").load('tampil-kuesioner-rsud-krt-setjonegoro-wonosobo.html');
	
});

</script>
<body>
	
	<div class="container">		
			<h2><?php echo $_SESSION['xnamauser']; 
						$uri="https://simrsud.wonosobokab.go.id/webservicesms/pasien/service/tampil_combo_unit_instalasi";	
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
							$data['status'] = $resultarr['status'];		
			?></h2>
			
			<div class="login">				
				<?php
						if($_SESSION['xlevel']=="admin"){							
							echo"<a href='informasi-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-globe'></span>&nbsp;Info</a>&nbsp;| &nbsp;
							<a href='kuesioner-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-check'></span>&nbsp;Kuesioner </a>&nbsp;| &nbsp;
							<a href='kritik-dan-saran-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-envelope'></span>&nbsp;Saran</a>&nbsp; | &nbsp;
							<a href='pasien-online-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-phone'></span>&nbsp;Online</a>&nbsp; | &nbsp;
							<a href='pasien-ranap-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-bed'></span>&nbsp;Ranap</a>&nbsp; | &nbsp;
							<a href='logout-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Logout</a>";
						}else if($_SESSION['xlevel']=="dokter"){
							echo"<a href='informasi-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-globe'></span>&nbsp;Info</a>&nbsp;| &nbsp;
							<a href='pasien-online-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-phone'></span>&nbsp;Online</a>&nbsp; | &nbsp;
							<a href='pasien-ranap-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-bed'></span>&nbsp;Ranap</a>&nbsp; | &nbsp;
							<a href='logout-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Logout</a>";	
						}else{
							echo"<a href='informasi-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-globe'></span>&nbsp;Info</a>&nbsp;| &nbsp;
							<a href='kuesioner-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-check'></span>&nbsp;Kuesioner </a>&nbsp;| &nbsp;
							<a href='kritik-dan-saran-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-envelope'></span>&nbsp;Saran</a>&nbsp; | &nbsp;							
							<a href='logout-rsud-krt-setjonegoro-wonosobo.html'><span class='glyphicon glyphicon-log-out'></span>&nbsp;Logout</a>";	
						}
					
					echo"<hr>";
				?>
				<p style="text-align:justify; font-weight:bold;">Mohon kesediaanya untuk mengisi 2 Kuesioner Kepuasan Pelayanan di <i>RSUD KRT. Setjonegoro Wonosobo</i> Sebagai bahan untuk meningkatkan Mutu Pelayanan Kami</p>
				<input type="hidden" name="norm" id="norm" value="<?php echo"$_SESSION[xusername]";?>" class="form-control" placeholder="Nomor RM" />
				<input type="hidden" name="nama" id="nama" value="<?php echo"$_SESSION[xnamauser]";?>" class="form-control" placeholder="Nama User" />
				<input type="hidden" name="nik" id="nik" value="<?php echo"$_SESSION[xnik]";?>" class="form-control" placeholder="NIK" />
				<div class="input-group col-sm-2">						
					<select class="form-control" id="ruangan">
						<option value="kosong" selected>PILIH JENIS KUESIONER</option>
						<?php						
							if($data['status']=="200"){						
								foreach ($resultarr as $name => $xdata){											
									foreach ($xdata as $name1 => $value1){
										echo"<option value='$value1[id_pelayanan_master_umum]#$value1[sub_master]'>$value1[sub_master]</option>";
									}
								}		
							}else{
								//echo '<div class="alert alert-danger">Maaf Anda Belum Login</div>';
							}
						?>
					</select>																
				</div>	
				<br>
				<div id="tampil_form_pertanyaan_kuesioner"></div>
				<div id="tampil_data_kuesioner"></div>	
					<div class="clearfix"></div>				
			</div>
			Copyright &copy; 2021 wwww.rsud.wonosobokab.go.id
		
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>