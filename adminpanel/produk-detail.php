<?php
require "../koneksi.php";
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
$id = $_GET['p'];
$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]' ");

function generateRandomString($length = 10){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++){
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css1/style.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/owl.carousel.min.css">
    <link rel="stylesheet" href="../lib/owl.theme.default.min.css">
    <link rel="icon" href="../images/fav.ico">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Nunito:400,700" rel="stylesheet">
    <link rel="stylesheet" href="lib/animate.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
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
  <br><br><br><br><br>
  <!-- <header id="home">
    <div class="container-fluid header-content">
      <div class="row">
        <div class="col">
          <div class="content-box text-center animated fadeInUp">
            <h4>SELAMAT DATANG <?php echo $_SESSION['username']; ?></h4>
            <h1>Di Dashboard Website <span class="element" style="color:#EE8683;font-weight:bold;">desa Karangpakel</span></h1>
            <p>Website desa Karangpakel untuk memudahkan warga desa dan pendatang untuk dapat membeli makanan, minuman bahkan Souvenir</p>
            <a href="#about" class="btn">Lanjut</a>
          </div>
        </div>
      </div>
    </div>
  </header> -->
  <div class="container mt-5">
  <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel" class="text-muted"><i class="fas fa-home"></i> Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>
<br><br><br>
    <div class="container mt-5">
    <h2>Detail Produk</h2>

    <div class="col-12 col-md-5 mb-5">
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" class="form-control" autocomplete="off" required value="<?php echo $data['nama']; ?>">
            </div>
            <div>
            <label for="kategori">Kategori</label>
            <Select name="kategori" id="kategori" class="form-control" required>
                <option value="<?php echo $data['nama_kategori']  ?>"><?php echo $data['nama_kategori'] ?></option>
                <?php
                while($dataKategori=mysqli_fetch_array($queryKategori)){
                    ?>
                    <option value="<?php echo $dataKategori['id']; ?>"><?php echo $dataKategori['nama'] ?></option>
                    <?php
                }
                ?>
            </Select>
            </div>
            <div>
                <label for="harga">Harga</label>
                <input type="number" value="<?php echo $data['harga']; ?>" required class="form-control" name="harga">
            </div>
            <label for="currentFoto">Foto Produk Sekarang</label>
            <img src="../image/<?php echo $data['foto']; ?>" width="300px">
            <div>
                <label for="foto" class="mt-3">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
            <div>
                <label for="detail">Detail</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $data['detail'] ?></textarea>
            </div>
            <div>
                <label>Ketersediaan Stok</label>
                <select class="form-control" name="ketersediaan_stok" id="ketersediaan_stok">
                    <option value="<?php echo $data['ketersediaan_stok']; ?>"><?php echo $data['ketersediaan_stok']; ?></option>
                    <?php
                    if($data['ketersediaan_stok']=='tersedia'){
                        ?>
                        <option value="habis">Habis</option>
                        <?php
                    }else{
                        ?>
                        <option value="tersedia">Tersedia</option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
                <button class="btn btn-danger" type="submit" name="hapus">Hapus</button>
            </div>
        </form>

        <?php
        if(isset($_POST['simpan'])){
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathInfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name = $random_name . "." . $imageFileType;

                if($nama=='' || $kategori=='' || $harga==''){
                    ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama, Kategori, dan Harga wajib diisi
                    </div>
                    <?php
                }else{
                $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id='$id' ");

                if($nama_file!=''){
                    if($image_size > 5000000){
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            File Foto Tidak Boleh Lebih dari 5MB
                        </div>
                        <?php
                    }else{
                        if($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif' ){
                        ?>
                        <div class="alert alert-warning" role="alert">
                            File Wajib bertipe jpg, jpeg, png, dan gif
                        </div>
                        <?php
                    }else{
                        move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                            $queryUpdate = mysqli_query($conn, "UPDATE produk SET foto='$new_name' WHERE id='$id'");

                            if($queryUpdate){
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    Produk Berhasil Diupdate
                                </div>

                                <meta http-equiv="refresh" content="2; url=produk.php" />
                                <?php
                            }else{
                                echo mysqli_error($conn);
                            }
                    }
                    }
                }
                }
        }
        if(isset($_POST['hapus'])){
          $queryHapus = mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

          if($queryHapus){
            ?>
            <div class="alert alert-primary mt-3" role="alert">
              Produk Berhasil Dihapus
            </div>

            <meta http-equiv="refresh" content="2; url=produk.php"/>
            <?php
          }
        }
        ?>

    </div>
    
    </div>
    </div>
    <br><br><br><br><br>
    

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
    <script src="../js1/app.js"></script>

</body>
</html>