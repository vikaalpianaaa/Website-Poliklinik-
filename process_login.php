<?php
session_start();

// Sambungkan ke database
$conn = mysqli_connect('localhost', 'root', '', 'poli_bk');

// Ambil data dari form login
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);

// Query menggunakan prepared statement
$query = "SELECT * FROM user_roles WHERE nama=? AND no_hp=?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "ss", $nama, $no_hp);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['role_id'] = $row['role_id'];
    $_SESSION['nama'] = $row['nama'];


    $role = $row['role_id'];
    $redirect_url = '';
    $welcomeMessage = '';

    switch ($role) {
        case '1':
            $redirect_url = 'dashboard.php';
            $welcomeMessage = 'Selamat datang, Admin ' . ucfirst($row['nama']) . '!';
            break;
        case '2':
            $redirect_url = 'dashboard.php';
            $welcomeMessage = 'Selamat datang, Dokter ' . ucfirst($row['nama']) . '!';
            break;
        case '3':
            $redirect_url = 'dashboard.php';
            $welcomeMessage = 'Selamat datang, Pasien ' . ucfirst($row['nama']) . '!';
            break;
        default:
            $redirect_url = 'default.php'; // URL default jika role tidak ditemukan
            break;
    }

    echo json_encode(['status' => 'success', 'redirect_url' => $redirect_url, 'welcome_message' => $welcomeMessage]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Username atau nomor handphone salah. Silakan coba lagi.']);
}
?>
