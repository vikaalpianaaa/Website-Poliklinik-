<?php
// Koneksi ke database (Sesuaikan dengan koneksi Anda)
$conn = mysqli_connect('localhost', 'root', '', 'poli_bk');

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Ambil data dari form registrasi
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_ktp = $_POST['no_ktp'];
$no_hp = $_POST['no_hp'];

$query = "INSERT INTO pasien (nama, alamat, no_ktp, no_hp) VALUES ('$nama', '$alamat', '$no_ktp', '$no_hp')";
$result = mysqli_query($conn, $query);

if ($result) {
    // Registrasi sukses
    $response = [
        'success' => true,
        'message' => 'Registrasi Pasien Berhasil! Pasien berhasil terdaftar.'
    ];
} else {
    // Registrasi gagal
    $response = [
        'success' => false,
        'message' => 'Registrasi Pasien Gagal. Terjadi kesalahan. Silakan coba lagi.'
    ];
}

mysqli_close($conn);

// Mengirim response dalam bentuk JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
