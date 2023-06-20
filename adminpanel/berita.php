<?php

require "../koneksi.php";
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$query = mysqli_query($conn, "SELECT * FROM berita");
$queryJumlah = mysqli_num_rows($query);


if (isset($_POST['simpan'])) {
    $judul = htmlspecialchars($_POST['judul']);
    $konten = htmlspecialchars($_POST['konten']);
    $waktu = htmlspecialchars($_POST['waktu']);
    $kategori = htmlspecialchars($_POST['kategori']);

    $queryTambah = mysqli_query($conn, "INSERT INTO berita(judul, konten, waktu, kategori) VALUES ( '$judul', '$konten', '$waktu', '$kategori')");

    if ($queryTambah) {
?>

            <meta http-equiv="refresh" content="0; url=berita.php"/>
            <?php
    } else {
        echo mysqli_error($conn);
    }
}
            ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../css1/style.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/owl.carousel.min.css">
    <link rel="stylesheet" href="../lib/owl.theme.default.min.css">
    <link rel="icon" href="../images/fav.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
    <link rel="stylesheet" href="lib/animate.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita</title>
</head>
<style>
    form div{
        margin-bottom: 10px;
    }
</style>
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
                    Berita
                </li>
            </ol>
        </nav>

        <!-- Tambah Produk -->

        <div class="my-5 col-12 col-md-6">
            <h3>Tambah Berita</h3>

            <form action="" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="judul">Judul</label>
                    <input type="text" required id="judul" name="judul" class="form-control" autocomplete="off">
                </div>
                <div>
                    <label for="konten">Konten</label>
                    <textarea name="konten" id="detail" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div>
                    <label for="waktu">Waktu</label>
                    <input type="hidden" value="<?php echo date('Y-m-d'); ?>" required class="form-control" name="waktu">
                </div>
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" class="form-control">
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
                </div>
            </form>
        </div>

        <div class="mt-3 mb-5">
            <h2>List Berita</h2>

            <div class="table-responsive mt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Judul</th>
                            <th>Konten</th>
                            <th>Waktu</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($queryJumlah==0){
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">Data Berita Tidak Tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 0;
                            while ($data = mysqli_fetch_array($query)) {
                                $jumlah++;
                                ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['judul']; ?></td>
                                    <td><?php echo $data['konten']; ?></td>
                                    <td><?php echo $data['waktu']; ?></td>
                                    <td><?php echo $data['kategori']; ?></td>
                                    <td>
                                      <a href="berita-detail.php?p=<?php echo $data['id_berita']; ?>" class="btn btn-info"><i class="fas fa-search"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


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