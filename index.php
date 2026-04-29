<?php 
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit;
}
include 'koneksi.php'; 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base_url; ?> ?>style.css">
</head>
<body>

<div class="container">
    <div class="card card-kalem mb-4 overflow-hidden">
        <div class="header-kalem d-flex justify-content-between align-items-center px-4">
            <h4 class="mb-0">Daftar Tugas Siswa</h4>
            <div>
                <a href="tambah.php" class="btn btn-light btn-sm fw-bold">+ Tambah</a>
                <a href="logout.php" class="btn btn-danger btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </div>

    <div class="task-grid">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM daftar_tugas ORDER BY id DESC");
        while($data = mysqli_fetch_array($query)) {
            $warna = ($data['kesulitan'] == 'Sulit') ? 'border-sulit' : (($data['kesulitan'] == 'Sedang') ? 'border-sedang' : 'border-mudah');
        ?>
        <div class="task-card <?php echo $warna; ?>">
            <div class="d-flex justify-content-between">
                <h5 class="student-name"><?php echo $data['nama_siswa']; ?></h5>
                <span class="badge <?php echo $data['status'] == 'Done' ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo $data['status']; ?>
                </span>
            </div>
            <p class="task-title"><?php echo $data['judul_tugas']; ?></p>
            <div class="small text-muted mb-3">Deadline: <b><?php echo $data['deadline']; ?></b></div>
            
            <div class="d-flex justify-content-between align-items-center border-top pt-3">
                <span class="small fw-bold text-muted"><?php echo $data['kesulitan']; ?></span>
                <div class="btn-group">
                    <?php if($data['status'] == 'Pending') : ?>
                        <a href="selesai.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-outline-success fw-bold">Selesai</a>
                    <?php endif; ?>

                    <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning fw-bold">Edit</a>
                    <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger fw-bold" onclick="return confirm('Hapus?')">Hapus</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>