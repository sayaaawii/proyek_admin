<?php 
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit;
}
include 'koneksi.php'; 

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM daftar_tugas WHERE id='$id'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=2.1">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-11 col-md-5">
            <div class="card shadow card-kalem">
                <div class="header-kalem text-center">
                    <h5 class="mb-0">Edit Data Tugas</h5>
                </div>
                <div class="card-body p-4">
                    <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" value="<?php echo $data['nama_siswa']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mata Pelajaran</label>
                            <input type="text" name="mata_pelajaran" class="form-control" value="<?php echo $data['judul_tugas']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Kesulitan</label>
                            <select name="kesulitan" class="form-select">
                                <option value="Mudah" <?php if($data['kesulitan'] == 'Mudah') echo 'selected'; ?>>Mudah</option>
                                <option value="Sedang" <?php if($data['kesulitan'] == 'Sedang') echo 'selected'; ?>>Sedang</option>
                                <option value="Sulit" <?php if($data['kesulitan'] == 'Sulit') echo 'selected'; ?>>Sulit</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="<?php echo $data['deadline']; ?>" required>
                            <small class="text-muted">Format: Bln/Tgl/Thn</small>
                        </div>
                        
                        <button type="submit" name="update" class="btn btn-warning w-100 fw-bold py-2">UPDATE DATA</button>
                        <a href="index.php" class="btn btn-light w-100 mt-2 border">Batal</a>
                    </form>

                    <?php
                    if (isset($_POST['update'])) {
                        $nama = mysqli_real_escape_string($koneksi, $_POST['nama_siswa']);
                        $mapel = mysqli_real_escape_string($koneksi, $_POST['mata_pelajaran']);
                        $kesulitan = $_POST['kesulitan'];
                        $deadline = $_POST['deadline'];

                        // Query update
                        $update = mysqli_query($koneksi, "UPDATE daftar_tugas SET 
                            nama_siswa='$nama', 
                            judul_tugas='$mapel', 
                            kesulitan='$kesulitan', 
                            deadline='$deadline' 
                            WHERE id='$id'");

                        if ($update) {
                            // KUNCI 2: Bersihkan URL murni dulu ke '/', baru gembok layar pakai Alert sukses!
                            echo "<script>
                                if (window.history.replaceState) {
                                    window.history.replaceState(null, null, '/');
                                }
                                alert('Data Berhasil Diperbarui!'); window.location='index.php';
                            </script>";
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Gagal Update: ".mysqli_error($koneksi)."</div>";
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