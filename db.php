

<?php
$host = "localhost";
$user = "gung1358_data_extra"; // Sesuaikan dengan username MySQL Anda
$pass = "ubudbali99"; // Jika ada password, isi di sini
$dbname = "gung1358_data_extra"; // sesuaikan dengan nama dataasae
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
 die("Koneksi gagal: " . $conn->connect_error); // Jika gagal pesan eror
}
?>