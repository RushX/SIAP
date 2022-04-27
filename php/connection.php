<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "aps";
$sheetid="1ghD0a7HT_ldQ36krDGtC6H2isz1x9lBZ61K4JZ7Y_yY";
$notice=NULL;
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}
