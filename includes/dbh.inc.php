<?php

$serverName = "localhost";
//$dBUsername = "root";
//$dBPassword = "";
//$dBName = "loginsystem";

//$serverName = "mkwk018.cba.pl";
$dBUsername = "mathemat_bartek";
$dBPassword = "Gjrd73f5";
$dBName = "hiyesbye";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}