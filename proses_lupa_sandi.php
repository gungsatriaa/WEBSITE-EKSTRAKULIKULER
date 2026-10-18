<?php
include 'config_lupasandi.php';
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Cek apakah email ada di database
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        // Email tidak ditemukan
        echo '
        <div class="bg-red-200 text-red-700 p-3 rounded-xl text-sm mb-4 text-center">
            Email tidak ditemukan.
        </div>';
        exit;
    }

    // Token baru
$token = bin2hex(random_bytes(32));

// Gunakan waktu dari SQL langsung
$stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expiry = NOW() + INTERVAL 1 HOUR WHERE email = ?");
$stmt->bind_param("ss", $token, $email);
if (!$stmt->execute()) {
    echo "Gagal menyimpan token: " . $conn->error;
    exit;
}


    // Kirim email
    $resetLink = 'https://' . $_SERVER['HTTP_HOST'] . '/reset_sandi.php?token=' . urlencode($token);


    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gungsatria124@gmail.com';
        $mail->Password = 'fbfp hpwb vjgt vtgw'; // gunakan App Password Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('gungsatria124@gmail.com', 'Aplikasi Reset Password');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Reset Kata Sandi Anda';
        $mail->Body = "Klik link berikut untuk mengatur ulang kata sandi Anda:<br><a href='$resetLink'>$resetLink</a><br><br>Link ini akan kadaluarsa dalam 1 jam.";

        $mail->send();

        // Tampilan notifikasi sukses
        echo '
        <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Sandi | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-stone-200 px-2">
  <div class="bg-white px-4 py-6 rounded-2xl shadow-lg w-full max-w-xs sm:max-w-sm">
    
  <div class="bg-blue-200 text-blue-700 p-3 rounded-xl text-sm mb-4">
              Link reset telah dikirim ke email Anda. Silakan cek kotak masuk atau folder spam.
            </div>
    

    <!-- LINK REGISTER -->
    <div class="mt-3 text-center">
    <a href="index.php" class="text-blue-500 hover:underline text-sm">Login Kembali</a>
    </div>
    
    
  </div>
</body>

</html>
        ';

    } catch (Exception $e) {
        echo '
        <div class="bg-red-200 text-red-700 p-3 rounded-xl text-sm mb-4 text-center">
          Gagal mengirim email. Error: ' . htmlspecialchars($mail->ErrorInfo) . '
        </div>';
    }
}
?>
