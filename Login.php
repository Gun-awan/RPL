<!-- <?php
    include "db/database.php";

    $error = "";
    $sukses="";

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

        $result = $koneksi->query($sql);

        if($result->num_rows > 0) {
            $sukses = "Login Berhasil";
            header("refresh:3;url=dasboard.php");
        } else{
            $error= "Akun tidak ditemukan";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="wrapper">
        <form action="Login.php" method="POST">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username">
                <i class='bx bxs-user'></i>
            </div>
            <div class="input-box">
                    <input type="password" placeholder="Password" name="password">
                    <i class='bx bxs-lock-alt' ></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox">Remember Me</label>
                <a href="#">Forgot Password</a>
            </div>

            <button type="submit" class="btn" name="login"><strong>Login</strong></button>
            
            <div class="register-link">
                <p>Belum punya Akun? <a href="register.php">DAFTAR</a></p>
            </div>
            <p>___________________________________________________</p>
            <h3><?php echo $error ?></h3>
            <h3><?php echo $sukses ?></h3>

        </form>
    </div>
    
</body>
</html> -->