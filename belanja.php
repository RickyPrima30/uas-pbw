<?php

require "koneksi.php";
require 'adminpanel/session.php';


$queryWaktu = date('Y-m-d');
$username = $_POST['username'];

$queryTransaksi = mysqli_query($conn, "INSERT INTO transaksi (nama, id_produk, tanggal) VALUES('$username', ".$_POST['idbeli'].", '$queryWaktu' ) ");

?>
<?php

?>
<meta http-equiv="refresh" content="0; url=umkm.php">
<?php
?>