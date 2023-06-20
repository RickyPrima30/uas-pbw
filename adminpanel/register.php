<?php
      include '../koneksi.php';
      include 'function.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Template</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="../image/map.png" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="../image/desa.png" style="width: 128px; height: 164px" alt="logo" class="logo"><h1>DESA KARANGPAKEL</h1>
              </div>
              <p class="login-card-description">Login/Daftar terlebih dahulu sebelum masuk</p>
              <form action="" method="POST">
                  <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" name="name" id="name" required class="form-control" placeholder="Username">
                  </div>
                   <div class="form-group">
                    <label for="Email" class="sr-only">Email</label>
                    <input type="email" name="email" id="email" required class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="password" id="password" required class="form-control" placeholder="***********">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Konfirmasi Password Anda</label>
                    <input type="password" name="cpassword" id="cpassword" required class="form-control" placeholder="***********">
                  </div>
                  <div>
                    <select class="form-control mb-5" name="user_type">
                       <option value="user">user</option>
                       <option value="admin">admin</option>
                    </select>
                  </div>
                  <input type="submit" name="submit" value="register now" class="btn btn-block login-btn mb-4">
                </form>
                <p class="login-card-footer-text">Sudah memiliki akun? <a href="login.php" class="text-reset">Login disini</a></p>
            </div>
          </div>
          <div class="mt-3 text-center" style="width: 1250px">
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
