<?php 
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
    require "../config.php";
    $id = $_GET['q'];
    $queryproduk = mysqli_query($conn,"SELECT * FROM produk WHere id_produk='$id'");
    $produk = mysqli_fetch_array($queryproduk);
    
    $id = $_SESSION["id_user"];
    $query = mysqli_query($conn, "SELECT * FROM multi_user WHERE id_user = $id");
    $datauser = mysqli_fetch_assoc($query);

    //kode pembelian
	if(isset($_POST['chekout'])){
    $id_user = $_POST["id_user"];
    $id_produk = $_POST["id_produk"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $jumlah = $_POST["jumlah"];
    $pengiriman = $_POST["pengiriman"];
    
    $result = mysqli_query($conn, "INSERT INTO pembelian (id_user,id_produk, nama, alamat, jumlah, jasa, status) VALUES ('$id_user','$id_produk','$nama', '$alamat', '$jumlah', '$pengiriman', 0)");
  
    if($result){
      header("Location: list.php?q="."$id");
    }
    else{
      echo(mysqli_error($conn));
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Pembelian</title>
</head>
<body>
    <?php require "navbar.php"; ?>
    <div class="container">
        <div class="card my-3">
        <div class="card-header">Form Pembelian</div>
        <div class="card-body">
          <img src="../img/<?php  echo $produk['foto'];?>" alt="" width="20%">
          <h4><?php echo $produk['nama_produk'];?></h4>
          <p><?php  echo $produk['detail'];?></p>
          <p><?= "Rp " . number_format($produk['harga'],0,',','.'); ?></p>
          <form action="" method="post">
            <div class="col-md-4">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" value="<?php echo $datauser['nama'];?>" readonly>
            </div>
            <div class="col-md-4">
              <label>Alamat</label>
              <input type="text" name="alamat" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>jumlah Pembelian</label>
              <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label>Jasa Pengiriman</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pengiriman" value="JNE" id="jne"> <label for="jne">JNE</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pengiriman" value="J&T" id="jnt"> <label for="jnt">Sisiput</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="pengiriman" value="Sicepat" id="sicepat"> <label for="sicepat">Sicepat</label>
              </div>
              <br><br>
              <p class="fst-italic">#Bayar melalui BANK Mandiri Kode: (007-154-678-5)</p>
            </div>
            <?php
                $produk = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id");

                $id_produk = $_GET["q"];

                $nama = $_SESSION["nama"];
                $ambiliduser = mysqli_query($conn, "SELECT id_user FROM multi_user WHERE nama = '$nama'");
                $data = mysqli_fetch_assoc($ambiliduser);
              ?>
              <br>
              <input type="hidden" name="id_user" value="<?php echo $data["id_user"]; ?>">
              <input type="hidden" name="id_produk" value="<?php echo $id_produk; ?>">
              
              <button type="submit" class="btn btn-warning" name="chekout">Beli</button>
    </form>
    </div>
</body>
</html>