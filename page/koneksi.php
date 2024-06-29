<?php
define('HOST','xxxx.xxxx.xxxx.xxxx:xxxxx');
define('USER','xxxxxx');
define('PASS','xxxxxx');
define('DB1', 'xxxxxx');

// Buat Koneksinya
$db1 = new mysqli(HOST, USER, PASS, DB1);

//cek Koneksi ke database
if(mysqli_connect_errno()){
    echo "Koneksi ke Database <b>". DB1 . "</b> Gagal, ". mysqli_connect_error();
}else{
    //echo "Connection Success";
}
