<?php
// Konfigurasi database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "pendaftaran_kelas";

// Membuat koneksi
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Set charset untuk koneksi
mysqli_set_charset($conn, "utf8");
?>