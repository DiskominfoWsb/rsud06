// JavaScript Document
$(document).ready(function(){
	$(function(){
		$('button').hover(
			function() { $(this).addClass('ui-state-hover'); }, 
			function() { $(this).removeClass('ui-state-hover'); }
		);
	});	
	$('#form_input').dialog({
		  autoOpen: false,
		  show: "blind",
		  hide: "blind",
		  width: 1050,
		  modal	: true,
		  resizable:false,
		  buttons: {
			  "Simpan": function() { 				  
				  simpan();
			  }, 
			  "Batal": function() { 				  
				  $(this).dialog("close"); 
			  } 
		  }
	});	
	$("#jam").mask("99:99:99");
	$("#tanggallahir").mask("99-99-9999");
	$("#tanggallahir").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth: true,
			changeYear: true,
			yearRange: '-66:+0',
			monthNamesShort: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
	});
	$("#tanggaldaftar").mask("99-99-9999");
	$("#tanggaldaftar").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth: true,
			changeYear: true,
			yearRange: '-66:+0',
			monthNamesShort: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
	});	
	$("#loader").hide();	
	// atribut form
	fwarnaform();	
	// implementasi enter
	$("#norm").keypress(function(){
		var e="#nomor2";
		enter(e);
	});
	$("#nomor2").keypress(function(){
		var e="#namakecil";
		enter(e);
	});
	$("#namakecil").keypress(function(){
		var e="#namadewasa";
		enter(e);
	});
	$("#namadewasa").keypress(function(){
		var e="#jk";
		enter(e);
	});
	$("#jk").keypress(function(){
		var e="#hari";
		enter(e);
	});	
	$("#hari").keypress(function(){
		var e="#jam";
		enter(e);
	});
	$("#jam").keypress(function(){
		var e="#tanggallahir";
		enter(e);
	});
	$("#tanggallahir").keypress(function(){
		var e="#tanggaldaftar";
		enter(e);
	});
	$("#tanggaldaftar").keypress(function(){
		var e="#statuslahir";
		enter(e);
	});
	$("#statuslahir").keypress(function(){
		var e="#warganegara";
		enter(e);
	});	
	$("#warganegara").keypress(function(){
		var e="#namabapak";
		enter(e);
	});
	$("#namabapak").keypress(function(){
		var e="#umurbapak";
		enter(e);
	});
	$("#umurbapak").keypress(function(){
		var e="#namaibu";
		enter(e);
	});
	$("#namaibu").keypress(function(){
		var e="#umuribu";
		enter(e);
	});
	$("#umuribu").keypress(function(){
		var e="#provinsi";
		enter(e);
	});
	$("#provinsi").keypress(function(){
		var e="#kabupaten";
		enter(e);
	});
	$("#kabupaten").keypress(function(){
		var e="#kecamatan";
		enter(e);
	});
	$("#norm").keyup(function(e){				
		var len = this.value.length;		
		if (len <=5) {			
			$(".input").val('');	
			fwarnaform();
			$("#loader").fadeOut();					
		}else{			
			$("#loader").fadeIn();		
			var norm = $("#norm").val();	
			fnorm(norm);				
		}	
	});
	$("#norm").click(function(e){				
		var len = this.value.length;		
		if (len <=5) {			
			$(".input").val('');	
			fwarnaform();
			$("#loader").fadeOut();					
		}else{			
			$("#loader").fadeIn();		
			var norm = $("#norm").val();	
			fnorm(norm);				
		}	
	});	
	$("#norm").keypress(function(event){		
		var charCode=(event.which)?event.which:event.keyCode
		if((charCode>=48 && charCode<=57) || charCode==46 || charCode==44 || charCode==8 || charCode==9 || charCode==13){			
			return true;
		}else{				
			alert('Maaf Text Hanya Bisa Di Isikan Angka');			
			$("#norm").focus();
			$("#norm").val('');
			return false;
		}
	});
	$("#umurbapak").keypress(function(event){		
		var charCode=(event.which)?event.which:event.keyCode
		if((charCode>=48 && charCode<=57) || charCode==46 || charCode==44 || charCode==8 || charCode==9 || charCode==13){
			return true;
		}else{				
			alert('Maaf Text Hanya Bisa Di Isikan Angka');			
			$("#umurbapak").focus();
			$("#umurbapak").val('');
			return false;
		}
	});	
	$("#umuribu").keypress(function(event){		
		var charCode=(event.which)?event.which:event.keyCode
		if((charCode>=48 && charCode<=57) || charCode==46 || charCode==44 || charCode==8 || charCode==9 || charCode==13){
			return true;
		}else{				
			alert('Maaf Text Hanya Bisa Di Isikan Angka');			
			$("#umuribu").focus();
			$("#umuribu").val('');
			return false;
		}
	});
	// cari barang
	$("#jk").change(function(){			
		var jk = $("#jk").val();
		if(jk==''){
			$("#nomor2").val('');
		}else{			
			$.ajax({
				type 	: "POST",
				url		: "modul/surat_kelahiran/proses.php",
				data 	: "option=jk&jk="+jk,			
				success : function(msg){					
					data = msg.split("|");										
					$("#nomor2").val(data[0]);				
				}
			});
		}		
	});	
	// fungsi nomor rekam medis
	function fnorm(f){
		$.ajax({
			type 	: "POST",
			url		: "modul/surat_kelahiran/proses.php",
			data 	: "option=nomorrm&norm="+f,			
			success : function(msg){					
				data = msg.split("|");					
				$("#namakecil").val(data[0]);
				$("#jk").val(data[1]);
				$("#tanggallahir").val(data[2]);
				$("#tanggaldaftar").val(data[3]);
				$("#namabapak").val(data[4]);
				$("#namaibu").val(data[5]);
				$("#provinsi").val(data[6]);
				$("#kabupaten").val(data[7]);
				$("#kecamatan").val(data[8]);
				$("#kelurahan").val(data[9]);
				$("#kota").val(data[10]);
				$("#jalan").val(data[11]);
				$("#nomor2").val(data[12]);
				$("#nomor4").val(data[13]);
				$("#nomor5").val(data[14]);
				$("#statuslahir").val(data[15]);
				$("#warganegara").val(data[16]);
				$("#loader").fadeOut();
				$("#namakecil").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#namakecil").attr("disabled",false);	
				$("#jk").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#jk").attr("disabled",false);
				$("#nomor2").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#nomor2").attr("disabled",false);
				$("#nomor4").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#nomor4").attr("disabled",false);
				$("#nomor5").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#nomor5").attr("disabled",false);
				$("#tanggallahir").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#tanggallahir").attr("disabled",false);
				$("#namabapak").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#namabapak").attr("disabled",false);
				$("#namaibu").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#namaibu").attr("disabled",false);
				$("#provinsi").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#provinsi").attr("disabled",false);
				$("#kabupaten").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#kabupaten").attr("disabled",false);
				$("#kecamatan").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#kecamatan").attr("disabled",false);
				$("#kelurahan").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#kelurahan").attr("disabled",false);
				$("#kota").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#kota").attr("disabled",false);
				$("#jalan").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});
				$("#jalan").attr("disabled",false);
			}
		});
	}
	$("#tanggal").mask("99-99-9999");
	$("#tanggal").datepicker({
		dateFormat:"dd-mm-yy",
		changeMonth: true,
		changeYear: true,
		yearRange: '-66:+0',
		monthNamesShort: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
	});
	$("#total").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});							
	$("#total").keypress(function(event){		
		var charCode=(event.which)?event.which:event.keyCode
		if((charCode>=48 && charCode<=57) || charCode==46 || charCode==44 || charCode==8 || charCode==9 || charCode==13){			
			return true;
		}else{				
			alert('Maaf Text Hanya Bisa Di Isikan Angka');			
			$("#total").focus();
			$("#total").val('');
			return false;
		}
	});	
	function formatCurrency(num){
		num = num.toString().replace(/\Rp.|\,/g,'');
		if(isNaN(num))
			num = "0";
			sign = (num == (num = Math.abs(num)));
			num = Math.floor(num*100+0.50000000001);
			cents = num%100;
			num = Math.floor(num/100).toString();
			if(cents<10)
				cents = "0" + cents;
				for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
					num = num.substring(0,num.length-(4*i+3))+'.'+
					num.substring(num.length-(4*i+3));
				return (((sign)?'':'-') + '' + num + '');
	}		
	$("#tampil_data").load('modul/surat_kelahiran/tampil_data.php');
	$('#tambah').click(function(){										
		$(".input").val('');
		$("#norm").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});			
		$("#norm").attr("disabled",false);			
		$("#norm").val('');	
		fwarnaform();
		$('#form_input').dialog('open');
		return false;
	});	
	function fwarnaform(){
		$("#norm").css({"background-color":"#b7f959","border-collapse":"collapse","border":"1px solid #aabbcc"});				
		$("#namakecil").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#namakecil").attr("disabled",true);	
		$("#jk").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#jk").attr("disabled",true);
		$("#jk").val('');
		$("#hari").val('');
		$("#nomor2").val('');
		$("#nomor2").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#nomor2").attr("disabled",true);
		$("#nomor4").val('');
		$("#nomor4").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#nomor4").attr("disabled",true);
		$("#nomor5").val('');
		$("#nomor5").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#nomor5").attr("disabled",true);
		$("#statuslahir").val('');
		$("#warganegara").val('');
		$("#kelahiranke").val('');
		$("#tanggallahir").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#tanggallahir").attr("disabled",true);
		$("#namabapak").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#namabapak").attr("disabled",true);
		$("#namaibu").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#namaibu").attr("disabled",true);
		$("#provinsi").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#provinsi").attr("disabled",true);
		$("#kabupaten").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#kabupaten").attr("disabled",true);
		$("#kecamatan").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#kecamatan").attr("disabled",true);
		$("#kelurahan").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#kelurahan").attr("disabled",true);
		$("#kota").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#kota").attr("disabled",true);
		$("#jalan").css({"background-color":"#ffff80","border-collapse":"collapse","border":"1px solid #aabbcc"});
		$("#jalan").attr("disabled",true);		
	}	
	function simpan(){
		var id = $("#id").val();		
		var cari = $("#txt_cari").val();
		var nomor1 = $("#nomor1").val();
		var nomor2 = $("#nomor2").val();
		var nomor3 = $("#nomor3").val();
		var nomor4 = $("#nomor4").val();
		var nomor5 = $("#nomor5").val();
		var nomor6 = $("#nomor6").val();
		var norm= $("#norm").val();
		var namakecil= $("#namakecil").val();	
		var namadewasa = $("#namadewasa").val();		
		var jk= $("#jk").val();
		var hari= $("#hari").val();				
		var jam= $("#jam").val();
		var tanggallahir= $("#tanggallahir").val();
		var tanggaldaftar= $("#tanggaldaftar").val();
		var statuslahir= $("#statuslahir").val();
		var warganegara= $("#warganegara").val();
		var namabapak= $("#namabapak").val();
		var umurbapak= $("#umurbapak").val();
		var namaibu= $("#namaibu").val();
		var umuribu= $("#umuribu").val();
		var provinsi= $("#provinsi").val();
		var kabupaten= $("#kabupaten").val();
		var kecamatan= $("#kecamatan").val();
		var kelurahan= $("#kelurahan").val();
		var kota= $("#kota").val();
		var jalan= $("#jalan").val();
		var kelahiranke= $("#kelahiranke").val();		
		var pekerjaanbapak= $("#pekerjaanbapak").val();
		var petugas= $("#petugas").val();		
		/*if(norm.length==0){
			alert('Maaf, Nomor Rekam Medis Tidak Boleh Kosong');
			$("#norm").focus();
			return false();
		}*/
		if(nomor1.length==0){
			alert('Maaf, Kolom Nomor Harus Di Isi Semua');
			$("#nomor1").focus();
			return false();
		}
		if(nomor2.length==0){
			alert('Maaf, Kolom Nomor Harus Di Isi Semua');
			$("#nomor2").focus();
			return false();
		}
		if(nomor3.length==0){
			alert('Maaf, Kolom Nomor Harus Di Isi Semua');
			$("#nomor3").focus();
			return false();
		}
		if(nomor4.length==0){
			alert('Maaf, Kolom Nomor Harus Di Isi Semua');
			$("#nomor4").focus();
			return false();
		}
		if(nomor5.length==0){
			alert('Maaf, Kolom Nomor Harus Di Isi Semua');
			$("#nomor5").focus();
			return false();
		}
		if(nomor6.length==0){
			alert('Maaf, Kolom Nomor Harus Di Isi Semua');
			$("#nomor6").focus();
			return false();
		}
		if(namakecil.length==0){
			alert('Maaf, Nama Kecil Tidak Boleh Kosong');
			$("#nomor1").focus();
			return false();
		}
		if(jk.length==0){
			alert('Maaf, Jenis Kelamin Tidak Boleh Kosong');
			$("#jk").focus();
			return false();
		}
		if(hari==''){
			alert('Maaf, Hari di lahirkan belum di pilih');
			$("#hari").focus();
			return false();
		}
		if(tanggallahir.length==0){
			alert('Maaf, Tanggal tidak boleh kosong');
			$("#tanggallahir").focus();
			return false();
		}
		if(tanggaldaftar.length==0){
			alert('Maaf, Tanggal tidak boleh kosong');
			$("#tanggaldaftar").focus();
			return false();
		}
		if(statuslahir==''){
			alert('Maaf, Status Lahir Belum di pilih');
			$("#statuslahir").focus();
			return false();
		}
		if(warganegara==''){
			alert('Maaf, Warganegara Belum di pilih');
			$("#warganegara").focus();
			return false();
		}
		if(namabapak.length==0){
			alert('Maaf, Nama Bapak boleh kosong');
			$("#namabapak").focus();
			return false();
		}
		if(namaibu.length==0){
			alert('Maaf, Nama Ibu boleh kosong');
			$("#namaibu").focus();
			return false();
		}
		if(provinsi.length==0){
			alert('Maaf, Provinsi boleh kosong');
			$("#provinsi").focus();
			return false();
		}
		if(kabupaten.length==0){
			alert('Maaf, Kabupaten boleh kosong');
			$("#kabupaten").focus();
			return false();
		}	
		if(kecamatan.length==0){
			alert('Maaf, Kecamatan boleh kosong');
			$("#kecamatan").focus();
			return false();
		}
		if(kelurahan.length==0){
			alert('Maaf, Kelurahan boleh kosong');
			$("#kelurahan").focus();
			return false();
		}
		if(kelahiranke==''){
			alert('Maaf, Kelahiran ke berapa belum di pilih');
			$("#kelahiranke").focus();
			return false();
		}
		if(petugas.length==0){
			alert('Maaf, Petugas boleh kosong');
			$("#petugas").focus();
			return false();
		}
		$.ajax({
			type	: "POST",
			url		: "modul/surat_kelahiran/simpan.php",
			data	:"id="+id+
					"&cari="+cari+
					"&nomor1="+nomor1+
					"&nomor2="+nomor2+
					"&nomor3="+nomor3+
					"&nomor4="+nomor4+
					"&nomor5="+nomor5+
					"&nomor6="+nomor6+
					"&norm="+norm+
					"&namakecil="+namakecil+
					"&namadewasa="+namadewasa+
					"&jk="+jk+					
					"&hari="+hari+
					"&jam="+jam+
					"&tanggallahir="+tanggallahir+
					"&tanggaldaftar="+tanggaldaftar+	
					"&statuslahir="+statuslahir+
					"&warganegara="+warganegara+
					"&namabapak="+namabapak+
					"&umurbapak="+umurbapak+
					"&namaibu="+namaibu+
					"&umuribu="+umuribu+
					"&provinsi="+provinsi+
					"&kabupaten="+kabupaten+
					"&kecamatan="+kecamatan+
					"&kelurahan="+kelurahan+
					"&kota="+kota+
					"&jalan="+jalan+
					"&kelahiranke="+kelahiranke+				
					"&pekerjaanbapak="+pekerjaanbapak+					
					"&petugas="+petugas,					
			success	: function(data){				
				$("#tampil_data").load('modul/surat_kelahiran/tampil_data.php');				 				 
				$("#form_input").dialog("close"); 
			}
		});
	}
	$("#txt_cari").keyup(function(){
		var cari = $("#txt_cari").val();				
		var cek = "text";		
		cariData(cari,cek);
	});
	$("#cari").click(function(){
		var cari = $("#txt_cari").val();		
		var cek = "tombol";		
		cariData(cari,cek);
	});		
	function cariData(e,f){
		var cari = e;
		var cek = f;		
		$.ajax({
			type	: "GET",
			url		: "modul/surat_kelahiran/tampil_data.php",
			data	: "cari="+cari+"&cek="+cek,
			success	: function(data){				
				$("#tampil_data").html(data);
			}
		});
	}	
	// fungsi kursor pindah ke baris selanjutnya
	function enter(e){ 		
		var charCode=(event.which)?event.which:event.keyCode
		if(charCode==13){
			$(e).focus();
			$(e).select();						
		}
	}
	
});