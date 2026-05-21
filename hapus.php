<?php
include 'koneksi.php';

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM daftar_tugas WHERE id = '$id'");

// KUNCI SUKSES: Potong URL jadi murni dulu, baru munculkan alert!
echo "<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, '/');
    }
    alert('Data Berhasil Dihapus!'); 
    window.location='index.php';
</script>";
?>