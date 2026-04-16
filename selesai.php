<?php 
include 'koneksi.php';

$id = $_GET['id'];

// Update status di database jadi Done
$query = mysqli_query($koneksi, "UPDATE daftar_tugas SET status='Done' WHERE id='$id'");

if($query) {
    header("location:index.php");
} else {
    echo "Gagal mengupdate status";
}
?>