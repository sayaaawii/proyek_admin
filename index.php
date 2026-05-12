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
    <title>Dashboard Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=2.1">
</head>
<body>

<div class="container">
    <div class="card card-kalem mb-4 overflow-hidden">
        <div class="header-kalem d-flex justify-content-between align-items-center px-3 px-md-4">
            <h4 class="mb-0 judul-header text-white">Daftar Tugas Siswa</h4>
            <div class="d-flex gap-1 gap-md-2">
                <a href="tambah.php" class="btn btn-light btn-sm fw-bold">+ Tambah</a>
                <a href="logout.php" class="btn btn-danger btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <form action="" method="GET" class="d-flex gap-2">
                <input type="text" name="cari" class="form-control" placeholder="Cari nama siswa atau mapel..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                <button type="submit" class="btn btn-primary fw-bold text-white">Cari</button>
                <?php if(isset($_GET['cari'])): ?>
                    <a href="index.php" class="btn btn-secondary fw-bold">Reset</a>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="task-grid">
        <?php
        if(isset($_GET['cari'])){
            $cari = mysqli_real_escape_string($koneksi, $_GET['cari']);
            $query = mysqli_query($koneksi, "SELECT * FROM daftar_tugas WHERE nama_siswa LIKE '%$cari%' OR judul_tugas LIKE '%$cari%' ORDER BY id DESC");
        } else {
            $query = mysqli_query($koneksi, "SELECT * FROM daftar_tugas ORDER BY id DESC");
        }

        if(mysqli_num_rows($query) == 0){
            echo "<div class='alert alert-light w-100 text-center shadow-sm'>Data tidak ditemukan.</div>";
        }

        while($data = mysqli_fetch_array($query)) {
            $warna = ($data['kesulitan'] == 'Sulit') ? 'border-sulit' : (($data['kesulitan'] == 'Sedang') ? 'border-sedang' : 'border-mudah');
        ?>
        <div class="task-card <?php echo $warna; ?>">
            <div class="d-flex justify-content-between align-items-start">
                <h5 class="student-name" style="color: #338191; margin-bottom: 0;"><?php echo $data['nama_siswa']; ?></h5>
                <span class="badge <?php echo $data['status'] == 'Done' ? 'bg-success' : 'bg-secondary'; ?>">
                    <?php echo $data['status']; ?>
                </span>
            </div>
            
            <p class="mb-2" style="font-style: italic; font-weight: 400; color: #6c757d;">
                <?php echo $data['judul_tugas']; ?>
            </p>

            <div class="small text-muted mb-3">Deadline: <b><?php echo $data['deadline']; ?></b></div>
            
            <div class="d-flex justify-content-between align-items-center border-top pt-3">
    			<span class="badge bg-info text-dark"><?php echo $data['kesulitan']; ?></span>
    				<div class="btn-group gap-1">
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