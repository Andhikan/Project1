<?php 
    require "../config.php";

    if( isset($_POST["verifikasi"]) ) {
        $idpembelian = $_POST["idpembelian"];
    
        $result = mysqli_query($conn, "UPDATE pembelian SET pembelian.status = 3 WHERE idpembelian = $idpembelian");
    
        if($result) {
            header("Location: konfirmasi.php?p=Berhasil melakukan konfirmasi transaksi");
        }
    }
    
    if( isset($_POST["tolak"]) ) {
        $idpembelian = $_POST["idpembelian"];
    
        $result = mysqli_query($conn, "UPDATE pembelian SET pembelian.status = 2 WHERE idpembelian = $idpembelian");
    
        if($result) {
            header("Location: konfirmasi.php?p=Berhasil menolak transaksi");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Konfirmasi</title>
</head>
<body>
    <?php require "navbar.php";?>
    <div class="container py-4">
    <?php 
    if(isset($_GET["p"])) {
        $pesan = $_GET["p"];

        echo '<div class="alert alert-secondary alert-dismissible fade show my-3" role="alert">
        <strong>'.$pesan.'</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
  <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">List Konfirmasi</li>
      </ol>
      </nav>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
            <th>Nama Pembeli</th>
            <th>Nama Produk</th>
            <th>Jumlah dibeli</th>
            <th>Harga Produk</th>
            <th>Total</th>
            <th>Aksi</th>
            </tr>
            <?php
           $result = mysqli_query($conn, "SELECT * FROM pembelian JOIN produk ON pembelian.id_produk = produk.id_produk JOIN multi_user ON pembelian.id_user = multi_user.id_user  WHERE pembelian.status = 0");

        while($row = mysqli_fetch_assoc($result)): 
        $idpembelian = $row["idpembelian"];
        $idproduk = $row["id_produk"];
        $jumlah = $row["jumlah"];
        ?>
        <tr>
        <form action="" method="post">
            <td><?php echo $row['nama'];?></td>
            <td><?php echo $row['nama_produk'];?></td>
            <td><?php echo $row['jumlah'];?></td>
            <td><?php echo number_format($row['harga']);?></td>
            <td><?php echo number_format($row["jumlah"] * $row["harga"]);?></td>
            <td>
        <!-- <button type="submit" name="verifikasi" class="btn btn-success">Konfirmasi</button> -->
            <button type="button" class="btn btn-success my-2" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $idpembelian; ?>"><i class="bi bi-check-lg"></i></button>
            <button type="button" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#tolak<?= $idpembelian; ?>"><i class="bi bi-x"></i></button>
            </td>
        </form>
        </tr>

        <!-- modal konfirmasi -->
        <div class="modal fade" id="konfirmasi<?= $idpembelian; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Transaksi</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                  <p>Apakah ingin mengkonfirmasi transaksi ini?</p>
                  <input type="hidden" name="idpembelian" value="<?= $idpembelian; ?>">
                  <button type="submit" name="verifikasi" class="btn btn-success">Konfirmasi</button>
              </form>
            </div>
          </div>
        </div>
      </div>

        <!-- modal tolak -->
        <div class="modal fade" id="tolak<?= $idpembelian; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tolak Konfirmasi</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" method="post">
                  <p>Apakah yakin ingin menolak transaksi ini?</p>
                  <input type="hidden" name="idproduk" value="<?= $idproduk; ?>">
                  <input type="hidden" name="idpembelian" value="<?= $idpembelian; ?>">
                  <button type="submit" class="btn btn-danger" name="tolak">Tolak</button>
              </form>
            </div>
          </div>
        </div>
      </div>
        <?php endwhile; ?>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>