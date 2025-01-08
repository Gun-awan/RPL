<?php
    include "db/database.php";

    $error      ="";
    $sukses     ="";
    $username="";
    $password="";

    if(isset($_POST["daftar"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        if($koneksi->query($sql)){
            $sukses= "Daftar akun berhasil";
            header("refresh:2;url=menu.html");
        }else{
            $error= "Daftar Akun Gagal";
        }


    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="css/style2.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <form action="register.php" method="POST">
            <h1>Daftar Akun</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                    <input type="password" placeholder="Password" name="password">
                    <i class='bx bxs-lock-alt' ></i>
            </div>

            <button type="submit" class="btn" name="daftar"><strong>Daftar</strong></button>
            <p>___________________________________________________</p>
        </form>

        <p><?php echo $sukses ?></p>
        <h4><?php echo $error ?></h4>
    </div>
    
</body>
</html>