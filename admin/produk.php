  <?php 
  include "../config.php";

  $query = mysqli_query($conn,"SELECT * FROM produk");
  $jumlahproduk = mysqli_num_rows($query);

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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

      <!--tambah produk-->
      <div class="my-3 col-12 col-md-6">
      <h4>Tambah Produk</h4>
        <form action="" method="post" enctype="multipart/form-data">
          <div>
              <label for="nama">Produk :</label>
              <input type="text" id="nama" name="nama_produk" class="form-control">
          </div>
          <div>
            <label for="harga">Harga</label>
            <input type="number" class="form-control" name="harga">
          </div>
          <div>
            <label for="foto">Foto :</label>
            <input type="file" name="foto" id="foto" class="form-control">
          </div>
          <div>
            <label for="detail">Detail :</label>
            <textarea name="detail" id="detail" cols="30" rows="1" class="form-control"></textarea>
          </div>
          <label for="ketersedian_stok">Ketersedian Stok</label>
          <select name="ketersedian_stok" id="ketersedian_stok" class="form-control">
            <option value="tersedia">Tersedia</option>
            <option value="habis">Habis</option>
          </select>
          <div class="mt-3">
              <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
          </div>
        </form>
        <!--validasi-->
        <?php
        if(isset($_POST['simpan'])) {
            $nama_produk=htmlspecialchars($_POST['nama_produk']);
            $harga=htmlspecialchars($_POST['harga']);
            $detail=htmlspecialchars($_POST['detail']);
            $ketersedian_stok=htmlspecialchars($_POST['ketersedian_stok']);
            //setting gambar//
            $target_dir = "../img/";
            $nama_file = basename($_FILES["foto"]["name"]);
            $target_file = $target_dir . $nama_file;
            $imagefiletype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $image_size = $_FILES["foto"]["size"];

            if($nama_produk=='' || $harga==''){
              ?>
                  <div class="alert alert-warning mt-3" role="alert">
                      Harap Diisi
                    </div>
                  <?php
            }
            else{
              if($nama_file!=''){
                if($image_size > 600000){
                  ?>
                  <div class="alert alert-warning mt-3" role="alert">
                      file tidak boleh lebih dari 600 kb
                    </div>
                  <?php
                }
                else{
                    if($imagefiletype!= 'jpg' && $imagefiletype!='jpeg' && $imagefiletype!='png' && $imagefiletype!='jfif' ){
                    ?>
                  <div class="alert alert-warning mt-3" role="alert">
                      file wajib bertipe jpg,jpeg,atau png
                    </div
                  <?php
                  }
                  else{
                    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
                  }
                }
              }
              //query insert produk
              $querytambah = mysqli_query($conn,"INSERT INTO produk (nama_produk,harga,foto,detail,ketersedian_stok) Values ('$nama_produk','$harga','$target_file','$detail','$ketersedian_stok')");

              if($querytambah){
                ?>
                <div class="alert alert-success mt-3" role="alert">
                          Produk Tersimpan
                      </div>
                          
                  <meta http-equiv="refresh" content="1; url=produk.php" />
                <?php
              }
              else{
                echo(mysqli_error($conn));
              }

            }
        }
        ?>
      </div>
      <!--list produk-->
      <div class="mt-3">
        <h3>List produk</h3>

        <div class="table-responsive mt-5">
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Ketersedian</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!--menampilkan produk-->
                <?php
                  if($jumlahproduk==0){
                    ?>
                    <tr>
                      <td colspan=6 class="text-center">Data Produk Tidak Tersedia</td>
                    </tr>
                    <?php
                  }
                  else{
                    $jumlah = 1;
                    while($data = mysqli_fetch_array($query)){
                      ?>
                      <tr>
                        <td><?php echo $jumlah;?></td>
                        <td><?php echo $data['nama_produk'];?></td>
                        <td><?php echo $data['harga'];?></td>
                        <td><?php echo $data['ketersedian_stok'];?></td>
                        <td><a href="setting.php?q=<?php echo $data['id_produk'];?>"class="btn btn-info"><i>Detail</i></a></td>
                      </tr>
                      <?php
                      $jumlah++;
                    }
                  }
                ?>
            </tbody>
          </table>

        </div>
      </div>

  </body>
  </html>