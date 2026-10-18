<?php
ob_start();
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username_or_email, $username_or_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($user['is_verified'] == 1) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                header("Location: main.php");
                echo "<script>window.location.href = 'main.php';</script>";
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = 'Akun belum diverifikasi! <a href="resend_otp.php?user=' . urlencode($user['id']) . '" class="text-blue-600 hover:text-blue-700 underline">Klik untuk verifikasi</a>';
        }
    } else {
        $error = "Username atau email tidak ditemukan!";
    }
}
?>






<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-stone-200 px-2">
  <div class="bg-white px-4 py-6 rounded-2xl shadow-lg w-full max-w-xs sm:max-w-sm">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">Login</h2>

    <!-- ALERT ERROR -->
    <?php if (!empty($error)): ?>
      <div class="bg-red-200 text-red-700 p-2 rounded-xl text-center mb-4 text-sm">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-3">
      <div>
        <label class="block text-gray-700 text-sm">Username/Email:</label>
        <input type="text" name="username" autocomplete="off" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <div>
        <label class="block text-gray-700 text-sm">Kata Sandi:</label>
        <input type="password" name="password" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <button type="submit" class="w-full bg-blue-200 hover:bg-blue-300 text-blue-700 font-semibold text-sm py-2 rounded-full transition duration-300">
        Login
      </button>
    </form>

    <!-- LINK REGISTER -->
    <div class="mt-3 text-center">
    <a href="lupa_sandi.php" class="text-blue-500 hover:underline text-sm">Lupa Sandi?</a>
    </div>
    <div class="mt-3 text-center">
      <p class="text-gray-600 text-sm">Belum punya akun?</p>
      <a href="register.php" class="text-blue-500 hover:underline text-sm">Buat Akun</a>
    </div>
    
  </div>
</body>

</html>
