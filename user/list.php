<?php
session_start(); 
  require "../config.php";
  $id_user = $_SESSION["id_user"];
  $nama = $_SESSION["nama"];

  $querypembelian = mysqli_query($conn,"SELECT * FROM pembelian");
  $pembelian = mysqli_fetch_array($querypembelian);

  $result = mysqli_query($conn, "SELECT * FROM pembelian INNER JOIN produk ON pembelian.id_produk = produk.id_produk WHERE id_user = '$id_user' ORDER BY idpembelian DESC");
  
  $result2 = mysqli_query($conn, "SELECT * FROM pembelian INNER JOIN produk ON pembelian.id_produk = produk.id_produk WHERE pembelian.id_produk = produk.id_produk");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List pembelian</title>
</head>
<body>
    <?php require "navbar.php"; ?>
  <div class="container py-4">
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">List Pembelian</li>
      </ol>
      </nav>

    <div class="table-responsive">
      <table class="table table-bordered">
        <tr>
          <th>Nama</th>
          <th>Produk</th>
          <th>Harga Produk</th>
          <th>Jumlah Beli</th>
          <th>Pengiriman</th>
          <th>Total</th>
          <th>Status</th>
        </tr>
        <?php while($pembelian = mysqli_fetch_assoc($result)): 
          $status = $pembelian["status"];
          $statustext = "";
          if($status == 1 || $status == 0) {
            $statustext = "Belum di Konfirmasi";
          } else if($status == 2){
            $statustext = "Konfirmasi di Tolak";
          } else{
            $statustext = "Sudah di Konfirmasi";
          }
        ?>
        <tr>
          <td><?php echo $pembelian["nama"]; ?></td>
          <td><?php echo $pembelian["nama_produk"]; ?></td>
          <td><?php echo number_format($pembelian["harga"]);?></td>
          <td><?php echo $pembelian["jumlah"]; ?></td>
          <td><?php echo $pembelian["jasa"];?></td>
          <td><?php echo number_format($pembelian["jumlah"] * $pembelian["harga"]);?></td>
          <td><?php echo $statustext ?></td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
</body>
</html>