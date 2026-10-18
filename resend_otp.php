<?php
session_start();
require 'db.php';
require 'vendor/autoload.php'; // pastikan PHPMailer sudah diinstall via composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Ambil ID user dari URL
if (!isset($_GET['user'])) {
    $_SESSION['otp_success'] = "Permintaan tidak valid.";
    header("Location: verify_otp.php");
    exit();
}

$user_id = $_GET['user'];

// Ambil email berdasarkan ID user dari database
$stmt = $conn->prepare("SELECT email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['otp_success'] = "User tidak ditemukan.";
    header("Location: verify_otp.php");
    exit();
}

$row = $result->fetch_assoc();
$email = $row['email'];

// Cegah spam resend (60 detik)
if (isset($_SESSION['last_otp_time']) && time() - $_SESSION['last_otp_time'] < 60) {
    $_SESSION['otp_success'] = "Tunggu sebentar sebelum mengirim ulang OTP.";
    header("Location: verify_otp.php");
    exit();
}

// Generate OTP baru
$otp = rand(100000, 999999);

// Update OTP di database
$update = $conn->prepare("UPDATE users SET otp = ? WHERE id = ?");
$update->bind_param("ii", $otp, $user_id);
$update->execute();

$_SESSION['last_otp_time'] = time();

// Kirim OTP ke email dengan PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'gungsatria124@gmail.com';
    $mail->Password   = 'fbfp hpwb vjgt vtgw'; // App Password Gmail
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Penerima
    $mail->setFrom('gungsatria124@gmail.com', 'SMK N 1 MAS UBUD');
    $mail->addAddress($email);

    // Konten email
    $mail->isHTML(true);
    $mail->Subject = 'Kode OTP Baru';
    $mail->Body    = "Kode OTP baru kamu adalah: <b>$otp</b>";

    $mail->send();
    $_SESSION['otp_success'] = "OTP baru berhasil dikirim ke Email.";
} catch (Exception $e) {
    $_SESSION['otp_success'] = "Terjadi kesalahan saat mengirim OTP: {$mail->ErrorInfo}";
}

header("Location: verify_otp.php");
exit();
?>
