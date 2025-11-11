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

    $id_user = $_GET['id'];

    
    $siswa = mysqli_query($koneksi, "SELECT * FROM account WHERE id_user = $id_user");
    $data = mysqli_fetch_assoc($siswa);


    if (isset($_POST["submit"])) {
        $nip = $_POST["nip"];
        $username = $_POST["username"];
        $email = $_POST["email"];

   $update = mysqli_query($koneksi, "UPDATE account 
    SET nip = '$nip', 
        username = '$username', 
        email = '$email'
    WHERE id_user = '$id_user'");


        if (mysqli_affected_rows($koneksi) > 0) {
            echo "<script>
                alert('Data berhasil diupdate!');
                document.location.href = 'admin.php';
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
    <title>Update Admin</title>
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

                        <h1 class="h4 card-title text-center mb-4">Update Data Admin</h1>

                        <form action="" method="post">

                            <div class="mb-3">
                                <label for="nip" class="form-label">Nip</label>
                                <input type="number" name="nip" id="nip" class="form-control" value="<?= $data['nip']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="<?= $data['username']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="<?= $data['email']; ?>" required>
                            </div>

                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" name="submit" class="btn btn-outline-success w-100 mt-2">Update</button>
                            </div>
                            <a href="admin.php" class="btn btn-outline-secondary w-100 mt-2" role="button">Kembali</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>