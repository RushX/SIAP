<?php 
session_start();

include("../php/connection.php");
include("../php/functions.php");

try{
	$user_data = check_login($con);

$connect = mysqli_connect("localhost","root","","aps");
$sql = "SELECT * FROM ucode";  
$result = mysqli_query($connect, $sql);
$Gen="1234567890";
$uid1=substr(str_shuffle($Gen),0,5);
$uid2=substr(str_shuffle($Gen),0,5);
$uid3=substr(str_shuffle($Gen),0,5);
$uid4=substr(str_shuffle($Gen),0,5);
$uid5=substr(str_shuffle($Gen),0,5);

$sql="UPDATE ucode SET unique_code='$uid1' WHERE sub_code=1";
mysqli_query($connect,$sql);
$sql="UPDATE ucode SET unique_code='$uid2' WHERE sub_code=2";
mysqli_query($connect,$sql);
$sql="UPDATE ucode SET unique_code='$uid3' WHERE sub_code=3";
mysqli_query($connect,$sql);
$sql="UPDATE ucode SET unique_code='$uid4' WHERE sub_code=4";
mysqli_query($connect,$sql);
$sql="UPDATE ucode SET unique_code='$uid5' WHERE sub_code=5";
mysqli_query($connect,$sql);
header("HTTP/1.1 200 Updated Successfully");
}catch(Exception){
	header("HTTP/1.1 400 Server Error");
}
?>