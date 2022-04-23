<?php
define('HOST','203.130.206.114:3000');
define('USER','taspen');
define('PASS','taspen');
define('DB1', 'riau1');

// Buat Koneksinya
$db1 = new mysqli(HOST, USER, PASS, DB1);

//cek Koneksi ke database
if(mysqli_connect_errno()){
    echo "Koneksi ke Database <b>". DB1 . "</b> Gagal, ". mysqli_connect_error();
}else{
    //echo "Connection Success";
}
