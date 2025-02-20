<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_siswa = $_GET['id'];
    
    // Query untuk menghapus data siswa
    $query = "DELETE FROM siswa WHERE id_siswa = '$id_siswa'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data siswa berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    echo "ID siswa tidak ditemukan.";
}
?>