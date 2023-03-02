  <?php
  require "../config.php";
  $id = $_GET['q'];

  $query = mysqli_query($conn,"SELECT * FROM produk WHere id_produk='$id'");
  $data  = mysqli_fetch_array($query);

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
      <title>Produk detail</title>
  </head>
  <body>
  <?php require "navbar.php";?>
      <div class="container mt-4">
          <h3>Detail Produk</h3>
          <div class="col-12 col-md-6">
          <form action="" method="post" enctype="multipart/form-data">
      <div
          <label for="nama">Nama :</label>
          <input type="text" name="nama_produk" id="nama" class="form-control" value="<?php echo $data['nama_produk'];?>">
      </div>
          <div>
            <label for="harga">Harga</label>
            <input type="number" class="form-control" value="<?php echo $data['harga'];?>"name="harga">
          </div>
          <div>
              <label for="currentfoto">Foto Produk</label>
              <img src="../img/<?php echo $data['foto']; ?>" alt="" width="350px">
          </div>
          <div>
            <label for="foto">Foto :</label>
            <input type="file" name="foto" id="foto" class="form-control">
          </div>
            <div>
            <label for="detail">Detail :</label>
            <textarea name="detail" id="detail" cols="30" rows="1" class="form-control"><?php echo $data['detail'];?></textarea>
          </div>
          <label for="ketersedian_stok">Ketersedian Stok</label>
          <select name="ketersedian_stok" id="ketersedian_stok" class="form-control">
            <option value="tersedia <?php echo $data['ketersedian_stok'] ?>"><?php echo $data['ketersedian_stok']; ?></option>
            <?php
              if ($data['ketersedian_stok']=='tersedia') {
                ?>
                <option value="habis">Habis</option>
                <?php
              } 
              else{
                ?>
                <option value="tersedia">tersedia</option>
                <?php
              }
            ?>
          </select>
          <div class="mt-3">
              <button class="btn btn-primary" type="submit" name="edit"><i class="bi bi-pen"></i></button>
              <button class="btn btn-danger" type ="submit" name="hapus"><i class="bi bi-trash3"></i></button>
          </div>
          </form>
          <?php 
            if(isset($_POST['edit'])) {
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
              $queryedit=mysqli_query($conn, "UPDATE produk SET nama_produk='$nama_produk',harga='$harga',detail='$detail',ketersedian_stok='$ketersedian_stok' WHERE id_produk=$id");
              if($queryedit){
                    ?>
                      <div class="alert alert-success mt-3" role="alert">
                                Produk berhasil diedit
                    </div>
                                
                        <meta http-equiv="refresh" content="1; url=produk.php" />
                      <?php
                    }
              //cek update foto//
              if($nama_file!='') {
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

                    $queryedit=mysqli_query($conn,"UPDATE produk SET foto='$target_file' WHERE id_produk='$id'");

                    if($queryedit){
                      ?>
                    <div class="alert alert-success mt-3" role="alert">
                    Produk berhasil diedit
                    </div>
                    <meta http-equiv="refresh" content="1; url=produk.php" />
                      <?php
                    }
                    else{
                      echo(mysqli_error($conn));
                    }
                  }
                }
              }
            }
            }
            //hapus produk//
            if(isset($_POST['hapus'])) {
              $queryhapus= mysqli_query($conn,"DELETE FROM produk WHERE id_produk='$id'");

              if($queryhapus){
                ?>
                      <div class="alert alert-success mt-3" role="alert">
                                Produk berhasil Dihapus
                    </div>
                                
                        <meta http-equiv="refresh" content="1; url=produk.php" />
                      <?php
              }
            }
          ?>
          </div>
          </div>
          
  </body>
  </html>