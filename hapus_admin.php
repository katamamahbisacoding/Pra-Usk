<?php
include 'koneksi.php';
session_start();
if ($_SESSION['username']==NULL) {
    echo "<script>
            alert('Silakan login terlebih dahulu.');
            window.location.href = 'login.php';
          </script>";
    exit();
}

if (isset($_GET['id'])){
    $id_user = $_GET['id'];
    $query = "DELETE FROM account WHERE id_user = '$id_user'";
    $hapus = mysqli_query($koneksi, $query);
}
 header("Location: admin.php");


?>