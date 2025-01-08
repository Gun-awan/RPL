<?php
include "db/database.php";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MENU</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    

</head>
<body>
  <nav>
    <div class="wrapper">
      <div class="logo"><a href="#"></a></div>
      <div class="menu">
        <ul>
          <li><a href="#">Beranda</a></li>
          <li><a href="index.php">Pengaduan</a></li>
          <li><a href="petugas.php">Petugas</a></li>
          <li><a href="#">User</a></li>
          <li><a href="data.php">Data Masyarakat</a></li>
          <li><a href="Login.php" class="btn">Logout</a></li>
        </ul>
      </div>
  </nav>
  <div class="wrapper">
    <section id="Beranda">
      <img src="css/image/gambar.jpg" width="500" height="500"/>
      
      <div class="kolom">
        <P class="deskripsi">Selamat Datang di</P>
        <h1>Web Pengaduan Masyarakat</h1>
        <p>Layanan Pengaduan Masyarakat Berbasis WEB. Dengan adanya website ini masyarakat kini lebih mudah untuk melakukan pengaduan terkait keresahan yang terjadi di lingkungan Desa.</p>
        <p><a href="new.php" class="tbl-pink">Buat Pengaduan</a></p>
        <p><a href="index.php" class="tbl-pink">Lihat Pengaduan Saya</a></p>
      </div>
      
    </section>
  </div>

    
</body>
</html>