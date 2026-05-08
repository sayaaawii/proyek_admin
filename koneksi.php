<?php
$host = "sql107.infinityfree.com";
$user = "if0_41860864";
$pass = "acrmFJuQXJF";
$db   = "if0_41860864_db_administrasi";

$base_url = "//daftartugas.infinityfree.me/";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>