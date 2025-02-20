<?php
include 'koneksi.php';

// Pastikan koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Cek apakah ID wali murid ada di URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id']; // Pastikan ID adalah integer

    // Ambil data wali berdasarkan ID
    $query = "SELECT * FROM wali_murid WHERE id_wali = $id";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($koneksi));
    }

    $wali = mysqli_fetch_assoc($result);

    if (!$wali) {
        echo "<script>alert('Data tidak ditemukan'); window.location='wali_murid.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location='wali_murid.php';</script>";
    exit;
}

// Proses form jika disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
    $kontak = mysqli_real_escape_string($koneksi, $_POST['kontak']);

    // Update data wali
    $query = "UPDATE wali_murid SET nama_wali = '$nama_wali', kontak = '$kontak' WHERE id_wali = $id";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data wali murid berhasil diperbarui'); window.location='wali_murid.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Wali Murid</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" class="form-control" value="<?php echo htmlspecialchars($wali['nama_wali']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">kontak</label>
                <input type="text" name="kontak" class="form-control" value="<?php echo htmlspecialchars($wali['kontak']); ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="wali.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>