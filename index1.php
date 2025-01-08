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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .mx-auto{width: 1300px;}
        .card {margin-top: 10px;}
        .head {text-align:center;}
        .isi {text-align:center;}

    </style>

</head>
<body>
    <div class="mx-auto">

        <!-- Untuk Memasukan Data-->
        <div class="card">
            <div class="card-header">
            Buat Pengaduan
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
            <label for="kategori" class="form-label">Kategori</label>
                <select class="form-control" name="kategori" id="kategori">
                    <option value="">- Pilih Kategori -</option>
                    <option value="Peraturan" <?php if($kategori == "Peraturan") echo "selected"?>>Peraturan</option>
                    <option value="Lingkungan" <?php if($kategori == "Lingkungan") echo "selected"?>>Lingkungan</option>
                    <option value="Pembangunan" <?php if($kategori == "Pembangunan") echo "selected"?>>Pembangunan</option>
                    <option value="Bantuan" <?php if($kategori == "Bantuan") echo "selected"?>>Bantuan Desa</option>

                </select>
        </div>
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $judul ?>">
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $deskripsi ?>">
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Pengaduan</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal ?>">
        </div>
        <div class="col-12">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
            <input type="submit" name="batal" value="Batal" class="btn btn-danger"/>
        </div>

        </form>
        </div>

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
                        <th scope="col">Tanggal Pengaduan</th>
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
                                    <a href=""><button type="button" class="btn btn-primary">Detail</button></a>
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
