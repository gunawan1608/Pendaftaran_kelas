<?php
require_once 'includes/db_connection.php';
require_once 'includes/functions.php';
include 'includes/header.php';

$daftar_kelas = get_daftar_kelas();
?>

<section class="form-container">
    <h2>Form Pendaftaran</h2>
    <p>Silakan isi form di bawah ini untuk mendaftar kelas online.</p>

    <form action="process.php" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="kelas">Pilihan Kelas</label>
            <select id="kelas" name="kelas" required>
                <option value="">-- Pilih Kelas --</option>
                <?php foreach ($daftar_kelas as $key => $kelas): ?>
                    <option value="<?php echo $key; ?>"><?php echo $kelas; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="btn-submit">Daftar Sekarang</button>
        </div>
    </form>
</section>

<?php include 'includes/footer.php'; ?>