<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active me-4" href="produk.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-4" href="konfirmasi.php">Konfirmasi pembayaran</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active me-4" href="transaksi.php">Daftar transaksi</a>
      </ul>
    </div>
  </div>
  <div class="navbar-button">
      <a href="../logout.php">
        <button class="btn btn-danger " type="submit" name="logut"> Logout </button>
      </a>
    </div>
</nav>
</body>
</html>