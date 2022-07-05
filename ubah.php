<?php
require 'functions.php';

$id = $_GET['id'];
$b = query("SELECT * FROM buku WHERE id = $id")[0];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(ubah($_POST) > 0) {
    echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'index.php';
          </script>";
  }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Jurnaleasy | Form Tambah Data Buku</title>
  </head>
  <body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="index.php">Jurnaleasy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="tambah.php">Tambah Buku</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Konten -->
    <div class="container">
      <div class="row mt-3">
        <div class="col">
          <h2>Form Ubah Data Buku</h2>
        </div>
      </div>
      
          <div class="row">
            <div class="col-md-6">
              <form action="#" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $b['id']; ?>">
                <input type="hidden" name="gambarLama" value="<?= $b['gambar']; ?>">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $b['judul']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $b['penulis']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $b['penerbit']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $b['kategori']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="gambar" name="gambar" value="<?= $b['gambar']; ?>">  
                </div>
                <button type="submit" class="btn btn-primary">Ubah Data Buku</button>
              </form>
            </div>
          </div>
    </div>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>