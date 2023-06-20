<?php
require "koneksi.php";

session_start();
if(!isset($_SESSION['user_name'])){
   header('location:adminpanel/login_form.php');
}

echo "<script type='text/javascript'>alert('Selamat anda mendapatkan diskon 30%');</script>";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

if(isset($_GET['keyword'])){
    $queryProduk = mysqli_query($conn, "SELECT *FROM produk WHERE nama LIKE '%$_GET[keyword]%'");
}else if(isset($_GET['kategori'])){
    $queryKategoriId = mysqli_query($conn, "SELECT id FROM kategori WHERE nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array($queryKategoriId);

    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$kategoriId[id]'");
}else{
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

$countdata = mysqli_num_rows($queryProduk);

$query = mysqli_query($conn, 'SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id');
$jumlahProduk = mysqli_num_rows($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Karangpakel | Produk</title>
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
                <button type="submit" class="btn btn-secondary">Cari</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Banner Selesai-->

  <!-- Body -->

  <div class="container py-5">
    <div class="row">
        <div class="col-lg-3 mb-5">
            <h3>Kategori</h3>
            <ul class="list-group">
                <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                <a class="text-decoration-none" href="produk.php?kategori=<?php echo $kategori['nama']; ?>">
                <li class="list-group-item"><?php echo $kategori['nama']; ?></li>
                </a>
                <?php } ?>
            </ul>
        </div>
        <div class="col-lg-9">
            <h3 class="text-center mb-3">Produk</h3>
            <div class="row">


            <?php
            if($countdata<1){
                ?>
                <h4 class="text-center my-5">Produk yang anda cari tidak tersedia</h4>
                <?php
            }
            ?>
            
                <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="image-box">
                            <img src="image/<?php echo $produk['foto']; ?>" class="card-img-top">
                        </div>
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $produk['nama']; ?></h4>
                            <p class="card-text text-truncate"><?php echo $produk['detail']; ?></p>
                            <p class="card-text text-harga">Rp. <?php echo $produk['harga']-$produk['harga']*30/100; ?> </p>
                            <a href="promo-detail.php?nama=<?php echo $produk['nama']; ?>" class="btn btn-secondary">Beli</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
  </div>

  <!-- Body -->

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