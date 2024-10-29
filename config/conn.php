<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_sisarpras";

$con = mysqli_connect($hostname, $username, $password, $database);
if (!$con) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah file ini dipanggil secara langsung
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    echo "Koneksi ke database berhasil!";
    
    // Opsional: Tambahkan informasi lebih lanjut
    echo "<br>Server Info: " . mysqli_get_server_info($con);
    echo "<br>Host Info: " . mysqli_get_host_info($con);
}
?>