<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil input nama kelas dan sanitasi dengan mysqli_real_escape_string
    $nama_kelas = mysqli_real_escape_string($koneksi, $_POST['nama_kelas']);

    // Gunakan prepared statement untuk menghindari SQL Injection
    $query = "INSERT INTO kelas (nama_kelas) VALUES (?)";

    // Siapkan prepared statement
    if ($stmt = mysqli_prepare($koneksi, $query)) {
        // Bind parameter
        mysqli_stmt_bind_param($stmt, "s", $nama_kelas);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Kelas berhasil ditambahkan!'); window.location='kelas.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan kelas!');</script>";
        }

        // Tutup prepared statement
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Terjadi kesalahan pada query!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Kelas</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="kelas.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>