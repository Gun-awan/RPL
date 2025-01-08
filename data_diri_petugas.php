

<?php
include "db/database.php"; // Pastikan Anda sudah membuat file database.php yang berisi koneksi ke database

$nama    = "";
$jabatan    = "";
$tgl_lahir = "";
$no_ktp  = "";
$alamat  ="";
$email ="";
$error  = "";
$sukses  = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id = $_GET['id_datadiri'];
    $sql1 = "SELECT * FROM data_diri WHERE id_datadiri = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama    = $r1['nama'];
    $jabatan    = $r1['jabatan'];
    $tgl_lahir    = $r1['tgl_lahir'];
    $no_ktp    = $r1['no_ktp'];
    $alamat    = $r1['alamat'];
    $email = $r1['email'];
}

if (isset($_POST['simpan'])) {
    $nama    = $_POST['nama'];
    $jabatan    = $_POST['jabatan'];
    $tgl_lahir    = $_POST['tgl_lahir'];
    $no_ktp  = $_POST['no_ktp'];
    $alamat    = $_POST['alamat'];
    $email = $_POST['email'];

    if ($nama && $tgl_lahir && $no_ktp && $alamat && $email) {
        if ($op == 'edit') { // untuk Update
            $sql1 = "UPDATE data_diri SET nama = '$nama', jabatan = '$jabatan', tgl_lahir = '$tgl_lahir', no_ktp = '$no_ktp', alamat = '$alamat', email = '$email' WHERE id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil di Update";
                header("refresh:2;url=data_petugas.php");
            } else {
                $error = "Data Gagal di Update";
            }
        } else { // untuk Insert
            $sql1 = "INSERT INTO data_diri (nama, jabatan, tgl_lahir, no_ktp, alamat, email) VALUES ('$nama', '$jabatan', '$tgl_lahir', '$no_ktp', '$alamat', '$email')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil Menambahkan Data Diri Masyarakat";
                header("refresh:2;url=data_petugas.php");
            } else {
                $error = "Gagal menambahkan data diri, periksa kembali Data Anda";
            }
        }
    } else {
        $error = "Silahkan Isi Semua Data";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah/Edit Petugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .mx-auto { width: 800px; margin-top: 20px; }
        .card { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                <strong><?php echo ($op == 'edit') ? "Edit" : " "; ?> Data Petugas</strong>
            </div>
            <div class="card-body">
            <?php 
            if($error){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
            }
        ?>
        <?php 
        if($sukses){
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
            <?php
        }
    ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $jabatan ?>">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $tgl_lahir ?>">
                    </div>
                    <div class="mb-3">
                        <label for="no_ktp" class="form-label">No. KTP</label>
                        <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="<?php echo $no_ktp ?>">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="petugas.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>