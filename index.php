<?php
include "db/database.php";

$judul      ="";
$deskripsi  ="";
$kategori   ="";
$tanggal    ="";
$status     ="";
$error      ="";
$sukses     ="";

if (isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op ="";
}
if ($op == 'delete'){
    $id  = $_GET['id'];
    $sql1   = "delete from pengaduan where id_pengaduan= '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Data Berhasil di Hapus";
    }else {
        $error = " Data Gagal di Hapus";
    }
}

if($op == 'edit'){
    $id  = $_GET['id_pengaduan'];
    $sql1   = "select * from pengaduan where id_pengaduan  = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $judul = $r1['judul'];
    $kategori   = $r1['kategori'];
    $deskripsi   = $r1['deskripsi'];
    $tanggal   = $r1['tanggal_pengaduan'];
    $status     = $r1['status'];

}

if (isset($_POST['simpan'])){
    $kategori   = $_POST['kategori'];
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $tanggal  = $_POST['tanggal'];
    $status   = $_POST['status'];

    if ($judul && $kategori && $deskripsi){

        if ($op == 'edit'){ //untuk Update
            $sql1       = "update pengaduan set kategori = '$kategori',judul = '$judul', deskripsi ='$deskripsi', tanggal_pengaduan ='$tanggal',status ='$status' where id_pengaduan = '$id' ";
            $q1         = mysqli_query($koneksi,$sql1);
            if ($q1){
                $sukses = "Data Berhasil di Update";
                
            }else{
                $error = "Data Gagal di Update";
            }
        }else { // untuk Insert
            $sql1 = "insert into pengaduan (kategori,judul,deskripsi,tanggal_pengaduan,status) values ('$kategori','$judul','$deskripsi','$tanggal','$status')";
            $q1   =mysqli_query($koneksi,$sql1);
        if ($q1){
            $sukses = "Berhasil Membuat Pengaduan";
        }else{
            $error  = "Gagal Membuat Pengaduan";
        }
        }

    } else{
        $error="Silahkan Isi Semua Data";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan</title>
    <link rel="stylesheet" href="style3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        a.tbl-kembali {
        text-decoration: none;
        color: blue;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        float: right;}
        a.tbl-kembali:hover {
            text-decoration: underline;
        }
        .judul {
            font-size: 35px;
            margin-top: 5px;
            padding-top: 5px;
        }
        .mx-auto{margin-top: 30px;}
    </style>

</head>
<body>
    <div class="judul text-center"><strong>DATA PENGADUAN</strong></div>
    <div class="mx-auto">
    <p>
        <a href="new.php" class="tbl-pink">Buat Pengaduan</a>
        <a href="dasboard.php" class="tbl-kembali">Kembali</a>
    </p>

        <!-- Untuk Mengeluarkan Data-->
        <div class="card">
            <div class="card-header text-white bg-secondary">
            Riwayat Pengaduan
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
                        <th scope="col">Kategori</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Tgl Aduan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tindakan</th>
                    </tr>
                    <tbody>
                        <?php
                        $sql2  = "select * from pengaduan order by id_pengaduan desc";
                        $q2  = mysqli_query($koneksi,$sql2);
                        $urut =1;
                        while($r2 = mysqli_fetch_array($q2)){
                            $id         = $r2['id_pengaduan'];
                            $judul      = $r2['judul'];
                            $kategori   = $r2['kategori'];
                            $deskripsi  = $r2['deskripsi'];
                            $tanggal   = $r2['tanggal_pengaduan'];
                            $status    = $r2['status'];
                            

                            ?>
                            <tr class="isi">
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kategori ?></td>
                                <td scope="row"><?php echo $judul ?></td>
                                <td scope="row"><?php echo $deskripsi ?></td>
                                <td scope="row"><?php echo $tanggal ?></td>
                                <td scope="row"><?php echo $status ?></td>
                                <td scope="row">
                                    
                                    <a href="edit.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick=" return confirm('Apakah Anda Yakin Ingin Menghapus Data?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                                    <a href="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgb(2, 75, 212);transform: msFilter"><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"></path></svg>
                                    </a>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </thead>

            </table>
       
        </div>

    </div>

    
</body>
</html>
<script></script>


