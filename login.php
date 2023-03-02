<?php 
   session_start();
   require "config.php";
   error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  $nama = $_POST['nama'];
  $password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from multi_user where nama='$nama' and password='$password'");
$cek = mysqli_num_rows($login);
if($cek > 0){
	$data = mysqli_fetch_assoc($login);
	$_SESSION["id_user"] = $data["id_user"];
    $_SESSION["nama"] = $nama;

	if($data['level']=="admin"){
		$_SESSION['nama'] = $nama;
		$_SESSION['level'] = "admin";
		header("location:admin/produk.php");
	// cek jika user login sebagai user
	}else if($data['level']=="user"){
		$_SESSION['nama'] = $nama;
		$_SESSION['level'] = "user";
        ?>             
        <meta http-equiv="refresh" content="0; url=user/user.php" />
        <?php
	}else{
		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}
}	
?>
<!DOCTYPE html>
<html>
    <head>
        <title>login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/css1/login.css">
    </head>
    <body>
    <div class="container">
            <h4 class="text-center">Login</h4>
            <form action="" method="post">
                <div class="form-group">
                    <label for="">Username :</label>
                    <div class="input-group">
                      <input type="text" name="nama" class="form-control" required>
                  </div>
                </div>
                <div class="form-group">
                    <label for="">Password :</label>
                    <div class="input-group">
                    <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <br>
                <button type="submit" name="login" class="btn btn-success">LOGIN</button>
            </form>
            <h10 class="text-center" style="color: blue;">don't have an account?</h10>
            <a href="daftar.php">
            <button class="btn btn-danger w-100">Register</button>
        </a>
        </div>
    </body>
</html>