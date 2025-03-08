<?php
$host = "localhost";
$user = "root"; // Pastikan menggunakan root atau user MySQL lain yang valid
$password = ""; // Jika ada password MySQL, isi di sini
$dbname = "user_registration";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil!";
}
?>
