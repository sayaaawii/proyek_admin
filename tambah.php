<?php 
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit;
}
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=2.1">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-11 col-md-5">
            <div class="card shadow card-kalem">
                <div class="header-kalem text-center">
                    <h5 class="mb-0">Tambah Tugas Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="tambah.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" placeholder="Nama lengkap siswa..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mata Pelajaran</label>
                            <input type="text" name="mata_pelajaran" class="form-control" placeholder="Contoh: Matematika, Fisika..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tingkat Kesulitan</label>
                            <select name="kesulitan" class="form-select">
                                <option value="Mudah">Mudah</option>
                                <option value="Sedang" selected>Sedang</option>
                                <option value="Sulit">Sulit</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deadline</label>
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100 fw-bold text-white py-2">Simpan Data</button>
                        <a href="index.php" class="btn btn-light w-100 mt-2 border">Kembali</a>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        $nama = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
                        $mapel = mysqli_real_escape_string($koneksi, $_POST['mata_pelajaran']); 
                        $kesulitan = $_POST['kesulitan'];
                        $deadline = $_POST['deadline'];

                        $query = mysqli_query($koneksi, "INSERT INTO daftar_tugas (nama_siswa, judul_tugas, kesulitan, deadline, status) VALUES ('$nama', '$mapel', '$kesulitan', '$deadline', 'Pending')");

                        if ($query) {
                            // KUNCI 2: Bersihkan URL murni dulu ke '/', baru gembok layar pakai Alert!
                            echo "<script>
                                if (window.history.replaceState) {
                                    window.history.replaceState(null, null, '/');
                                }
                                alert('Berhasil Tambah!'); 
                                window.location='index.php';
                            </script>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Gagal: ".mysqli_error($koneksi)."</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
if (window.history.replaceState) {
    window.history.replaceState(null, null, '/');
}
</script>

</body>
</html>