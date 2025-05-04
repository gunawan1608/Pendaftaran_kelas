<?php
// Memulai session jika belum ada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Fungsi untuk membersihkan input user
 */
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Fungsi untuk memvalidasi email
 */
function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Fungsi untuk menyimpan data pendaftar ke database
 */
function save_pendaftar($conn, $nama, $email, $kelas) {
    // Bersihkan input
    $nama = sanitize_input($nama);
    $email = sanitize_input($email);
    $kelas = sanitize_input($kelas);
    
    // Validasi input
    if (empty($nama) || empty($email) || empty($kelas)) {
        return [
            'status' => false,
            'message' => 'Semua field harus diisi'
        ];
    }
    
    if (!is_valid_email($email)) {
        return [
            'status' => false,
            'message' => 'Format email tidak valid'
        ];
    }
    
    // Siapkan query
    $query = "INSERT INTO pendaftar (nama, email, kelas, tanggal_daftar) 
                VALUES (?, ?, ?, NOW())";
    
    // Persiapkan statement
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "sss", $nama, $email, $kelas);
        
        // Eksekusi query
        $execute_result = mysqli_stmt_execute($stmt);
        
        // Tutup statement
        mysqli_stmt_close($stmt);
        
        if ($execute_result) {
            return [
                'status' => true,
                'message' => 'Pendaftaran berhasil'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Gagal menyimpan data: ' . mysqli_error($conn)
            ];
        }
    } else {
        return [
            'status' => false,
            'message' => 'Error dalam menyiapkan query: ' . mysqli_error($conn)
        ];
    }
}

/**
 * Fungsi untuk mengambil semua data pendaftar
 */
function get_all_pendaftar($conn) {
    $pendaftars = [];
    
    $query = "SELECT * FROM pendaftar ORDER BY tanggal_daftar DESC";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pendaftars[] = $row;
        }
        mysqli_free_result($result);
    }
    
    return $pendaftars;
}

/**
 * Fungsi untuk mendapatkan daftar kelas
 */
function get_daftar_kelas() {
    return [
        'web_development' => 'Web Development',
        'mobile_development' => 'Mobile App Development',
        'data_science' => 'Data Science & Machine Learning',
        'ui_ux' => 'UI/UX Design',
        'digital_marketing' => 'Digital Marketing'
    ];
}
?>