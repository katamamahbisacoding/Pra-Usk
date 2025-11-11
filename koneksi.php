<?php 
$koneksi = mysqli_connect("localhost","root","","db_usk");
if(!$koneksi){
    echo "Koneksi Gagal".mysqli_connect_error();
}


?>