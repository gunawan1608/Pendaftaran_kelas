<?php
require_once 'includes/db_connection.php';
require_once 'includes/functions.php';
include 'includes/header.php';

$pendaftars = get_all_pendaftar($conn);
$daftar_kelas = get_daftar_kelas();
?>

<section class="pendaftar-container">
    <h2>Daftar Pendaftar Kelas Online</h2>
    
    <?php if (empty($pendaftars)): ?>
        <div class="empty-state">
            <p>Belum ada pendaftar saat ini.</p>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kelas</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pendaftars as $pendaftar): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($pendaftar['nama']); ?></td>
                            <td><?php echo htmlspecialchars($pendaftar['email']); ?></td>
                            <td>
                                <?php 
                                    echo isset($daftar_kelas[$pendaftar['kelas']]) 
                                        ? $daftar_kelas[$pendaftar['kelas']] 
                                        : $pendaftar['kelas']; 
                                ?>
                            </td>
                            <td><?php echo date('d-m-Y H:i', strtotime($pendaftar['tanggal_daftar'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>

<?php include 'includes/footer.php'; ?>