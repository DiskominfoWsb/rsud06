<?php

 define('HOST','localhost');
 define('USER','rsud');
 define('PASS','g5Aadrhx');
 define('DB','rsud');

 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect Database');
 if($_SERVER['REQUEST_METHOD']=='POST'){
 //Getting values
 $user = $_POST['user'];
 //$sandi = $_POST['sandi'];
 $sandi=md5($_POST['sandi']); 

 //Creating sql query
 $sql = "SELECT * FROM users WHERE username='$user' AND password='$sandi'";

 //executing query
 $result = mysqli_query($con,$sql);

 //fetching result
 $check = mysqli_fetch_array($result);

 //if we got some result
 if(isset($check)){
 //displaying success
 echo "success";
 }else{
 //displaying failure
 echo "failure";
 }
 mysqli_close($con);
 }
?>
