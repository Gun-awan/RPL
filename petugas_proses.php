<?php
include "db/database.php"; // Pastikan Anda sudah membuat file database.php yang berisi koneksi ke database

$nama_petugas    = "";
$jabatan_petugas = "";
$error           = "";
$sukses          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id = $_GET["id"];
    $sql1 = "SELECT * FROM petugas WHERE id_petugas = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama_petugas    = $r1['nama_petugas'];
    $jabatan_petugas = $r1['jabatan_petugas'];
}

if (isset($_POST['simpan'])) {
    $nama_petugas    = $_POST['nama_petugas'];
    $jabatan_petugas = $_POST['jabatan_petugas'];

    if ($nama_petugas && $jabatan_petugas) {
        if ($op == 'edit') { // untuk Update
            $sql1 = "UPDATE petugas SET nama_petugas = '$nama_petugas', jabatan_petugas = '$jabatan_petugas' WHERE id_petugas = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil di Update";
                header("refresh:2;url=petugas.php");
            } else {
                $error = "Data Gagal di Update";
            }
        } else { // untuk Insert
            $sql1 = "INSERT INTO petugas (nama_petugas, jabatan_petugas) VALUES ('$nama_petugas', '$jabatan_petugas')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil Menambahkan Petugas";
                header("refresh:2;url=petugas.php");
            } else {
                $error = "Gagal Menambahkan Petugas";
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
                <strong><?php echo ($op == 'edit') ? "Edit" : "Tambah"; ?> Petugas</strong>
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
                        <label for="nama_petugas" class="form-label">Nama Petugas</label>
                        <input type="text" class="form-control" id="nama_petugas" name="nama_petugas" value="<?php echo $nama_petugas ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan_petugas" class="form-label">Jabatan Petugas</label>
                        <input type="text" class="form-control" id="jabatan_petugas" name="jabatan_petugas" value="<?php echo $jabatan_petugas ?>">
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