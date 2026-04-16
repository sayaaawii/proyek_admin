<?php 
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
    exit;
}
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white"><h5>Tambah Tugas Baru</h5></div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul Tugas</label>
                            <input type="text" name="judul_tugas" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tingkat Kesulitan</label>
                            <select name="kesulitan" class="form-select">
                                <option value="Mudah">Mudah</option>
                                <option value="Sedang" selected>Sedang</option>
                                <option value="Sulit">Sulit</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-success w-100 fw-bold">Simpan Data</button>
                        <a href="index.php" class="btn btn-light w-100 mt-2">Kembali</a>
                    </form>
                    <?php
                    if (isset($_POST['submit'])) {
                        $nama = $_POST['nama_siswa'];
                        $judul = $_POST['judul_tugas'];
                        $kesulitan = $_POST['kesulitan'];
                        $deadline = $_POST['deadline'];
                        $query = mysqli_query($koneksi, "INSERT INTO daftar_tugas (nama_siswa, judul_tugas, kesulitan, deadline) VALUES ('$nama', '$judul', '$kesulitan', '$deadline')");
                        if ($query) {
                        echo "<script>alert('Berhasil Tambah!'); window.location='index.php';</script>";
                    } else {
                        // KODE INI AKAN MEMBERITAHU KITA KENAPA GAGAL
                        echo "<h4>Gagal Simpan Data!</h4>";
                        echo "Pesan Error: " . mysqli_error($koneksi);
                        echo "<br>Pastikan tabel 'daftar_tugas' dan kolom-kolomnya sudah ada di phpMyAdmin.";
                    }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>