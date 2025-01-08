<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "rpl";

$koneksi = mysqli_connect($host, $user, $password, $db);

if( !$koneksi ){
    die("Gagal terhubung dengan database: ");
}
$judul      ="";
$deskripsi  ="";
$kategori   ="";
$tanggal    ="";
$status     ="";
$error      ="";
$sukses     ="";
$deskripsi_masalah ="";
$id ="";

if (isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op ="";
}
if ($op == 'delete'){
    $id  = $_GET['id'];
    $sql1   = "delete from pengaduan where id= '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Data Berhasil di Hapus";
    }else {
        $error = " Data Gagal di Hapus";
    }
}

if (isset($_POST['batal'])){
    header("location:tampilan_pengaduan.php");
}

if($op == 'edit'){
    $id  = $_GET['id'];
    $sql1   = "select * from pengaduan where id  = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $judul = $r1['judul'];
    $kategori   = $r1['kategori'];
    $deskripsi   = $r1['deskripsi'];
    $tanggal   = $r1['tanggal_pengaduan'];
    $status = $r1['status'];

}

if (isset($_POST['simpan'])){
    $kategori   = $_POST['kategori'];
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $tanggal  = $_POST['tanggal'];
    $status = $_POST['status'];

    if ($judul && $kategori && $deskripsi){

        if ($op == 'edit'){ //untuk Update
            $sql1       = "update pengaduan set kategori = '$kategori',judul = '$judul', deskripsi ='$deskripsi', tanggal_pengaduan ='$tanggal', status='$status' where id = '$id' ";
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
            header("refresh:2;url=index.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style3.css">

</head>
<body>

<div class="mx-auto">

<!-- Untuk Memasukan Data-->
<div class="card">
    <div class="card-header">
    <strong>Tindak Lanjut Pengaduan</strong>
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
   <?php 
   
   ?>
</div>
<div class="mb-3">
    Detail Aduan
    <div class="wrapper">
    <br>
    <ul>
        <!-- Coba-coba-->
        <?php 
            $sql1   = "select * from pengaduan (kategori,judul,deskripsi,tanggal_pengaduan,status) values ('$kategori','$judul','$deskripsi','$tanggal','$status') where id = '$id'";
            $q1         = mysqli_query($koneksi,$sql1);
        ?>

        <li>Kategori          : <?php echo $kategori ?></li>
        <li>Judul             : <?php echo $judul ?></li>
        <li>Deskripsi Masalah : <?php echo $deskripsi_masalah ?></li>
    </ul>
    </div>
</div>
<br>
<div class="mb-3">
    <label for="message" class="form-label">Hasil Tindak Lanjut</label>
        <textarea class="form-control" id="deskripsi" rows="2" name="deskripsi" value="<?php echo $deskripsi ?>"></textarea>                       
</div>
<div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal Tindak Lanjut</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= date('Y-m-d') ?>">
</div>
<div class="mb-3">
    <label for="petugas" class="form-label">Petugas Yang Menindaklanjuti</label>
        <input type="text" class="form-control" id="petugas" name="petugas" value="">
        <?php
        
        
        echo $judul ?>
</div>
<div class="mb-3">
    <label for="kategori" class="form-label">Ubah Status</label>
        <select class="form-control" name="status" id="status">
            <option value="">- Status -</option>
            <option value="diterima" <?php if($kategori == "Diterima") echo "selected"?>>Diterima</option>
            <option value="diproses" <?php if($kategori == "Diproses") echo "selected"?>>Diproses</option>
            <option value="selesai" <?php if($kategori == "Selesai") echo "selected"?>>Selesai</option>
        </select>
</div>
<div class="col-12">
    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
    <input type="submit" name="batal" value="Batal" class="btn btn-danger"/>
</div>

</form>
</div>
    
</body>
</html>