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
    $id  = $_GET['id'];
    $sql1   = "select * from pengaduan where id_pengaduan  = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $judul = $r1['judul'];
    $kategori   = $r1['kategori'];
    $deskripsi   = $r1['deskripsi'];
    $tanggal   = $r1['tanggal_pengaduan'];
    $status   = $r1['status'];

}

if (isset($_POST['batal'])){
    header("location:index.php");
}

if (isset($_POST['simpan'])){
    $kategori   = $_POST['kategori'];
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $tanggal  = $_POST['tanggal'];
    $status   = $_POST['status'];

    if ($judul && $kategori && $deskripsi){

        if ($op == 'edit'){ //untuk Update
            $sql1       = "update pengaduan set kategori = '$kategori',judul = '$judul', deskripsi ='$deskripsi', tanggal_pengaduan ='$tanggal', status='$status' where id_pengaduan = '$id' ";
            $q1         = mysqli_query($koneksi,$sql1);
            if ($q1){
                $sukses = "Data Berhasil di Update";
                header("refresh:2;url=index.php");
            }else{
                $error = "Data Gagal di Update";
            }
        }
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
    <div class="mx-auto">

    <div class="card">
            <div class="card-header">
           <h5><strong>Edit Pengaduan</strong></h5>
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
        <div class="mb-3">
         <label for="kategori" class="form-label">Status</label>
         <select class="form-control" name="status" id="status">
            
            <option value="Mengajukan" <?php if($status == "Mengajukan") echo "selected"?>>Mengajukan</option>

        </select>
        </div>
        <div class="col-12">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
            <input type="submit" name="batal" value="Batal" class="btn btn-danger"/>
        </div>

        </form>
        </div>
       
        </div>


    </div>

    
</body>
</html>
<script></script>
