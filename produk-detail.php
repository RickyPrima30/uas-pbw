<?php
require "koneksi.php";
session_start();
if(!isset($_SESSION['user_name'])){
   header('location:adminpanel/login_form.php');
}
$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Karangpakel | Beli</title>
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
  .popup{
    width: 400px;
    background: #fff;
    border-radius: 6px;
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, -50%)scale(0.1);
    text-align: center;
    padding: 0 30px 30px;
    color: #333;
    visibility: hidden;
    transition: transform 0.4s, top 0.4s;
}

.open-popup {
    visibility: visible;
    top: 50%;
    transform: translate(-50%,-50%)scale(1);
}

.popup img{
    width: 100px;
    margin-top: -50px;
    border-radius: 50%;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.popup h2{
    font-size: 38px;
    font-weight: 500;
    margin: 30px 0 10px;
}

.popup button{
    width: 100%;
    margin-top: 50px;
    padding: 10px 0;
    background: #6fd649;
    color: #fff;
    border: 0;
    outline: none;
    font-size: 18px;
    border-radius: 4px;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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

  <section class="experience">
  <div class="container-fluid mt-3 py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="image/<?php echo $produk['foto']; ?>" class="w-100">
            </div>
            <div class="col-md-6 offset-md-1">
                <h1><?php echo $produk['nama']; ?></h1>
                <p>
                    <?php echo $produk['detail']; ?>
                </p>
                <p class="fs-3 text-secondary">
                    Rp. <b><?php echo $produk['harga']; ?></b>
                </p>
                <p class="fs-5">
                    Status Ketersediaan : <b><?php echo $produk['ketersediaan_stok']; ?></b>
                </p>
                <form method="POST" action="belanja.php">
                  <input type="hidden" name="idbeli" value="<?php echo $produk['id']; ?>">
                  <input type="hidden" name="username" value="<?php echo $_SESSION['user_name']; ?>">
                <input type="button" onclick="openPopup()" class="btn btn-success" value="Beli">
                </form>
            </div>
        </div>
    </div>
  </div>
  </section>
  <div style="z-index: 10;" class="popup" id="popup">
            <img src="image/404-tick.png">
            <h2>Terima Kasih</h2>
            <br>
            <p>Produk yang anda beli <?php echo $produk['nama']; ?></p>
            <br>
            <p>dan Terima Kasih Sudah berbelanja di UMKM Desa Karangpakel</p>
            <button type="button" onclick="closePopup()">Lanjut Berbelanja?</button>
        </div>
<script>

        let popup = document.getElementById("popup");

        document.querySelector('form').addEventListener('submit',(i)=>{
          i.preventDefault();
        });

        function openPopup(){
            popup.classList.add("open-popup")
        }
        async function closePopup(){
            popup.classList.remove("open-popup")
            
            document.querySelector('form').submit()
        }

    </script>
  <!-- Produk Terkait -->

  <div class="container-fluid py-5" style="background-color: darkgray;">
    <div class="container">
        <h2 class="text-center text-white mb-4">Produk terkait</h2>

        <div class="row">
            <?php while ($data = mysqli_fetch_array($queryProdukTerkait)){ ?>
            <div class="col-md-6 mb-3 col-lg-3">
                <a href="produk-detail.php?nama=<?php echo $data['nama']; ?>">
                <img src="image/<?php echo $data['foto']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: center;" class="img-fluid img-thumbnail produk-terkait-image">
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
  </div>

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