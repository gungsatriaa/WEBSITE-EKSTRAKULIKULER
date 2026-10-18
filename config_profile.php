<?php
$host = "localhost";
$user = "gung1358_data_extra";
$pass = "ubudbali99";
$db = "gung1358_data_extra";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
