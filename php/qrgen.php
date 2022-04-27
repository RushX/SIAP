<?php

session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if(isset($_GET["qrval"])!=1){
    header("HTTP/1.1 400 Unique ID Not Found");
    die();
};
$qr=password_hash($_GET["qrval"],PASSWORD_DEFAULT);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR</title>
</head>
<body>
<img src="https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=<?php echo $qr?>&choe=UTF-8" />


</body>

</html>