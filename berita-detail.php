<?php
require "koneksi.php";
include 'adminpanel/config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:adminpanel/login_form.php');
}

$queryBerita = mysqli_query($conn, "SELECT * FROM berita");

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<title>Desa Karangpakel | Berita</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style1.css" type="text/css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="css1/style1.css">
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="lib/owl.carousel.min.css">
<link rel="stylesheet" href="lib/owl.theme.default.min.css">
<link rel="icon" href="images/fav.ico">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
<link rel="stylesheet" href="lib/animate.css">
<!--[if IE 6]><script src="scripts/suckerfish.js" type="text/javascript"></script><link href="ie6.css" type="text/css" rel="stylesheet" media="screen" /><![endif]-->
<!--[if IE 7]><style>ul#menu li li li {padding-left:0;}</style><![endif]-->
<!--[if IE]><style>#searchform input#searchsubmit {height:24px;}#feeds p { padding-top:1px;}</style><![endif]-->
</head>
<style>
    html{
        scroll-behavior: smooth;
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
  <header class="newspol" id="home">
    <div class="container-fluid header-content">
      <div class="row">
        <div class="col">
          <div class="content-box text-center animated fadeInUp">
            <h1 class="text-white">Berita<span class="element" style="color:#EE8683;font-weight:bold;">Terkini</span></h1>
            <a href="#content" class="btn">Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </header>
<div id="wrapper">
  <!-- /nav -->
  <div id="content">
    <div id="center">
      <div id="headline">
        <h3>Berita</h3>
        <?php while($berita = mysqli_fetch_array($queryBerita)){ ?>
        <div>
        <h2><?php echo $berita['judul']; ?></h2>
        <h3><?php echo $berita['kategori']; ?> | <a href="https://www.detik.com/">SOURCE:DETIK.COM</a></h3>
        <p class="postmeta" style="margin-bottom:2px;"><?php echo $berita['waktu']; ?> </p>
        <div class="the_content">
          <p><?php echo $berita['konten'];  ?></p>
        </div>
        </div>
        <?php } ?>
      </div>
      </div>
    </div>
    <!-- /sidebar -->
    <div id="footer">
    </div>
  </div>
</div>
<!-- /wrapper -->
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
</body>
</html>
