<?php
session_start();
require 'db.php';

$verif_result = "";

// Ambil notifikasi sukses dari session (misalnya dari resend OTP)
$success = "";
if (isset($_SESSION['otp_success'])) {
    $success = $_SESSION['otp_success'];
    unset($_SESSION['otp_success']);
}

// Proses verifikasi OTP
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $otp = trim($_POST['otp']);

  // Validasi OTP kosong
  if (empty($otp)) {
      $verif_result = "<div class='bg-red-100 text-red-800 px-4 py-2 rounded-full mt-4 text-center'>OTP tidak boleh kosong!</div>";
  } else {
      // Cek OTP di database
      $stmt = $conn->prepare("SELECT email FROM users WHERE otp = ?");
      $stmt->bind_param("i", $otp);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          // Ambil email yang cocok
          $row = $result->fetch_assoc();
          $email = $row['email'];

          // Update status verifikasi
          $update = $conn->prepare("UPDATE users SET is_verified = 1 WHERE email = ?");
          $update->bind_param("s", $email);
          $update->execute();

          $verif_result = "<div class='bg-green-100 text-green-800 px-4 py-2 rounded-full mt-4 text-center mb-4'>Kode berhasil diverifikasi! Silakan login.</div>";

          echo "<script>
              setTimeout(function() {
                  window.location.href = 'index.php';
              }, 3000);
          </script>";
      } else {
        $verif_result = "<div class='bg-red-100 text-red-800 px-4 py-2 rounded-full mt-4 text-center mb-4'>Kode OTP salah atau tidak valid!</div>";
      }
  }
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-stone-200 px-2">
  <div class="bg-white px-4 py-6 rounded-2xl shadow-lg w-full max-w-xs sm:max-w-sm">
  <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">Verifikasi Akun</h2>

<?php if (!empty($success)) : ?>
  <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full mb-3 text-center text-sm">
    <?php echo $success; ?>
  </div>
<?php endif; ?>

<?php if (!empty($verif_result)) echo $verif_result; ?>

<form method="POST" class="space-y-3">
    <div>
        <label class="block text-gray-700 text-sm">Kode OTP :</label>
        <input type="text" name="otp" autocomplete="off" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
    </div>
    <!-- <h3 class="text-xs text-center">*Cek Email anda untuk mendapatkan kode OTP*</h3> -->
    <button type="submit" class="w-full bg-blue-200 hover:bg-blue-300 text-blue-700 font-semibold text-sm py-2 rounded-full transition duration-300">
        Verifikasi
    </button>
</form>

<div class="mt-3 text-center">
  <form method="POST" action="resend_otp.php">
    <button id="resendBtn" type="submit" class="text-sm text-blue-600 hover:underline disabled:opacity-50" disabled>
      Kirim ulang OTP (<span id="countdown">30</span> detik)
    </button>
  </form>
</div>


    </form>

    <!-- LINK REGISTER -->
  </div>

  <script>
  let countdown = 30;
  const countdownEl = document.getElementById('countdown');
  const resendBtn = document.getElementById('resendBtn');

  const timer = setInterval(() => {
    countdown--;
    countdownEl.textContent = countdown;
    if (countdown <= 0) {
      clearInterval(timer);
      resendBtn.disabled = false;
      resendBtn.textContent = "Kirim ulang OTP";
    }
  }, 1000);
</script>

</body>

</html>