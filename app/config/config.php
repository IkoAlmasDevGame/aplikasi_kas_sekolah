<?php
date_default_timezone_set("Asia/Jakarta");

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "db_uang_kas";

$konfigs = mysqli_connect($hostname, $username, $password, $dbname);

if ($konfigs) {
    // echo "berhasil terkoneksi!";
} else {
    echo "gagal terkoneksi!";
}

function baseurl($url)
{
    $link = "http://localhost/aplikasi_kas_sekolah/" . $url;
    return $link;
}
