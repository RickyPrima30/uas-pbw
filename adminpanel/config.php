<?php
    $servername = "sql100.epizy.com";
    $username = "epiz_33317000";
    $password = "QMr54aTSwjd7TV";
    $dbname = "epiz_33317000_uas_pbw";
    
    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if (mysqli_connect_errno()){
          echo "Failed to connect to MySQL : " . mysqli_connect_error();
          exit();
    }
?>