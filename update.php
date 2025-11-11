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

    $id_siswa = $_GET['id'];

    
    $siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa = $id_siswa");
    $data = mysqli_fetch_assoc($siswa);


    if (isset($_POST["submit"])) {
        $nama = $_POST["nama"];
        $kelas = $_POST["kelas"];
        $gender = $_POST["gender"];

   $update = mysqli_query($koneksi, "UPDATE siswa 
    SET nama = '$nama', 
        kelas = '$kelas', 
        gender = '$gender'
    WHERE id_siswa = '$id_siswa'");


        if (mysqli_affected_rows($koneksi) > 0) {
            echo "<script>
                alert('Data berhasil diupdate!');
                document.location.href = 'lihat_data_siswa.php';
            </script>";
        } else {
            echo "<script>alert('Gagal mengupdate data.');</script>";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend+Deca:wght@100..900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins';
        }
        .card {
      border-radius: 1rem;
    }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">

                        <h1 class="h4 card-title text-center mb-4">Update Data Siswa</h1>

                        <form action="" method="post">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="kelas" class="form-label">Kelas</label>
                                <select name="kelas" id="kelas" class="form-select" required>
                                    <option disabled>-- Pilih Kelas --</option>
                                    <option value="XI AK" <?= ($data['kelas'] == 'XI AK') ? 'selected' : ''; ?>>XI AK</option>
                                    <option value="XI AP" <?= ($data['kelas'] == 'XI AP') ? 'selected' : ''; ?>>XI AP</option>
                                    <option value="XI TKJ" <?= ($data['kelas'] == 'XI TKJ') ? 'selected' : ''; ?>>XI TKJ</option>
                                    <option value="XI RPL" <?= ($data['kelas'] == 'XI RPL') ? 'selected' : ''; ?>>XI RPL</option>   
                                </select>

                            <div class="mt-3">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select name="gender" id="gender" class="form-select" required>
                                    <option disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-Laki" <?= ($data['gender'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki Laki</option>
                                    <option value="Perempuan" <?= ($data['gender'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                                </div>

                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" name="submit" class="btn btn-outline-success w-100 mt-2">Update</button>
                            </div>
                            <a href="lihat_data_siswa.php" class="btn btn-outline-secondary w-100 mt-2" role="button">Kembali</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>