<?php
include 'koneksi.php';  // Pastikan file koneksi.php ada dan sudah benar

// Cek apakah ID siswa ada di URL
if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];

    // Ambil data siswa berdasarkan ID
    $query = "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'";
    $result = mysqli_query($koneksi, $query);

    // Jika data siswa ditemukan, ambil data tersebut
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

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
            
            // Query untuk update data siswa
            $update_query = "UPDATE siswa SET 
                nis = '$nis', 
                nama_siswa = '$nama_siswa',
                jenis_kelamin = '$jenis_kelamin', 
                tempat_lahir = '$tempat_lahir',
                tanggal_lahir = '$tanggal_lahir', 
                id_kelas = '$id_kelas', 
                id_wali = '$id_wali'
                WHERE id_siswa = '$id_siswa'";

            // Menjalankan query dan memeriksa apakah query berhasil
            if (mysqli_query($koneksi, $update_query)) {
                echo "<script>alert('Data siswa berhasil diperbarui!'); window.location='index.php';</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data siswa!');</script>";
            }
        }
    } else {
        // Jika data siswa tidak ditemukan
        echo "<script>alert('Data siswa tidak ditemukan!'); window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('ID siswa tidak tersedia!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-3">Edit Siswa</h2>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">NIS</label>
                <input type="text" name="nis" class="form-control" value="<?php echo htmlspecialchars($data['nis']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama_siswa" class="form-control" value="<?php echo htmlspecialchars($data['nama_siswa']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki" <?php echo $data['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo $data['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" name="tempat_lahir" class="form-control" value="<?php echo htmlspecialchars($data['tempat_lahir']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo htmlspecialchars($data['tanggal_lahir']); ?>" required>
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
                        <option value="<?php echo $row['id_kelas']; ?>" <?php echo $data['id_kelas'] == $row['id_kelas'] ? 'selected' : ''; ?>><?php echo $row['nama_kelas']; ?></option>
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
                        <option value="<?php echo $row['id_wali']; ?>" <?php echo $data['id_wali'] == $row['id_wali'] ? 'selected' : ''; ?>><?php echo $row['nama_wali']; ?></option>
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
