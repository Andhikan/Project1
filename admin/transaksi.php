<?php 
//koneksi ke db
require "../config.php";

session_start();

// koenksi ke navbar
require "navbar.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
</head>
<body>
    
<div class="container mt-3">
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
      </ol>
      </nav>
    <h3 class="text-center my-3"> DAFTAR TRANSAKSI </h3>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th> Nama Pembeli </th>
                    <th> Nama Barang </th>
                    <th> Jumlah Beli </th>
                    <th> Total </th>
                    <th> Status </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM pembelian INNER JOIN produk ON pembelian.id_produk = produk.id_produk");

                while ($data = mysqli_fetch_assoc($result)) :
                    $status = $data["status"];
            $statustext = "";
                if($status == 1 || $status == 0) {
            $statustext = "Belum di Konfirmasi";
            } else if($status == 2  || $status == 3){
            $statustext = "Sudah di Konfirmasi <br> Di Tanggal :";
            }
                ?>
                    <tr>
                        <td><?= $data["nama"] ?></td>
                        <td><?= $data["nama_produk"] ?></td>
                        <td><?= $data["jumlah"] ?></td>
                        <td>RP.<?= number_format($data["jumlah"] * $data["harga"]);?></td>
                        <?php if( $statustext == "Belum di Konfirmasi" ) : ?>
                            <td><b><?= $statustext?></b></td>
                        <?php elseif($statustext == "Sudah di Konfirmasi <br> Di Tanggal :") : ?>
                            <td><?= $statustext; echo date("d-m-y"); ?></b></td>
                        <?php endif; ?>
                    </tr>
                    <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>





</body>
</html>