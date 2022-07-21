<?php
ob_start();
//KONFIGURASI
$hostDB = "localhost";
$usernameDB = "root";
$passwordDB = "";
$namaDB = "u1036689_abo";
date_default_timezone_set('Asia/Jakarta');

//KONEKSI KE DATABASE
$con = mysqli_connect($hostDB,$usernameDB,$passwordDB,$namaDB);

//CEK KONEKSI
if (mysqli_connect_errno())
{
	echo "KONEKSI GAGAL";
	die;
}

//AMBIL DATABASE 
include("models/database.php");

//MEMANGGIL DATABASE
$database = new database;

// $hash = new PassHash;

//AMBIL CONTROLLER
include("controllers/routing.php");

ob_end_flush();
?>