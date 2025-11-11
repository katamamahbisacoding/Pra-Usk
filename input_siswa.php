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

if (isset($_POST['kirim'])) { 
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $gender = $_POST['gender'];
    $created_at = date('Y-m-d H:i:s');

$cekdp = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nama='$nama' AND kelas='$kelas'");

    if (mysqli_num_rows($cekdp) > 0) {
        echo "<script>alert('Data siswa sudah ada! Tidak boleh duplikat.'); window.location='input_siswa.php';</script>";
        exit;
    }


    
    $sql = "INSERT INTO siswa (nama,kelas, gender, created_at) 
            VALUES ('$nama', '$kelas', '$gender', '$created_at')";
    
    $insert = mysqli_query($koneksi, $sql);

    if ($insert) {
        echo "<script>alert('Input Siswa Berhasil'); window.location='input_siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal Mengimput: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Siswa</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins' }

        .input-grey { background: #e3e3e3 !important; border: none !important; }
        .btn-green { background:#2e9e4f !important; border:none !important; }
        .btn-grey { background:#7f7f7f !important; border:none !important; }

        .sidebar { width:250px; background:#003366; height:100vh; position:fixed; color:white; padding-top:40px; }
        .sidebar a { color:white; text-decoration:none; padding:10px 30px; display:block; }
        .sidebar a:hover { background:#004b8d; }

        .logout-btn { background:#ff2d2d; border:none; width:80%; padding:10px; color:white; border-radius:6px; }
    </style>
</head>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

  <style>
    body { font-family: 'Poppins', sans-serif; background-color: #ffffff; }
    .sidebar {
      background-color: #003366;
      min-height: 100vh;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
      border-radius: 5px;
    }
    .sidebar a:hover {
      background-color: #004b8d;
    }
    .logout-btn {
      background-color: #ff2d2d;
      border: none;
      color: white;
      width: 80%;
      border-radius: 6px;
      padding: 10px 0;
      margin-top: auto;
    }
  </style>
</head>

<body>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-3 col-lg-2 d-flex flex-column align-items-center sidebar text-white py-4 position-fixed">
      <img src="1.png" alt="Logo" class="rounded-circle mb-3" style="width:90px; height:90px;">
      <h5 class="fw-bold mb-4">SMKN 12 JAKARTA</h5>

      <div class="w-100 text-center">
        <a href="dashboard.php">Absen</a>
        <a href="#">Admin</a>
        <a href="input_siswa.php">Input Siswa</a>
      </div>

      <a href="logout.php" class="logout-btn mt-auto mb-3">Log Out</a>
    </div>

    <!-- KONTEN -->
    <div class="col-md-9 offset-md-3 col-lg-10 offset-lg-2 p-0">
      <!-- HEADER -->
      <div class="bg-primary text-white text-center fw-bold py-3 fs-5">
        Selamat Datang Administrator
      </div>

    <!-- ISI HALAMAN -->
    <div class="container mt-4">
      <div class="bg-white p-5 rounded shadow-sm">

        <h4 class="fw-semibold mb-4">Form Input Data Siswa</h4>

        <form method="POST" action="">
          <div class="row mb-4">
            <label class="col-sm-3 col-form-label fw-semibold">Nama Siswa</label>
            <div class="col-sm-6">
              <input type="text" name="nama" class="form-control bg-light border-0" required>
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-3 col-form-label fw-semibold">Kelas</label>
            <div class="col-sm-6">
              <select name="kelas" class="form-select bg-light border-0" required>
                <option value="" disabled selected>Pilih Kelas</option>
                <option value="XI AK">XI AK</option>
                <option value="XI AP">XI AP</option>
                <option value="XI TKJ">XI TKJ</option>
                <option value="XI RPL">XI RPL</option>
              </select>
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-sm-3 col-form-label fw-semibold">Jenis Kelamin</label>
            <div class="col-sm-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="Laki-Laki">
                <label class="form-check-label">Laki-Laki</label>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" value="Perempuan">
                <label class="form-check-label">Perempuan</label>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12 d-flex align-items-center">
              <button type="submit" name="kirim" class="btn btn-success px-4 me-3">Simpan</button>
              <button type="reset" class="btn btn-secondary px-4 me-3">Batal</button>
              <a href="lihat_data_siswa.php" class="text-dark fw-medium">Lihat Data Siswa</a>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>

</body>
</html>
