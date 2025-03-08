<?php
$host = "localhost:3308";
$user = "root"; // Gunakan 'root' sebagai username
$password = ""; // Jika tidak ada password, biarkan kosong
$dbname = "user_registration";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    echo "Koneksi berhasil!";
}
?>
