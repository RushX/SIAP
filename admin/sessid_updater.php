<?php 
session_start();

include("../php/connection.php");
include("../php/functions.php");
try{
$user_data = check_login($con);
$connect = mysqli_connect("localhost","root","","aps");
$sql = "SELECT * FROM ucode";  
$result = mysqli_query($connect, $sql);

$sessid=$_POST["sess_id"];
$sub_code=$_POST["sub_code"];
$sql="UPDATE ucode SET current_sess='$sessid' WHERE sub_code=$sub_code";
mysqli_query($connect,$sql);
header("HTTP/1.1 200 Updated Successfully");
}catch(Exception){
	header("HTTP/1.1 400 Server Error");
}
?>