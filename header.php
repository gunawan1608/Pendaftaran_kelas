<?php
// Memulai session jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Kelas Online</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Pendaftaran Kelas Online</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Form Pendaftaran</a></li>
                    <li><a href="list_pendaftar.php">Daftar Pendaftar</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert <?php echo $_SESSION['message_type']; ?>">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                        unset($_SESSION['message_type']);
                    ?>
                </div>
            <?php endif; ?>