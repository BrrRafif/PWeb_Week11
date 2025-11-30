<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server = "localhost";
$user = "root";
$password = "";
$nama_database = "laundrycrafty";

$conn = mysqli_connect($server, $user, $password, $nama_database);

if( !$conn ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}