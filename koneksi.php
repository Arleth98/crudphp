<?php 
$host       = "localhost";
$username   = "root";
$pass       = ""; // password kosong
$database   = "dbmhs"; // nama db localhost
$koneksi = mysqli_connect($host, $username, $pass, $database);
if(!$koneksi){
    echo "DB TIDAK TERHUBUNG";
}
?>
