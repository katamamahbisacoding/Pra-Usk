<?php 
include 'koneksi.php';
session_start();
    if(isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

    $query = "SELECT * FROM account WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            echo "<script>alert('Login Berhasil'); window.location='dashboard.php';</script>";
        } else {
            echo "<script>alert('Password Salah'); window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Username Tidak Ditemukan'); window.location='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>


  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background-color: #f5f6fa;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      width: 100%;
      max-width: 420px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      padding: 40px 30px;
    }

    .login-card h3 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #333;
    }

    .form-control {
      border-radius: 8px;
      padding: 10px 14px;
      font-size: 15px;
    }

    .btn-success {
      background-color: #28a745;
      border: none;
      border-radius: 8px;
      padding: 10px 0;
      font-weight: 500;
      font-size: 16px;
      transition: 0.3s;
    }

    .btn-success:hover {
      background-color: #218838;
    }

    label {
      font-weight: 500;
    }
  </style>
</head>
<body>

  <!-- FORM LOGIN -->
  <div class="login-card">
    <h3>Login</h3>
    <form action="" method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Nama</label>
        <input type="text" class="form-control" id="username" name="username" required />
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required />
      </div>

      <div class="d-grid gap-2 mt-4">
        <button type="submit" class="btn btn-success">Kirim</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
