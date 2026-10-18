<?php
// Memulai sesi untuk memastikan session sebelumnya bisa diakses dan dihentikan
session_start();

// Menghancurkan seluruh data session (logout)
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header("Location: index.php");

// Menghentikan eksekusi script setelah redirect
exit();
?>
