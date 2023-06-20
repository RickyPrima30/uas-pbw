<?php
require "../koneksi.php";

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$queryKategori = mysqli_query($conn, "SELECT  * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);

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
  <title>Kategori</title>
</head>
<body>

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
  <div>
    <br><br><br>
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="text-muted"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="my5 col-12 col-md-6">
            <h3>Tambah Kategori</h3>

            <form action="" method="POST">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori" class="form-control">
                </div>
                <div>
                    <button class="btn btn-secondary mt-2" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <!-- <div class="alert alert-secondary mt-3" role="alert">
            </div> -->
            <?php
            if(isset($_POST['simpan_kategori'])){
                $kategori = htmlspecialchars($_POST['kategori']);

                $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");
                $jumlahDataKategoriBaru = mysqli_num_rows($queryExist);

                if($jumlahDataKategoriBaru > 0){
                    ?>
                    <div class="alert alert-secondary mt-3" role="alert">
                        Kategori Sudah Ada
                       </div>
                    <?php
                }else{
                    $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori') "); 

                    if($querySimpan){
                        ?>
                        <div class="alert alert-secondary mt-3" role="alert">
                            Kategori Berhasil Di Simpan
                        </div>
                        <meta http-equiv="refresh" content="0; url=kategori.php">
                        <?php
                    }
                        else{
                            echo mysqli_error($conn);
                        }
                }
            }
            ?>
        </div>

        <div class="mt-3">
            <h2>List Kategori</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if($jumlahKategori==0){
                    ?>
                    <tr>
                        <td colspan="3" class="text-center">Data Kategori tidak tersedia</td>
                    </tr>
                    <?php
                    }
                    else{
                        $jumlah = 1;
                        while($data=mysqli_fetch_array($queryKategori)){
                            ?>
                            <tr>
                                <td><?php echo $jumlah; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td>
                                  <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                </td>
                            </tr>
                            <?php
                            $jumlah++;
                        }
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </div>

    </div>
  </div>
  
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