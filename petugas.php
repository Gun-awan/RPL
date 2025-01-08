<?php
include "db/database.php"; // Pastikan Anda sudah membuat file database.php yang berisi koneksi ke database

$error ="";
$sukses ="";

// Fungsi untuk menghapus data petugas
if (isset($_GET['op']) && $_GET['op'] == 'delete') {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM petugas WHERE id_petugas = '$id'";
    $q_delete = mysqli_query($koneksi, $sql_delete);
    if ($q_delete) {
        $sukses = "Data Berhasil di Hapus";
        header("Location: petugas.php");
    } else {
        $error = "Data Gagal di Hapus";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Petugas</title>
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        a.tbl-kembali {
            text-decoration: none;
            color: blue;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            float: right;
        }
        a.tbl-kembali:hover {
            text-decoration: underline;
        }
        .judul {
            font-size: 35px;
            margin-top: 5px;
            padding-top: 5px;
        }
        .mx-auto { margin-top: 30px; }
        
    </style>
</head>
<body>
    <div class="judul text-center"><strong>DATA PETUGAS</strong></div>
    <div class="mx-auto">
        <p>
            <a href="petugas_proses.php" class="tbl-pink">Tambah Petugas</a>
            <a href="dasboard.php" class="tbl-kembali">Kembali</a>
        </p>

        <!-- Untuk Mengeluarkan Data Petugas -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Riwayat Petugas
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
                <table class="table">
                    <thead>
                        <tr class="head">
                            <th scope="col">No</th>
                            <th scope="col">Nama Petugas</th>
                            <th scope="col">Jabatan Petugas</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM petugas ORDER BY id_petugas DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id               = $r2['id_petugas'];
                            $nama_petugas     = $r2['nama_petugas'];
                            $jabatan_petugas  = $r2['jabatan_petugas'];
                        ?>
                        <tr class="isi">
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $nama_petugas ?></td>
                            <td scope="row"><?php echo $jabatan_petugas ?></td>
                            <td scope="row">
                                <a href="petugas_proses.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                <a href="petugas.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>