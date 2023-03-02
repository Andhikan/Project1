<?php 
require "../config.php";
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

    $queryproduk = mysqli_query($conn, "SELECT * FROM produk");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Produk</title>
</head>
<body>
    <?php require "navbar.php";?>
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Produk</li>
    </ol>
    </nav>
    <div class="container py-1">
        <div class="row">
                <div class="col">
                    <div class="row">
                        <?php while($produk = mysqli_fetch_array($queryproduk)){ ?>
                        <div class="col-sm-5 col-md-3 mb-2">
                            <div class="card h-100" style="width: 17rem;">
                                    <img src="../img/<?php echo $produk['foto']; ?>" alt=""  class="card-img-top" width="100%" height="150px">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $produk['nama_produk']; ?></h4></h4>
                                    <p class="card-text"><?php echo $produk['detail'] ?></p>
                                    <p class="card-text"><?= "Rp " . number_format($produk['harga'],0,',','.'); ?></p>
                                    <p class="card-text">Stok: <?php echo $produk['ketersedian_stok'];?></p>
                                    <?php if($produk["ketersedian_stok"] == "tersedia"): ?>
                                    <a  class="btn btn-warning" href="pembelian.php?q=<?php echo $produk['id_produk'];?>">Beli</a>
                                    <?php elseif($produk["ketersedian_stok"] == "habis"): ?>
                                    <a  class="btn btn-danger">Sold out</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>