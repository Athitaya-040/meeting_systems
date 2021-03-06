

<?php 
session_start();
$host ='localhost';
$user ='root';
$pass ='';
$dbname = 'DB_meeting';
$conn = mysqli_connect($host,$user,$pass,$dbname);
mysqli_query($conn," SET NAME UTF8");
date_default_timezone_set("Asia/Bangkok");
 ?>