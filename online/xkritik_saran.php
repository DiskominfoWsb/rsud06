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
	$("#tampil_data").load('tampil-kritik-dan-saran-rsud-krt-setjonegoro-wonosobo.html');	
	// simpan
	$("#simpan").click(function(){				
		simpan();
	});
	function simpan(){				
		var norm = $("#norm").val();		
		var nama = $("#nama").val();
		var nik  = $("#nik").val();	
		var var_kritik_saran = $("#var_kritik_saran").val();
		var bintang = $("#bintang").val();
		
		if(bintang=='kosong'){
			alert('Maaf, Bintang Belum di pilih');
			$("#bintang").focus();
			return false();
		}		
		if(norm.length==0){
			alert('Maaf, Norm Tidak Terdeteksi Silahkan Login Kembali');
			$("#bintang").focus();
			return false();
		}
		if(nama.length==0){
			alert('Maaf, Nama Tidak Terdeteksi Silahkan Login Kembali');
			$("#bintang").focus();
			return false();
		}
		if(nik.length==0){
			alert('Maaf, Nik Tidak Terdeteksi Silahkan Login Kembali');
			$("#bintang").focus();
			return false();
		}
		if(var_kritik_saran.length==0){
			alert('Maaf, Kritik & Saran Tidak Boleh Kosong');
			$("#bintang").focus();
			return false();
		}
		
		$.ajax({
			type	: "POST",
			url		: "simpan-rsud-krt-setjonegoro-wonosobo.html",			
			data	:"option=kritik_saran&norm="+norm+
					"&nama="+nama+
					"&nik="+nik+
					"&var_kritik_saran="+var_kritik_saran+
					"&bintang="+bintang,	
			dataType: "json",			
			success	: function(data){			
				if(data.status==1){	
					alert('OK '+data.pesan);					
					$("#bintang").val('kosong');
					$("#var_kritik_saran").val('');					
					$("#tampil_data").load('tampil-kritik-dan-saran-rsud-krt-setjonegoro-wonosobo.html');					
				}else if(data.status==2){					
					alert('NO '+data.pesan);						
					$("#bintang").focus();
					$("#bintang").select();
				}				
			}
		});
	}
	
});

</script>
<body>
	
	<div class="container">
		
			<h2><?php echo $_SESSION['xnamauser']; ?></h2>
			
			<div class="login">				
				<?php 
						if($_SESSION['xlevel']=="admin" OR $_SESSION['xlevel']=="direktur"){							
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
				
				<input type="hidden" name="norm" id="norm" value="<?php echo"$_SESSION[xusername]";?>" class="form-control" placeholder="Nomor RM" />
				<input type="hidden" name="nama" id="nama" value="<?php echo"$_SESSION[xnamauser]";?>" class="form-control" placeholder="Nama User" />
				<input type="hidden" name="nik" id="nik" value="<?php echo"$_SESSION[xnik]";?>" class="form-control" placeholder="NIK" />
				<div class="input-group col-sm-2">								
					<select class="form-control" id="bintang">
						<option value="kosong" selected>.:: PILIH BINTANG ::.</option>
						<option value="1">1 : Sangat Tidak Puas</option>									
						<option value="2">2 : Tidak Puas</option>
						<option value="3">3 : Cukup Puas</option>
						<option value="4">4 : Puas</option>
						<option value="5">5 : Sangat Puas</option>
					</select>																
				</div>	
				<br>			
				<textarea name="var_kritik_saran" cols="40" rows="5" id="var_kritik_saran" class="form-control" placeholder="Kritik & Saran"/></textarea>
				<br>
					<div class="form-group">
						<button type="submit" class="btn btn-success" id="simpan" name="btn-signup">								
							<span id='kunci3' class="glyphicon glyphicon-floppy-save"></span>&nbsp; SAVE
						</button>					
					</div>                       
					<div class="clearfix"></div> 				
				<div id="tampil_data"></div>	
			</div>
			Copyright &copy; 2021 wwww.rsud.wonosobokab.go.id
		
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>