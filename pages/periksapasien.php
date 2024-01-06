<?php
include 'koneksi.php';

// Mengambil nilai id dari parameter URL
$id_periksa = $_GET['id'];


// Query untuk mengambil data dari tabel daftar_poli berdasarkan id
$query = "SELECT daftar_poli.*, pasien.nama AS nama_pasien
FROM daftar_poli
INNER JOIN pasien ON daftar_poli.id_pasien = pasien.id
WHERE daftar_poli.id = $id_periksa";

$query_obat = "SELECT * FROM obat";

$result = mysqli_query($mysqli, $query);
$result_obat = mysqli_query($mysqli, $query_obat);

// Mengambil hasil query sebagai array asosiatif
$periksas = mysqli_fetch_assoc($result);
$obat = mysqli_fetch_all($result_obat, MYSQLI_ASSOC);

// Cek apakah data ditemukan
if (!$periksas) {
    // Handle jika data tidak ditemukan, misalnya redirect atau tampilkan pesan
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Pasien</title>

    <!-- Tambahkan link CSS untuk Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Tambahkan tag script untuk jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Tambahkan script Select2 setelah script jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
</head>


<body>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Periksa Pasien</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php?page=home">Home</a></li>
                        <li class="breadcrumb-item active">Periksa Pasien</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title">Periksa Pasien</h3>
                        </div>
                        <div class="card-body">
                            <form action="pages/tambahperiksa.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="id_daftar_poli" name="id_daftar_poli"
                                        value="<?= $id_periksa; ?>" >
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Pasien</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= $periksas['nama_pasien']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_periksa">Tanggal Periksa</label>
                                    <input type="date" class="form-control" id="tgl_periksa" name="tgl_periksa">
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <input type="text" class="form-control" id="catatan" name="catatan">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Obat</label>
                                    <select name="obat[]" id="obat" class="form-control" multiple>
                                        <option value="">-Pilih Obat-</option>
                                        <?php
                                        include "koneksi.php";

                                        $query_obat = "SELECT * FROM obat";
                                        $db_obat = mysqli_query($mysqli, $query_obat);

                                        while ($obat = mysqli_fetch_assoc($db_obat)) {
                                        ?>
                                        <option value="<?= $obat['id'] ?>|<?= $obat['harga'] ?>">
                                            <?= $obat['nama_obat'] ?>
                                            - <?= $obat['kemasan'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="biaya_periksa">Biaya Periksa</label>
                                    <input type="text" class="form-control" id="biaya_periksa" name="biaya_periksa"
                                        readonly>
                                </div>

                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  script inisialisasi Select2 -->
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('obat') // id
    </script>


    <script>
        // Fungsi menghitung biaya periksa berdasarkan harga dasar dan harga obat yang dipilih
        function hitungBiayaPeriksa() {
            // Harga dasar periksa
            var hargaDasar = 150000;

            // Ambil element select obat
            var selectObat = document.getElementById('obat');

            // Ambil nilai option yang dipilih
            var selectedObat = [];
            for (var i = 0; i < selectObat.options.length; i++) {
                if (selectObat.options[i].selected) {
                    selectedObat.push(selectObat.options[i].value);
                }
            }

            // Hitung total harga obat
            var totalHargaObat = 0;
            for (var i = 0; i < selectedObat.length; i++) {
                var obatInfo = selectedObat[i].split('|');
                totalHargaObat += parseFloat(obatInfo[1]);
            }

            // Hitung total biaya periksa
            var totalBiayaPeriksa = hargaDasar + totalHargaObat;

            // Tampilkan total biaya periksa di input biaya_periksa
            document.getElementById('biaya_periksa').value = totalBiayaPeriksa.toFixed(2);
        }

        // Panggil fungsi hitungBiayaPeriksa saat ada perubahan pada select obat
        document.getElementById('obat').addEventListener('change', hitungBiayaPeriksa);

        // Panggil fungsi hitungBiayaPeriksa saat halaman pertama kali dimuat
        hitungBiayaPeriksa();
    </script>


</body>

</html>