<?php
include "db/database.php";

$judul      ="";
$deskripsi  ="";
$kategori   ="";
$tanggal    ="";
$error      ="";
$sukses     ="";

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

if($op == 'edit'){
    $id  = $_GET['id'];
    $sql1   = "select * from pengaduan where id  = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $judul = $r1['judul'];
    $kategori   = $r1['kategori'];
    $deskripsi   = $r1['deskripsi'];
    $tanggal   = $r1['tanggal_pengaduan'];

}

if (isset($_POST['simpan'])){
    $kategori   = $_POST['kategori'];
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $tanggal  = $_POST['tanggal'];

    if ($judul && $kategori && $deskripsi){

        if ($op == 'edit'){ //untuk Update
            $sql1       = "update pengaduan set kategori = '$kategori',judul = '$judul', deskripsi ='$deskripsi', tanggal_pengaduan ='$tanggal' where id = '$id' ";
            $q1         = mysqli_query($koneksi,$sql1);
            if ($q1){
                $sukses = "Data Berhasil di Update";
            }else{
                $error = "Data Gagal di Update";
            }
        }else { // untuk Insert
            $sql1 = "insert into pengaduan (kategori,judul,deskripsi,tanggal_pengaduan) values ('$kategori','$judul','$deskripsi','$tanggal')";
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
        
    </style>

</head>
<body>
<nav>
    <div class="wrapper">
      <div class="logo"><a href="#">Ngadu.com</a></div>
      <div class="menu">
        <ul>
          <li><a href="#">Beranda</a></li>
          <li><a href="#">Berita</a></li>
          <li><a href="#">Tentang</a></li>
          <li><a href="#">Informasi</a></li>
          <li><a href="#" class="btn">Logout</a></li>
        </ul>
      </div>
  </nav>
    <div class="mx-auto">
    <p><a href="new.php" class="tbl-pink">Buat Pengaduan</a></p>

        <!-- Untuk Mengeluarkan Data-->
        <div class="card">
            <div class="card-header text-white bg-secondary">
            Riwayat Pengaduan
            </div>
        <div class="card-body">
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
                        $sql2  = "select * from pengaduan order by id desc";
                        $q2  = mysqli_query($koneksi,$sql2);
                        $urut =1;
                        while($r2 = mysqli_fetch_array($q2)){
                            $id         = $r2['id'];
                            $judul      = $r2['judul'];
                            $kategori   = $r2['kategori'];
                            $deskripsi   = $r2['deskripsi'];
                            $tanggal   = $r2['tanggal_pengaduan'];
                            

                            ?>
                            <tr class="isi">
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kategori ?></td>
                                <td scope="row"><?php echo $judul ?></td>
                                <td scope="row"><?php echo $deskripsi ?></td>
                                <td scope="row"><?php echo $tanggal ?></td>
                                <td scope="row"></td>
                                <td scope="row">
                                    
                                    <a href="index.php?op=edit&id=<?php echo $id?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick=" return confirm('Apakah Anda Yakin Ingin Menghapus Data?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                                
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
