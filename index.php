<?php
require 'functions.php';
$buku = query("SELECT * FROM buku");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Jurnaleasy | Katalog Buku</title>
  </head>
  <body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#">Jurnaleasy</a>
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
          <h2>Daftar Buku</h2>
        </div>
      </div>
      
      <div class="row">
        <?php foreach($buku as $b) : ?>
          <div class="col-md-4 col-sm-6">
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-4">
                  <img src="img/<?= $b["gambar"]; ?>" class="img-fluid rounded-start" alt="<?= $b["judul"]; ?>">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <span class="position-absolute top-0 end-0 px-2 py-1 bg-dark text-white opacity-75"><small><?= $b["kategori"]; ?></small></span>
                    <h5 class="card-title"><?= $b["judul"]; ?></h5>
                    <p class="card-text"><small class="text-muted"><?= $b["penulis"]; ?> | <?= $b["penerbit"]; ?></small></p>

                    <a href="ubah.php?id=<?= $b['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $b['id']; ?>" class="btn btn-danger btn-sm"
                    onclick="return confirm('Yakin?')">Hapus</a>
                  </div>
                </div>          
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>