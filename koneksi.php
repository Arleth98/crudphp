<?php 
$host       = "localhost";
$username   = "root";
$pass       = "";
$database   = "dbmhs";
$koneksi = mysqli_connect($host, $username, $pass, $database);
if(!$koneksi){
    echo "DB TIDAK TERHUBUNG";
}
?>