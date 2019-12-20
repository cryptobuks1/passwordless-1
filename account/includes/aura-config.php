<?php

$servername = "SERVER NAME";
$dBusername = "DATABASE USERNAME";
$dBpassword = "DATABASE PASSWORD";
$dBname = "DATABASE NAME";

### DO NOT EDIT ###
$conn = mysqli_connect($servername, $dBusername, $dBpassword, $dBname);

if (!$conn) {
    die("Connection has failed. Error: database could not connect.".mysqli_connect_error());
}
