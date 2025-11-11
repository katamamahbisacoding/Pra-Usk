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

$kelas = [];
$queryKelas = mysqli_query($koneksi, "SELECT DISTINCT kelas FROM siswa ORDER BY kelas ASC");
while ($row = mysqli_fetch_assoc($queryKelas)) {
    $kelas[] = $row['kelas'];
}


$kelasTerpilih = $_POST['kelas'] ?? $_GET['kelas'] ?? ($kelas[0] ?? '');
$tanggal = $_POST['tanggal'] ?? $_GET['tanggal'] ?? date('Y-m-d');


$querySiswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE kelas='$kelasTerpilih' ORDER BY nama ASC");


$queryAbsen = mysqli_query($koneksi, "SELECT * FROM kehadiran WHERE tanggal='$tanggal'");
$absenHariIni = [];
while ($a = mysqli_fetch_assoc($queryAbsen)) {
    $absenHariIni[$a['id_siswa']] = $a;
}


if (isset($_POST['simpan_absen'])) {
    foreach ($_POST['absensi'] as $id_siswa => $data) {
        $kehadiran = $data['kehadiran'];


        $cek = mysqli_query($koneksi, "SELECT * FROM kehadiran WHERE id_siswa='$id_siswa' AND tanggal='$tanggal'");
        if (mysqli_num_rows($cek) > 0) {
            
            mysqli_query($koneksi, "UPDATE kehadiran SET kehadiran='$kehadiran' WHERE id_siswa='$id_siswa' AND tanggal='$tanggal'");
        } else {
            
            mysqli_query($koneksi, "INSERT INTO kehadiran (id_siswa, tanggal, kehadiran) VALUES ('$id_siswa', '$tanggal', '$kehadiran')");
        }
    }

   
    echo "<script>
        alert('Absensi berhasil disimpan!');
        window.location='dashboard.php?kelas=$kelasTerpilih&tanggal=$tanggal';
    </script>";
    exit;
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
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
    }

   
    .sidebar {
      width: 250px;
      background: #003366;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      color: white;
      padding-top: 40px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      padding: 10px 30px;
      display: block;
    }

    .sidebar a:hover {
      background: #004b8d;
    }

    .logout-btn {
      background: #ff2d2d;
      border: none;
      width: 80%;
      padding: 10px;
      color: white;
      border-radius: 6px;
    }

    
    .main-content {
      margin-left: 250px;
      min-height: 100vh;
      background-color: #f8f9fa;
    }

    
    .navbar-top {
      background-color: #0d6efd;
      color: white;
      text-align: center;
      padding: 15px;
      font-weight: 600;
      font-size: 18px;
    }
  </style>

<body>

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-3 col-lg-2 d-flex flex-column align-items-center sidebar text-white py-4 position-fixed">
      <img src="1.png" alt="Logo" class="rounded-circle mb-3" style="width:90px; height:90px;">
      <h5 class="fw-bold mb-4">SMKN 12 JAKARTA</h5>

      <div class="w-100 text-center">
        <a href="dashboard.php">Absen</a>
        <a href="admin.php">Admin</a>
        <a href="input_siswa.php">Input Siswa</a>
      </div>

      <a href="logout.php" class="logout-btn mt-auto mb-3">Log Out</a>
    </div>
    
      </nav>

      
      <main class="col-md-9 col-lg-10 ms-sm-auto p-4">
        <div class="d-flex justify-content-between align-items-end mb-3">
          <div>
            <form action="" method="POST" class="d-flex align-items-center gap-2">
              <select name="kelas" class="form-select" required>
                <?php foreach ($kelas as $k): ?>
                  <option value="<?= $k ?>" <?= $k == $kelasTerpilih ? 'selected' : '' ?>><?= $k ?></option>
                <?php endforeach; ?>
              </select>
              <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?>" required>
              <button type="submit" class="btn btn-primary">Pilih</button>
            </form>
          </div>
        </div>

        <form method="POST">
          <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
          <input type="hidden" name="kelas" value="<?= $kelasTerpilih ?>">

          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Kehadiran</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              while ($siswa = mysqli_fetch_assoc($querySiswa)) {
                  $absen = $absenHariIni[$siswa['id_siswa']] ?? null;
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($siswa['nama']) ?></td>
                <td><?= htmlspecialchars($siswa['kelas']) ?></td>
                <td>
                  <select name="absensi[<?= $siswa['id_siswa'] ?>][kehadiran]" class="form-select" required>
                    <option value="Hadir" <?= ($absen && $absen['kehadiran'] == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
                    <option value="Terlambat" <?= ($absen && $absen['kehadiran'] == 'Terlambat') ? 'selected' : '' ?>>Terlambat</option>
                    <option value="Sakit" <?= ($absen && $absen['kehadiran'] == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
                    <option value="Izin" <?= ($absen && $absen['kehadiran'] == 'Izin') ? 'selected' : '' ?>>Izin</option>
                    <option value="Alpha" <?= ($absen && $absen['kehadiran'] == 'Alpha') ? 'selected' : '' ?>>Alpha</option>
                  </select>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <button type="submit" name="simpan_absen" class="btn btn-success">Kirim Absen</button>
        </form>
      </main>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
