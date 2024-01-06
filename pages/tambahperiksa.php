<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id_daftar_poli = $_POST["id_daftar_poli"];
    $tgl_periksa = $_POST["tgl_periksa"];
    $catatan = $_POST["catatan"];
    $biaya_periksa = $_POST["biaya_periksa"];

    // Query untuk menambahkan data obat ke dalam tabel
    $query = "INSERT INTO periksa (id_daftar_poli, tgl_periksa, catatan, biaya_periksa) VALUES ('$id_daftar_poli', '$tgl_periksa', '$catatan', '$biaya_periksa')";
    

    // if ($koneksi->query($query) === TRUE) {
    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        // Jika berhasil, redirect kembali ke halaman utama atau sesuaikan dengan kebutuhan Anda
        // header("Location: ../../dashboard.php");
        // exit();
        echo '<script>';
        echo 'alert("Data Pasien berhasil ditambahkan!");';
        echo 'window.location.href = "../home_periksa.php";';
        echo '</script>';
        exit();
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
    
}

// Tutup koneksi
mysqli_close($mysqli);
?>