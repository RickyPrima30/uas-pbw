<?php
require "koneksi.php";
session_start();
if(!isset($_SESSION['user_name'])){
   header('location:adminpanel/login_form.php');
}
$queryProduk = mysqli_query($conn, "SELECT id, nama, harga, foto, detail FROM produk LIMIT 6");
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desa Karangpakel | UMKM</title>
    <link rel="stylesheet" href="css1/style.css">
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="lib/owl.carousel.min.css">
    <link rel="stylesheet" href="lib/owl.theme.default.min.css">
    <link rel="icon" href="images/fav.ico">
    <link rel="stylesheet" href="emosi.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
    <link rel="stylesheet" href="lib/animate.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>


  <style>
.text-harga{
    font-size: 22px;
    color: #1a0000;
}
  </style>

  <body>
    <nav class="navbar navbar-expand-md navbar-primary  sticky  fixed-top r-nav">
    <div class="container">

      <a class="navbar-brand animated fadeInLeft" href="#">Desa Karangpakel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarId" >
        <span><i class="fas fa-bars hamburger"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarId">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="index.php">Beranda <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="#about">Tentang</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="berita.php">Berita</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="umkm.php">Pesan</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="adminpanel/logout.php"><b><?php echo $_SESSION['user_name'] ?></b> |  Log out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>



  <!-- Banner Mulai-->
  <header style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('images/banner.jpg');" id="home">
    <div class="container-fluid header-content">
      <div class="row">
        <div class="col">
          <div class="content-box text-center animated fadeInUp">
            <h1><b>Pemesanan UMKM</b></h1>
            <h3>Mau cari Apa?</h3>
            <form method="GET" action="produk.php">
            <div class="input-group input-group-lg my-4">
                <input type="text" class="form-control" name="keyword" placeholder="Nama Produk">
            </div>
            <div class="my-4">
                <button type="submit" class="btn btn-secondary text-white">Cari</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Banner Selesai-->

  <!-- Kategori Mulai -->
  <div class="container-fluid py-5">
    <div class="container text-center">
        <h1>Rekomendasi Kategori</h1>

        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="highlighted-kategori kategori-makanan-berat d-flex justify-content-center align-items-center" style="overflow: hidden;">
                <h4 class="fs-2 fw-bold" style="position: absolute; -webkit-text-stroke: 1px #1a0000; color: white;"><a style="text-decoration: none;" href="adminpanel/produk.php?kategori=Makanan%20Berat">Makanan Berat</a></h4>
                <img src="image/8ZAZixiqKQfI2Ms4WQX5.jpeg" style="background : linear-gradient(rgba(0,0,0,0.4)), (rgba(0,0,0,0.4)); width:100%;">
            </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="highlighted-kategori kategori-makanan-ringan d-flex justify-content-center align-items-center"style="overflow: hidden;">
                <h4 class="fs-2 fw-bold" style="position: absolute; -webkit-text-stroke: 1px #1a0000; color: white; "><a style="text-decoration: none;" href="adminpanel/produk.php?kategori=Makanan%20Ringan">Makanan Ringan</a></h4>
                <img src="image/jCKl9xDHN6kF3pdfbdKl.jpg" style="background : linear-gradient(rgba(0,0,0,0.4)), (rgba(0,0,0,0.4)); width:100%;">
            </div>
            </div>
            <div class="col-md-4">
                <div class="highlighted-kategori kategori-minuman d-flex justify-content-center align-items-center" style="overflow: hidden;">
                <h4 class="fs-2 fw-bold" style="position: absolute; -webkit-text-stroke: 1px #1a0000; color: white; "><a style="text-decoration: none;" href="adminpanel/produk.php?kategori=Minuman">Minuman</a></h4>
                <img src="image/qEzsMyGeJxbaLQoj6P3U.jpg" style=" background : linear-gradient(rgba(0,0,0,0.4)), (rgba(0,0,0,0.4)); width:100%;">
            </div>
            </div>
        </div>
    </div>
  </div>
  
  <!-- Kategori Selesai -->


  <!-- Pembatas -->

  <div style="background-color: darkgrey;" class="container-fluid py-5">
    <div class="container text-center">
      <h3></h3>
      <p></p>
    </div>
  </div>

  <!-- Produk -->
 <section>
  <div class="row ">

  <div class="container-fluid py-5">
    <div class="container text-center">
      <h1>Produk</h1>

      <div class="row mt-5">
        <?php while($data = mysqli_fetch_array($queryProduk)){
        ?>
        <div class="col-sm-6 col-md-4 mb-3">
          <div class="card h-100">
            <div class="image-box">
            <img src="image/<?php echo $data['foto']; ?>" class="card-img-top" alt="">
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo $data['nama']; ?></h5>
              <p class="card-text text-truncate"><?php echo $data['detail']; ?></p>
              <p class="card-text text-harga">Rp. <?php echo $data['harga'] ?></p>
              <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>" class="btn btn-secondary">Lihat Detail </a>
            </div>
          
          </div>
        </div>
        <?php } ?>
      </div>

      <div class=>
        <a href="produk.php" class="btn btn-outline-secondary mt-3 p-3">Lihat Lain</a>
      </div>

    </div>
  </div>



  </section>
    <!-- footer -->
  <footer>
    <div class="container h-100 d-flex align-items-center justify-content-center">
      <div class="row">
        <div class="col">
          <div class="r-icon text-center mt-3">
            <ul>
              <li class="list-inline-item animated slideInUp"><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
              <li class="list-inline-item animated slideInUp"><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
              <li class="list-inline-item animated slideInUp"><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>
          <p style="font-size:14px;">&copy; Copyright Ricky Primayuda Putra | 2023 All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>

    <script src="lib/jquery-3.3.1.min.js"></script>
    <script src="lib/popper.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/jquery.smooth-scroll.js"></script>
    <script src="lib/imagesloaded.pkgd.min.js"></script>
    <script src="lib/owl.carousel.min.js"></script>
    <script src="lib/typed.js"></script>
    <script src="lib/jquery.waypoints.min.js"></script>
    <script src="lib/jquery.filterizr.min.js"></script>
    <script src="js1/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>