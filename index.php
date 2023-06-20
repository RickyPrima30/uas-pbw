<?php
require "koneksi.php";
include 'adminpanel/config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:adminpanel/login_form.php');
}


$queryAmbil = mysqli_query($conn, "SELECT * FROM transaksi WHERE nama='".$_SESSION['user_name']."'");
$queryProduk = mysqli_query($conn, "SELECT id,nama FROM produk")->fetch_all(MYSQLI_NUM);
$queryKomentar = mysqli_query($conn, "SELECT * FROM komentar");
$queryHistory = mysqli_fetch_all($queryAmbil ,MYSQLI_ASSOC);
$jumlahHis = count($queryHistory);

function GETnama($id)
{
  global $queryProduk;
  foreach ($queryProduk as $value) {
    if($value[0]==$id){
      return $value[1];
    }
  }
}

$query = mysqli_query($conn, 'SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id');


$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

$queryVideo = mysqli_query($conn, "SELECT * FROM video LIMIT 4");

$queryBerita = mysqli_query($conn, "SELECT * FROM berita LIMIT 6");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css1/style.css">
  <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="lib/owl.carousel.min.css">
  <link rel="stylesheet" href="lib/owl.theme.default.min.css">
  <link rel="icon" href="images/fav.ico">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
  <link rel="stylesheet" href="lib/animate.css">
  <title>Desa Karangpakel | HOME</title>
</head>
<body>
  <!-- <div class="preloader">
    <div class="circle"></div>
  </div> -->

  <nav class="navbar navbar-expand-md  sticky  fixed-top r-nav">
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
            <a class="nav-link" href="promo.php">Promo</a>
          </li>
          <li class="nav-item animated fadeInRight">
            <a class="nav-link" href="#services">Berita</a>
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

  <header class="indexban" id="home">
    <div class="container-fluid header-content">
      <div class="row">
        <div class="col">
          <div class="content-box text-center animated fadeInUp">
            <h4>SELAMAT DATANG <b></b><?php echo $_SESSION['user_name'] ?></b></h4>
            <h1>Di website <span class="element" style="color:#EE8683;font-weight:bold;">desa Karangpakel</span></h1>
            <p>Website desa Karangpakel untuk memudahkan warga desa dan pendatang untuk dapat membeli makanan, minuman bahkan Souvenir</p>
            <a href="#about" class="btn">Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- History -->
  <section class="services bg-sec r-p " id="">
    <div class="container text-center">
    <h2>History Pembelian anda</h2>


    <div class="table-responsive mt-5">
      <table class="table">
          <thead>
            <tr>
                <th>No.</th>
                <th>Produk</th>
                <th>Waktu Pembelian</th>
            </tr>
        </thead>
        <tbody>
          <?php
              if($jumlahHis==0){
                  ?>
                  <tr>
                      <td colspan="3" class="text-center">History Pembelian Kosong</td>
                  </tr>
                  <?php
                  
              }else{
                            $jumlah = 0;
                           foreach($queryHistory as $data){
                            // while($data=mysqli_fetch_array($queryAmbil)){
                                $jumlah++;
                                ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo GETnama($data['id_produk']); ?></td>
                                    <td><?php echo $data['tanggal']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- About Section -->
  <section class="about r-p" id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 way-fade-up">
          <img src="images/map.png" title="https://www.google.com/url?sa=i&url=https%3A%2F%2Ftrucuk.klaten.go.id%2Fcompro%2Fpersiapan-penyambutan-atlet-pencak-silat-asal-desa-karangpakel-kecamatan-trucuk-yang-berlaga-sea-games-2021-di-vietnam&psig=AOvVaw3kwO-WqNSZwK-LmOxi0EaO&ust=1672043346350000&source=images&cd=vfe&ved=0CA0QjRxqFwoTCIjmgYGtlPwCFQAAAAAdAAAAABAD" class="img-fluid img-thumbnail" alt="Profile Picture">
        </div>
        <div class="col-lg-6 way-fade-up mt-5 mt-lg-0">
          <h2 class="">Tentang</h2>
          <h4 class="">Desa <span style="color:#E96F85;">Karangpakel</span></h4>

          <p>Desa Karangpakel adalah desa di Kecamatan Trucuk, Klaten, Jawa Tengah, Indonesia. Secara Geografis desa Karangpakel terletak pada 110 63' 23" Bujur Timur dan 70' 73" Lintang Selatan. Berbatasan dengan desa Ngemplak dan desa Kalikotes di sebelah Barat, desa Wanglu di sebelah Utara, desa Trucuk di sebelah Timur dan desa Krakitan di sebelah Selatan.</p>

          <div class="r-icon">
            <ul class="list-inline">
              <li class="list-inline-item animated slideInUp"><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
              <li class="list-inline-item animated slideInUp"><a href="https://twitter.com/"><i class="fab fa-twitter"></i></a></li>
              <li class="list-inline-item animated slideInUp"><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Experience -->
  <section class="experience  mb-5" id="experience">
    <div class="container">
      <div class="row">
        <div class="col-md-6 text-center d-flex align-items-center justify-content-center way-fade-up"><h3>Sumber Pendapatan Desa</h3></div>
        <div class="col-md-6 way-fade-up">
          <label>Penjualan</label>
          <div class="progress">
            <div class="progress-bar progress-color" role="progressbar" style="width: 0%"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">30%</div>
          </div>

          <label>Hasil Tani</label>
          <div class="progress">
            <div class="progress-bar progress-color" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">40%</div>
          </div>

          <label>Sumbangan Pihak ketiga</label>
          <div class="progress">
            <div class="progress-bar progress-color" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">30%</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section class="services bg-sec r-p " id="services">
    <div class="container text-center">
      <div class="row">
        <div class="col mb-5 way-fade-right ">
          <div class="col">
            <h2>Berita</h2>
            <p>Berita Terkini</p>
          </div>
        </div>
      </div>
      <!-- cards -->
      <div class="row text-center way-fade-up">
        <?php while ($berita = mysqli_fetch_array($queryBerita)) { ?>
        <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <a href="berita-detail.php"><i class="fas fa-newspaper"></i></a>
            </div>
            <div class="card-body">
              <h4 class="card-title text-truncate"><?php echo $berita['judul'];?></h4>
              <h5 class="card-title"><?php echo $berita['kategori']; ?></h5>
              <div class="service-border"></div>
              <p class="card-text text-truncate"><?php echo $berita['konten']; ?></p>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      
        
      </div>


    </div>


  </section>

  <!-- Hire Me -->
  <section class="hire r-p" id="hire">
    <div class="container text-center">
      <div class="row">
        <div class="col way-fade-left">
          <h3 class="mb-4">Ingin Melihat UMKM Kami?</h3>
          <a href="umkm.php" class="btn r-btn ">Lihat Disini</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimony -->
  <section class="testimony r-p  bg-sec" id="testimony">
    <div class="container text-center">
      <div class="row">
        <div class="col way-fade-right">
          <h2>Testimoni</h2>
          <p>Apa yang orang bilang</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="owl-carousel owl-theme">

          <?php
          while ($komentar = mysqli_fetch_array($queryKomentar)) {
            ?>
            <div class="item">
              <div class="test-item text-center">
                <i class="fas fa-quote-left "></i>
                <div><i class="fas fa-user"></i></div>
                <p class="text-muted font-italic mt-3"><?php echo $komentar['komentar']; ?></p>
                <p class="test-name"><?php echo $komentar['nama']; ?></p>
              </div>
            </div>
          <?php
          }
          ?>

          </div>


        </div>
      </div>
    </div>
  </section>
  <section class="testimony r-p  bg-sec" id="video">
    <div class="container text-center">
      <div class="row">
        <div class="col way-fade-right">
          <h2>Video</h2>
          <p>Sedikit video tentang desa Karangpakel</p>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="owl-carousel owl-theme">
            <?php while($video = mysqli_fetch_array($queryVideo)){ 
            ?>
            <div class="item">
              <div class="test-item text-center">
                <div><iframe width="560" height="315" src="<?php echo $video['link']; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                <p class="text-muted font-italic"><?php echo $video['judul']; ?></p>
              </div>
            </div>
            <?php } ?>
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

  <!-- Contact -->
  <section class="contact r-p bg-sec" id="contact">
    <div class="container text-center">
      <div class="row">
        <div class="col way-fade-left">
          <h2>Kontak Kami</h2>
          <p>Terasa gratis untuk menghubungi kami</p>
        </div>
      </div>
      <div class="row mt-5 way-fade-left ">
        <div class="col-md-4">
          <div class="r-icon"> <i class="fas fa-mobile-alt"></i></div>
          <div class="text-center">
            <h5>Telfon kami</h5>
            <p>0895363185264</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="r-icon"> <i class="far fa-envelope"></i></div>
          <div class="text-center">
            <h5>Email</h5>
            <p class="text-muted">contact@karangpakel.com</p>

          </div>
        </div>

        <div class="col-md-4">
          <div class="r-icon"> <i class="fas fa-map-pin"></i></div>
          <div class="text-center">
            <h5>Location</h5>
            <p class="text-muted">Desa Karangpakel, Trucuk, Klaten, Jawa Tengah</p>

          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col">
          <div class="col way-fade-left">
          <h2>Komentar</h2>
          <p>Berikan kami pesan dan kesan</p>
        </div>
          <form method="POST" action="">
            <div class="form-group way-fade-left">
              <div class="form-group">

                <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama">
              </div>
            </div>
            <div class="form-group way-fade-left">
              <textarea id="komentar" name="komentar" class="form-control" rows="7" placeholder="Pesan dan Kesan anda" style="resize:none;"></textarea>
            </div>

            <input value="Kirim" type="submit" id="kirkom" name="kirkom" class="btn r-btn float-right way-fade-left">
          </form>
          <?php
          if (isset($_POST['kirkom'])){
            $nama = htmlspecialchars($_POST['nama']);
            $komentar = htmlspecialchars($_POST['komentar']);

            $queryTamkom = mysqli_query($conn, "INSERT INTO komentar(nama, komentar)VALUES('$nama', '$komentar')");

            if($queryTamkom){
              ?>
              <div class="alert alert-warning" role="alert">
                Terima Kasih telah memberikan Komentar
              </div>
              <?php
            }else{
              echo mysqli_error($conn);
            }
          }
          ?>
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
