<?php
session_start();
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$success = "";
$error = "";

// Inisialisasi field agar tetap terisi saat error
$name = $nis = $kelas = $username = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = trim($_POST['name']);
    $nis = trim($_POST['nis']);
    $kelas = trim($_POST['kelas']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validasi form
    if (empty($name) || empty($nis) || empty($kelas) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Semua field harus diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Password tidak cocok!";
    } else {
        // Cek apakah nis / username / email sudah ada
        $check_sql = "SELECT * FROM users WHERE username = ? OR nis = ? OR email = ?";
        $stmt = $conn->prepare($check_sql);
        $stmt->bind_param("sss", $username, $nis, $email);
        $stmt->execute();
        $check_result = $stmt->get_result();

        if ($check_result->num_rows > 0) {
            while ($row = $check_result->fetch_assoc()) {
                if ($row['username'] === $username) {
                    $error = "Username sudah digunakan!";
                    break;
                }
                if ($row['nis'] === $nis) {
                    $error = "NIS sudah terdaftar!";
                    break;
                }
                if ($row['email'] === $email) {
                    $error = "Email sudah digunakan!";
                    break;
                }
            }
        }
    }

    // Jika tidak ada error, baru lanjut simpan ke database
    if (empty($error)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $otp = rand(100000, 999999);

        $insert_sql = "INSERT INTO users (name, nis, kelas, username, email, password, otp, is_verified)
                       VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssssssi", $name, $nis, $kelas, $username, $email, $hashed_password, $otp);

        if ($stmt->execute()) {
            // Kirim OTP via Email
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'gungsatria124@gmail.com'; // Ganti sesuai akun
                $mail->Password = 'fbfp hpwb vjgt vtgw';     // App password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('gungsatria124@gmail.com', 'SMK N 1 MAS UBUD');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Verifikasi OTP';
                $mail->Body = "Halo $name,<br><br>Kode OTP Anda adalah: <b>$otp</b><br><br>Gunakan kode ini untuk verifikasi akun Anda.";

                $mail->send();

                $_SESSION['pending_email'] = $email;
                $_SESSION['otp_success'] = "Kode OTP telah dikirim ke email Anda.";

                header("Location: verify_otp.php?email=" . urlencode($email));
                exit();

            } catch (Exception $e) {
                $error = "OTP gagal dikirim. Error: {$mail->ErrorInfo}";
            }
        } else {
            $error = "Terjadi kesalahan saat menyimpan data.";
        }
    }
}
?>




<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-stone-200 px-2">
<div class="bg-white px-4 py-6 sm:px-6 sm:py-8 rounded-2xl shadow-xl w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-sm">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">Buat Akun</h2>

    <!-- ALERT ERROR/SUCCESS -->
    <?php if (!empty($error)): ?>
      <div class="bg-red-500 text-white p-2 rounded-lg text-center mb-4 text-sm sm:text-base">
        <?= $error ?>
      </div>
    <?php elseif (!empty($success)): ?>
      <div class="bg-green-500 text-white p-2 rounded-lg text-center mb-4 text-sm sm:text-base">
        <?= $success ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-3 sm:space-y-4">
      <div>
        <label class="block text-gray-700 text-sm">Nama Lengkap:</label>
        <input type="text" name="name" required
               value="<?= htmlspecialchars($name ?? '') ?>"
               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <div>
        <label class="block text-gray-700 text-sm">NIS:</label>
        <input type="number" name="nis" required
               value="<?= htmlspecialchars($nis ?? '') ?>"
               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <div>
        <label class="block text-gray-700 text-sm">Kelas:</label>
        <input type="text" name="kelas" required
               value="<?= htmlspecialchars($kelas ?? '') ?>"
               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <div>
        <label class="block text-gray-700 text-sm">Username:</label>
        <input type="text" name="username" required
               value="<?= htmlspecialchars($username ?? '') ?>"
               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <div>
        <label class="block text-gray-700 text-sm">Email:</label>
        <input type="text" name="email" required
               value="<?= htmlspecialchars($email ?? '') ?>"
               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <div>
        <label class="block text-gray-700 text-sm">Kata Sandi:</label>
        <input type="password" name="password" required
               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <div>
        <label class="block text-gray-700 text-sm">Konfirmasi Kata Sandi:</label>
        <input type="password" name="confirm_password" required
               class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <button type="submit"
              class="w-full bg-green-200 hover:bg-green-300 text-green-700 font-semibold text-sm py-2 rounded-full transition duration-300">
        Daftar
      </button>
    </form>

    <!-- LINK KE LOGIN -->
    <div class="mt-3 text-center">
      <p class="text-gray-600 text-sm">Sudah punya akun?</p>
      <a href="index.php" class="text-blue-500 hover:underline text-sm">Login di sini</a>
    </div>
  </div>
</body>
</html>

