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


$sql = mysqli_query($koneksi,"SELECT * FROM account");



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


    <div class="col-md-9 offset-md-3 col-lg-10 offset-lg-2 p-0">
      <!-- HEADER -->
      <div class="bg-primary text-white text-center fw-bold py-3 fs-5">
        Selamat Datang Administrator
      </div>

     
      <div class="p-4">
        <h4 class="mb-3">Data Admin</h4>

        <div class="bg-light p-4 rounded-3 shadow-sm">
          <table class="table table-striped mb-0">
            <thead class="table-primary">
              <tr>
                <th>#</th>
                <th>Nip</th>
                <th>Username</th>
                <th>Email</th>
                <th>Waktu Daftar</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (mysqli_num_rows($sql) > 0) {
                $i = 1;
                while ($data = mysqli_fetch_assoc($sql)) :
              ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $data["nip"]; ?></td>
                    <td><?= $data["username"]; ?></td>
                    <td><?= $data["email"]; ?></td>
                    <td><?= $data["created_at"]; ?></td>
                    <td>
                      <a href="update_admin.php?id=<?= $data['id_user']; ?>" class="btn btn-warning btn-sm">Edit</a>
                      <a href="hapus_admin.php?id=<?= $data['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?');">Hapus</a>
                    </td>
                  </tr>
              <?php
                endwhile;
              } else {
                echo '<tr><td colspan="5" class="text-center">Belum ada data siswa (╥﹏╥)</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>