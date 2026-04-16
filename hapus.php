<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM daftar_tugas WHERE id = '$id'");
echo "<script>alert('Data Berhasil Dihapus!'); window.location='index.php';</script>";
?>