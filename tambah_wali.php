<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_wali = $_POST['nama_wali'];
    $kontak = $_POST['kontak'];
   
    $query = "INSERT INTO wali_murid (nama_wali, kontak) VALUES ('$nama_wali', '$kontak')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data wali murid berhasil ditambahkan'); window.location='wali_murid.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wali Murid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Wali Murid</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Wali Murid</label>
                <input type="text" name="nama_wali" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="kontak" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="wali_murid.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>>
