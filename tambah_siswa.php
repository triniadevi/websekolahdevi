<?php 
include 'koneksi.php';

// Define variables and initialize with empty values
$nis = $nama_siswa = $jenis_kelamin = $tempat_lahir = $tanggal_lahir = $id_kelas = $id_wali = "";
$nis_err = $nama_siswa_err = $jenis_kelamin_err = $tempat_lahir_err = $tanggal_lahir_err = $id_kelas_err = $id_wali_err = "";

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate NIS
    if (empty(trim($_POST["nis"]))) {
        $nis_err = "NIS is required.";
    } else {
        $nis = trim($_POST["nis"]);
    }

    // Validate Nama Siswa
    if (empty(trim($_POST["nama_siswa"]))) {
        $nama_siswa_err = "Nama Siswa is required.";
    } else {
        $nama_siswa = trim($_POST["nama_siswa"]);
    }

    // Validate Jenis Kelamin
    if (empty(trim($_POST["jenis_kelamin"]))) {
        $jenis_kelamin_err = "Jenis Kelamin is required.";
    } else {
        $jenis_kelamin = trim($_POST["jenis_kelamin"]);
    }

    // Validate Tempat Lahir
    if (empty(trim($_POST["tempat_lahir"]))) {
        $tempat_lahir_err = "Tempat Lahir is required.";
    } else {
        $tempat_lahir = trim($_POST["tempat_lahir"]);
    }

    // Validate Tanggal Lahir
    if (empty(trim($_POST["tanggal_lahir"]))) {
        $tanggal_lahir_err = "Tanggal Lahir is required.";
    } else {
        $tanggal_lahir = trim($_POST["tanggal_lahir"]);
    }

    // Validate ID Kelas
    if (empty(trim($_POST["id_kelas"]))) {
        $id_kelas_err = "ID Kelas is required.";
    } else {
        $id_kelas = trim($_POST["id_kelas"]);
    }

    // Validate ID Wali
    if (empty(trim($_POST["id_wali"]))) {
        $id_wali_err = "ID Wali is required.";
    } else {
        $id_wali = trim($_POST["id_wali"]);
    }

    // Check input errors before inserting into the database
    if (empty($nis_err) && empty($nama_siswa_err) && empty($jenis_kelamin_err) && empty($tempat_lahir_err) && empty($tanggal_lahir_err) && empty($id_kelas_err) && empty($id_wali_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tempat_lahir, tanggal_lahir, id_kelas, id_wali) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($koneksi, $sql)) {
            // Bind variables to the prepared statement
            mysqli_stmt_bind_param($stmt, "sssssss", $param_nis, $param_nama_siswa, $param_jenis_kelamin, $param_tempat_lahir, $param_tanggal_lahir, $param_id_kelas, $param_id_wali);

            // Set parameters
            $param_nis = $nis;
            $param_nama_siswa = $nama_siswa;
            $param_jenis_kelamin = $jenis_kelamin;
            $param_tempat_lahir = $tempat_lahir;
            $param_tanggal_lahir = $tanggal_lahir;
            $param_id_kelas = $id_kelas;
            $param_id_wali = $id_wali;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to the data siswa page
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($koneksi);
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
        <form method="POST">
            <div class="mb-3">
                <label for="nis" class="form-label">NIS</label>
                <input type="text" class="form-control <?php echo (!empty($nis_err)) ? 'is-invalid' : ''; ?>" id="nis" name="nis" value="<?php echo $nis; ?>">
                <span class="invalid-feedback"><?php echo $nis_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="nama_siswa" class="form-label">Nama Siswa</label>
                <input type="text" class="form-control <?php echo (!empty($nama_siswa_err)) ? 'is-invalid' : ''; ?>" id="nama_siswa" name="nama_siswa" value="<?php echo $nama_siswa; ?>">
                <span class="invalid-feedback"><?php echo $nama_siswa_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-select <?php echo (!empty($jenis_kelamin_err)) ? 'is-invalid' : ''; ?>" id="jenis_kelamin" name="jenis_kelamin">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" <?php echo ($jenis_kelamin == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo ($jenis_kelamin == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
                <span class="invalid-feedback"><?php echo $jenis_kelamin_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control <?php echo (!empty($tempat_lahir_err)) ? 'is-invalid' : ''; ?>" id="tempat_lahir" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>">
                <span class="invalid-feedback"><?php echo $tempat_lahir_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control <?php echo (!empty($tanggal_lahir_err)) ? 'is-invalid' : ''; ?>" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>">
                <span class="invalid-feedback"><?php echo $tanggal_lahir_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="id_kelas" class="form-label">ID Kelas</label>
                <input type="text" class="form-control <?php echo (!empty($id_kelas_err)) ? 'is-invalid' : ''; ?>" id="id_kelas" name="id_kelas" value="<?php echo $id_kelas; ?>">
                <span class="invalid-feedback"><?php echo $id_kelas_err; ?></span>
            </div>
            <div class="mb-3">
                <label for="id_wali" class="form-label">ID Wali Murid</label>
                <input type="text" class="form-control <?php echo (!empty($id_wali_err)) ? 'is-invalid' : ''; ?>" id="id_wali" name="id_wali" value="<?php echo $id_wali; ?>">
                <span class="invalid-feedback"><?php echo $id_wali_err; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Siswa</button>
        </form>
        <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Data Siswa</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
