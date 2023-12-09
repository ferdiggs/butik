<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "db_butik";

$conn = mysqli_connect($host, $user, $pass) or die("koneksi ke database gagal");
mysqli_select_db($conn, $name) or die("Tidak ada database yang dipilih");


?>