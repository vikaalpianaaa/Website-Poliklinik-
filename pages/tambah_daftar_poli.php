<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari form
    $id_pasien = mysqli_real_escape_string($mysqli, $_POST["id_pasien"]);
    $id_jadwal = mysqli_real_escape_string($mysqli, $_POST["id_jadwal"]);
    $keluhan = mysqli_real_escape_string($mysqli, $_POST["keluhan"]);
    $no_antrian = mysqli_real_escape_string($mysqli, $_POST["no_antrian"]);

    // Query untuk menambahkan data ke dalam tabel
    $query = "INSERT INTO daftar_poli (id_pasien, id_jadwal, keluhan, no_antrian) VALUES ('$id_pasien', '$id_jadwal', '$keluhan', '$no_antrian')";
    
    // Eksekusi query
    if (mysqli_query($mysqli, $query)) {
        echo '<script>';
        echo 'alert("Data Daftar Poliklinik berhasil ditambahkan!");';
        echo 'window.location.href = "../home_poli_pasien.php";';
        echo '</script>';
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($mysqli);
    }
}

// Tutup koneksi
mysqli_close($mysqli);
?>
