<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uas_pbw";

$conn = mysqli_connect($servername,$username,$password,$dbname);

//register

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $codepass = $_POST['password']; //belum di enkripsi

    //enkripsi
    $epassword = password_hash($codepass, PASSWORD_DEFAULT);

    //insert to db
    $insert = mysqli_query($conn, "INSERT INTO user (username , codepass) values ('$username','$epassword')");

    if ($insert){
        //jika berhasil
        header('location:login.php');
    }else{
        //jika gagal
        echo '
        <script>
        alert ("Registrasi gagal");
        windows.location.href="register.php";
        </script>
        ';
    }
}

//login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $codepass = $_POST['password']; //belum di enkripsi


    //insert to db
    $cekdb = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $hitung = mysqli_num_rows($cekdb);
    $pw = mysqli_fetch_array($cekdb);
    $passwordsekarang = $pw['codepass'];

    if ($hitung > 0) {
        if (password_verify($codepass, $passwordsekarang)) {
            header('location:index.php');
        }else {
            //jika gagal
            echo '
        <script>
        alert ("Login Gagal");
        windows.location.href="register.php";
        </script>
        ';
        }
    }
}

?>