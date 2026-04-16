<?php 
session_start();
include 'koneksi.php'; 

// 1. Ambil data di paling atas supaya variabel $data terisi
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM daftar_tugas WHERE id = '$id'");
$data = mysqli_fetch_array($query);

// 2. Jika data tidak ada, balik ke index
if (!$data) {
    header("location:index.php");
    exit;
}

// 3. Proses Update
if (isset($_POST['update'])) {
    $nama = $_POST['nama_siswa'];
    $judul = $_POST['judul_tugas'];
    $kesulitan = $_POST['kesulitan'];
    $deadline = $_POST['deadline'];
    
    mysqli_query($koneksi, "UPDATE daftar_tugas SET nama_siswa='$nama', judul_tugas='$judul', kesulitan='$kesulitan', deadline='$deadline' WHERE id='$id'");
    echo "<script>alert('Berhasil Update!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card card-kalem overflow-hidden">
                <div class="header-kalem">
                    <h5 class="mb-0">Edit Data Tugas</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="nama_siswa" class="form-control" value="<?php echo $data['nama_siswa']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Judul Tugas</label>
                            <input type="text" name="judul_tugas" class="form-control" value="<?php echo $data['judul_tugas']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kesulitan</label>
                            <select name="kesulitan" class="form-select">
                                <option value="Mudah" <?php echo ($data['kesulitan']=='Mudah')?'selected':''; ?>>Mudah</option>
                                <option value="Sedang" <?php echo ($data['kesulitan']=='Sedang')?'selected':''; ?>>Sedang</option>
                                <option value="Sulit" <?php echo ($data['kesulitan']=='Sulit')?'selected':''; ?>>Sulit</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" value="<?php echo $data['deadline']; ?>">
                        </div>
                        <button type="submit" name="update" class="btn btn-warning w-100 fw-bold py-2">UPDATE DATA</button>
                        <a href="index.php" class="btn btn-light w-100 mt-2">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>