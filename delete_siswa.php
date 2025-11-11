<?php
include 'koneksi.php';
session_start();
if ($_SESSION['username']==NULL) {
    echo "<script>
            alert('Silakan login terlebih dahulu.');
            window.location.href = 'index.php';
          </script>";
    exit();
}

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "DELETE FROM siswa WHERE id_siswa = '$id'";
    $hapus = mysqli_query($koneksi, $query);
}
 header("Location: lihat_data_siswa.php");


?>