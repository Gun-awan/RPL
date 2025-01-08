<?php
include "db/database.php"; // Pastikan Anda sudah membuat file database.php yang berisi koneksi ke database

// Fungsi untuk menghapus data petugas
if (isset($_GET['op']) && $_GET['op'] == 'delete') {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM data_diri WHERE id = '$id'";
    $q_delete = mysqli_query($koneksi, $sql_delete);
    if ($q_delete) {
        $sukses = "Data Berhasil di Hapus";
        header("Location: data.php");
        exit;
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
    <div class="judul text-center"><strong>DATA DIRI</strong></div>
    <div class="mx-auto">
        <p>
            <a href="isi_data.php" class="tbl-pink">Tambah Data Petugas</a>
            <a href="dasboard.php" class="tbl-kembali">Kembali</a>
        </p>

        <!-- Untuk Mengeluarkan Data Petugas -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Riwayat Petugas
            </div>
            <div class="card-body">
                <?php
                if (isset($error) && $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
                if (isset($sukses) && $sukses) {
                    echo "<div class='alert alert-success'>$sukses</div>";
                }
                ?>
                <table class="table">
                    <thead>
                        <tr class="head">
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">No KTP</th>
                            <th scope="col">Alamat Tinggal</th>
                            <th scope="col">Alamat Email</th>
                            <th scope="col">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM data_diri ORDER BY id_datadiri DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id_datadiri'];
                            $nama = $r2['nama'];
                            $jabatan = $r2['jabatan'];
                            $tgl_lahir = $r2['tgl_lahir'];
                            $no_ktp = $r2['no_ktp'];
                            $alamat = $r2['alamat'];
                            $email = $r2['email'];
                        ?>
                        <tr class="isi">
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $nama ?></td>
                            <td scope="row"><?php echo $jabatan ?></td>
                            <td scope="row"><?php echo $tgl_lahir ?></td>
                            <td scope="row"><?php echo $no_ktp ?></td>
                            <td scope="row"><?php echo $alamat ?></td>
                            <td scope="row"><?php echo $email ?></td>
                            <td scope="row">
                                <a href="isi_data.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                <a href="data.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data?')"><button type="button" class="btn btn-danger">Hapus</button></a>
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