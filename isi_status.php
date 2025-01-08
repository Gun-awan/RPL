<?php
include "db/database.php"; // Pastikan Anda sudah membuat file database.php yang berisi koneksi ke database

$status    = "";
$error           = "";
$sukses          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM tb_status WHERE id_status = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $status   = $r1['status_pengaduan'];
}

if (isset($_POST['simpan'])) {
    $status    = $_POST['status_pengaduan'];

    if ($status) {
        if ($op == 'edit') { // untuk Update
            $sql1 = "UPDATE tb_status SET status_pengaduan = '$status' WHERE id_status = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data Berhasil di Update";
                header("refresh:2;url=status.php");
            } else {
                $error = "Data Gagal di Update";
            }
        } else { // untuk Insert
            $sql1 = "INSERT INTO tb_status (status_pengaduan) VALUES ($status)";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil Menambahkan Petugas";
                header("refresh:2;url=status.php");
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
                <strong><?php echo ($op == 'edit') ? "Edit" : "Tambah"; ?>Status</strong>
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
                        <label for="status_pengaduan" class="form-label">Status</label>
                        <input type="text" class="form-control" id="status_pengaduan" name="status_pengaduan" value="<?php echo $status ?>">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="status.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>