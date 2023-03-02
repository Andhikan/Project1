<html>
<head>
	<title>Registrasi</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="css/css1/login.css"/>
    
</head>
<body>
<?php
require('config.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($conn,$username); 
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn,$password);
	$nama = stripslashes($_REQUEST['nama']);
	$nama = mysqli_real_escape_string($conn,$nama);
        $query = "INSERT into `multi_user` (nama, username, password, level) 
		VALUES ('$nama', '$username', '$password', 'user')";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<script>
            alert('account registered successfully')
            window.location.href = 'login.php' 
          </script>";
        }
    }else{
?>
<div class="container">
	<h4 class="text-center" >Register</h4>
<form name="daftar" action="" method="post">
<div class="form-group">
                    <label for="">Name :</label>
                    <div class="input-group">
                      <input type="text" name="nama" class="form-control" required>
                  </div>
                </div>
				<div class="form-group">
                    <label for="">Email :</label>
                    <div class="input-group">
                      <input type="email" name="username" class="form-control"  required>
                  </div>
                </div>
				<div class="form-group">
                    <label for="">Password</label>
                    <div class="input-group">
                      <input type="text" name="password" class="form-control"  required>
                  </div>
                </div>
                <br>
                <button class="btn btn-danger" type="submit" name="submit" value="Register" />Register</button>
  </form>
  <h10 class="text-center" style="color: blue;">Already have an account?</h10>
  <a class="btn btn-success w-100" href="login.php">Login</a>
  </div>
  <?php } ?>
  </body>
  </html>
