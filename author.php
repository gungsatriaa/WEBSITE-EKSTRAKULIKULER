<?php
session_start();
// Jika belum login, redirect ke index.php
if (!isset($_SESSION['user_id'])) {
header("Location: index.php");
exit();
}
?>
