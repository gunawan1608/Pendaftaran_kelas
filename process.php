<?php
// Memulai session
session_start();

// Memanggil file koneksi dan fungsi
require_once 'includes/db_connection.php';
require_once 'includes/functions.php';

// Cek apakah form disubmit dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
    
    // Simpan data ke database
    $result = save_pendaftar($conn, $nama, $email, $kelas);
    
    // Set session message
    if ($result['status']) {
        $_SESSION['message'] = "Pendaftaran berhasil! Terima kasih, {$nama}. Kami akan mengirimkan info lebih lanjut ke email Anda.";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Pendaftaran gagal: " . $result['message'];
        $_SESSION['message_type'] = 'error';
    }
    
    // Redirect ke halaman utama
    header("Location: index.php");
    exit;
} else {
    // Jika bukan POST, redirect ke halaman utama
    header("Location: index.php");
    exit;
}
?>