<?php
session_start();
include 'koneksi.php';

// Jika sudah login, langsung lempar ke index
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:index.php");
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("location:index.php");
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
   	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administrasi Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=2.1"">
    <style>
        /* Tambahan style khusus agar warna tetap kalem */
        .card-header-kalem {
            background: linear-gradient(to right, #338191, #4ca1af); /* Gradasi kalem */
            color: white;
            border-bottom: none;
        }
        .btn-kalem {
            background-color: #338191; /* Biru toska kalem */
            color: white;
            border: none;
        }
        .btn-kalem:hover {
            background-color: #2a6a77;
            color: white;
        }
        .form-label {
            color: #555; /* Warna teks label agar terlihat */
            font-weight: 600;
        }
    </style>
</head>
<body class="d-flex align-items-center" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow border-0" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header-kalem text-center py-3">
                        <h5 class="mb-0 fw-bold">LOGIN ADMIN</h5>
                    </div>
                    <div class="card-body p-4">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger py-2" style="font-size: 14px;"><?= $error; ?></div>
                        <?php endif; ?>
                        
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-kalem w-100 fw-bold py-2">MASUK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>