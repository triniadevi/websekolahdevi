<?php
include 'koneksi.php';  // Pastikan file koneksi.php ada dan sudah benar

// Pastikan form disubmit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nis = $_POST['nis'];
    $nama_siswa = $_POST['nama_siswa'];
    
    // Mengubah nilai jenis_kelamin menjadi 'L' atau 'P' sesuai input
    $jenis_kelamin = $_POST['jenis_kelamin'] == 'Laki-laki' ? 'L' : 'P';  // Ubah menjadi 'L' atau 'P'
    
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_kelas = $_POST['id_kelas'];
    $id_wali = $_POST['id_wali'];
    
    // Query untuk insert data ke tabel siswa
    $query = "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas, id_wali) 
              VALUES ('$nis', '$nama_siswa', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$id_kelas', '$id_wali')";
    
    // Menjalankan query dan memeriksa apakah query berhasil
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data siswa!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Tambah Siswa</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_siswa" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" required>
                    <?php
                    // Mengambil data kelas untuk dropdown
                    $query_kelas = "SELECT * FROM kelas";
                    $result_kelas = mysqli_query($koneksi, $query_kelas);
                    while ($row = mysqli_fetch_assoc($result_kelas)) :
                    ?>
                        <option value="<?php echo $row['id_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Wali Murid</label>
                <select name="id_wali" class="form-control" required>
                    <?php
                    // Mengambil data wali murid untuk dropdown
                    $query_wali = "SELECT * FROM wali_murid";
                    $result_wali = mysqli_query($koneksi, $query_wali);
                    while ($row = mysqli_fetch_assoc($result_wali)) :
                    ?>
                        <option value="<?php echo $row['id_wali']; ?>"><?php echo $row['nama_wali']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>