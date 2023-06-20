<?php
require "../koneksi.php";
include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

$queryBerita = mysqli_query($conn, "SELECT * FROM berita");
$jumlahBerita = mysqli_num_rows($queryBerita);

$queryKelola = mysqli_query($conn, "SELECT * FROM user_form");
$jumlahKelola = mysqli_num_rows($queryKelola);

$queryVideo = mysqli_query($conn, "SELECT * FROM video");
$jumlahVideo = mysqli_num_rows($queryVideo);

$queryPesanan = mysqli_query($conn, "SELECT * FROM transaksi");
$jumlahPesanan = mysqli_num_rows($queryPesanan);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../css1/style.css">
  <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../lib/owl.carousel.min.css">
  <link rel="stylesheet" href="../lib/owl.theme.default.min.css">
  <link rel="icon" href="../images/fav.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
  <link rel="stylesheet" href="lib/animate.css">
  <title>Dashboard</title>
</head>
<style>

.kotak{
  border: solid;
}
.summary-kategori{
  background-color: #0a6b4a;
  border-radius: 15px;
}
.summary-produk{
  background-color: #0a516b;
  border-radius: 15px;
}
.summary-terjual{
  background-color: tomato;
  border-radius: 15px;
}
.summary-Berita{
  background-color: tomato;
  border-radius: 15px;
}
.summary-komentar{
  background-color: blueviolet;
  border-radius: 15px;
}
.summary-pesanan{
  background-color: darkcyan;
  border-radius: 15px;
}
body{
  overflow-x: hidden;
}

</style>
<body>
  <div class="preloader">
    <div class="circle"></div>
  </div>

  <nav class="navbar navbar-expand-md  sticky  fixed-top r-nav">
    <div class="container">

      <a class="navbar-brand animated fadeInLeft" href="#">Desa Karangpakel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarId" >
        <span><i class="fas fa-bars hamburger"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarId">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="#home">Beranda <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="kategori.php">Kategori</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="produk.php">Produk</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="berita.php">Berita</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="pesanan.php">Pesanan</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="video.php">Video</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="kelola.php">Kelola</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="logout.php"><?php echo $_SESSION['admin_name'] ?> | Log out</a>
          </li>
        </ul>
      </div>
    </div>

  </nav>

  <header id="home">
    <div class="container-fluid header-content">
      <div class="row">
        <div class="col">
          <div class="content-box text-center animated fadeInUp">
            <h4>SELAMAT DATANG <?php echo $_SESSION['admin_name'] ?></h4>
            <h1>Di Dashboard Website <span class="element" style="color:#EE8683;font-weight:bold;">desa Karangpakel</span></h1>
            <p>Website desa Karangpakel untuk memudahkan warga desa dan pendatang untuk dapat membeli makanan, minuman bahkan Souvenir</p>
            <a href="#about" class="btn">Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="fas fa-home"></i>Home
                </li>
            </ol>
        </nav>
    </div>
  </div>

 <section class="about r-p" id="umkm">
  <div class="row" style="justify-content: space-evenly;">

  <div class="col-lg-4">
  <div class="container mt-3 text-center">
        <div class="summary-kategori p-3">
        <div class="row">
          <div class="col-6">
            <i class="fas fa-align-justify fa-7x text-black-50"></i>
          </div>
          <div class="col-6 text-white">
            <h3 class="fs-2">Kategori</h3>
            <p class="fs-4"><?php echo $jumlahKategori; ?> Kategori</p>
            <p><a href="kategori.php" class="text-white">Lihat Detail</a></p>
          </div>
          </div>
        </div>
  </div>
  </div>

  <div class="col-lg-4">
  <div class="container mt-3 text-center">
        <div class="summary-produk p-3">
        <div class="row">
          <div class="col-6">
            <i class="fas fa-align-justify fa-7x text-black-50"></i>
          </div>
          <div class="col-6 text-white">
            <h3 class="fs-2">Produk</h3>
            <p class="fs-4"><?php echo $jumlahProduk; ?> Produk</p>
            <p><a href="produk.php" class="text-white">Lihat Detail</a></p>
          </div>
          </div>
    </div>
  </div>
  </div>

  <div class="col-lg-4">
  <div class="container mt-3 text-center">
        <div class="summary-Berita p-3">
        <div class="row">
          <div class="col-6">
            <i class="fas fa-align-justify fa-7x text-black-50"></i>
          </div>
          <div class="col-6 text-white">
            <h3 class="fs-2">Berita</h3>
            <p class="fs-4"><?php echo $jumlahBerita; ?> Berita</p>
            <p><a href="berita.php" class="text-white">Lihat Detail</a></p>
          </div>
          </div>
    </div>
  </div>
  </div>

  <div class="col-lg-4">
  <div class="container mt-3 text-center">
        <div class="summary-komentar p-3">
        <div class="row">
          <div class="col-6">
            <i class="fas fa-align-justify fa-7x text-black-50"></i>
          </div>
          <div class="col-6 text-white">
            <h3 class="fs-2">Pesanan</h3>
            <p class="fs-4"><?php echo $jumlahPesanan; ?> pesanan</p>
            <p><a href="pesanan.php" class="text-white">Lihat Detail</a></p>
          </div>
          </div>
    </div>
  </div>
  </div>

  <div class="col-lg-4">
  <div class="container mt-3 text-center">
        <div class="summary-pesanan p-3">
        <div class="row">
          <div class="col-6">
            <i class="fas fa-align-justify fa-7x text-black-50"></i>
          </div>
          <div class="col-6 text-white">
            <h3 class="fs-2">Video</h3>
            <p class="fs-4"><?php echo $jumlahVideo; ?> Video</p>
            <p><a href="video.php" class="text-white">Lihat Detail</a></p>
          </div>
          </div>
    </div>
  </div>

  </div>
  <div class="col-lg-4">
  <div class="container mt-3 text-center">
        <div class="summary-pesanan p-3">
        <div class="row">
          <div class="col-6">
            <i class="fas fa-align-justify fa-7x text-black-50"></i>
          </div>
          <div class="col-6 text-white">
            <h3 class="fs-2">Kelola Akun</h3>
            <p class="fs-4"><?php echo $jumlahKelola; ?> Akun</p>
            <p><a href="kelola.php" class="text-white">Lihat Detail</a></p>
          </div>
          </div>
    </div>
  </div>
  </div>

  </div>
 </section>


  <!--  Work -->
  <section class="work  r-p" id="work">
    <div class="container text-center">
      <div class="row">
        <div class="col  mb-5 way-fade-left">
          <!-- <h2>Work</h2>
          <p>What i have created.</p> -->
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 mx-auto mb-5 way-fade-left">
          <!-- <button class="btn r-btn" data-filter="all">All</button>
          <button class ="btn r-btn" data-filter="1">Web</button>
          <button class ="btn r-btn" data-filter="2">SEO</button>
          <button class ="btn r-btn" data-filter="3">Graphics</button>
          <button class ="btn r-btn" data-filter="4">Apps</button> -->
        </div>
      </div>
      <div class="container ">
        <div class="row filter-container mx-auto img-loaded">

          <div class="col-xs-6 col-sm-4 col-md-4 filtr-item card-wrapper " data-category="1,2">
            <div>
              <!-- <img src="images/w1.jpg" class="img-fluid" alt="" > -->
            </div>
          </div>

          <div class="col-xs-6 col-sm-4 col-md-4 filtr-item card-wrapper " data-category="4,2">
            <div>
              <!-- <img src="images/w2.jpg" class="img-fluid" alt="" > -->
            </div>
          </div>

          <div class="col-xs-6 col-sm-4 col-md-4 filtr-item card-wrapper " data-category="1,4,2">
            <div>
              <!-- <img src="images/w8.jpg" class="img-fluid" alt="" > -->
            </div>
          </div>

          <div class="col-xs-6 col-sm-4 col-md-4 filtr-item card-wrapper " data-category="4,3,2">
            <div>
              <!-- <img src="images/w6.jpg" class="img-fluid" alt="" > -->
            </div>
          </div>

          <div class="col-xs-6 col-sm-4 col-md-4 filtr-item card-wrapper " data-category="4,3,2">
            <div>
              <!-- <img src="images/w5.jpg" class="img-fluid" alt="" > -->
            </div>
          </div>
          <div class="col-xs-6 col-sm-4 col-md-4 filtr-item card-wrapper " data-category="4,3,2">
            <div>
              <!-- <img src="images/w7.jpg" class="img-fluid" alt="" > -->
            </div>
          </div>

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
          <p class="text-muted" style="font-size:14px;">&copy; Copyright Ricky Primayuda Putra | 2023 All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>




  <script src="../lib/jquery-3.3.1.min.js"></script>
  <script src="../lib/popper.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../lib/jquery.smooth-scroll.js"></script>
  <script src="../lib/imagesloaded.pkgd.min.js"></script>
  <script src="../lib/owl.carousel.min.js"></script>
  <script src="../lib/typed.js"></script>
  <script src="../lib/jquery.waypoints.min.js"></script>
  <script src="../lib/jquery.filterizr.min.js"></script>
  <script src="../js1/app.js"></script>
</body>
</html>
