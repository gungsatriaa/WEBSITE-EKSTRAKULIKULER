<?php
include 'config_lupasandi.php';

if (!isset($_GET['token'])) {
    die("Token tidak tersedia.");
}

$token = $_GET['token'];
$stmt = $conn->prepare("SELECT * FROM users WHERE reset_token=? AND reset_expiry > NOW()");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Token tidak valid atau kadaluarsa.");
}

$user = $result->fetch_assoc();
?>

<!-- FORM GANTI PASSWORD -->
<!-- Pastikan ada token valid -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-stone-200 px-2">
  <div class="bg-white px-4 py-6 rounded-2xl shadow-lg w-full max-w-xs sm:max-w-sm">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">Atur Ulang Sandi</h2>


    <form action="simpan_password_baru.php" method="POST" class="space-y-3">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
      <div>
        <label class="block text-gray-700 text-sm mb-1">Kata Sandi Baru:</label>
        <input type="password" name="password" autocomplete="off" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      
      <button type="submit" class="w-full bg-blue-200 hover:bg-blue-300 text-blue-700 font-semibold text-sm py-2 rounded-full transition duration-300">
        Simpan
      </button>
    </form>

    <!-- LINK REGISTER -->
    
    
  </div>
</body>

</html>


