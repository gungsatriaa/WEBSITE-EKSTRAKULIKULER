<?php
include 'config_lupasandi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validasi token
    $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token=? AND reset_expiry > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Token tidak valid.");
    }

    $user = $result->fetch_assoc();
    $userId = $user['id'];

    // Update password dan hapus token
    $stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, reset_expiry=NULL WHERE id=?");
    $stmt->bind_param("si", $newPassword, $userId);
    $stmt->execute();

    echo '
        <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Pasword | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-stone-200 px-2">
  <div class="bg-white px-4 py-6 rounded-2xl shadow-lg w-full max-w-xs sm:max-w-sm">
    
  <div class="bg-blue-200 text-blue-700 p-3 rounded-xl text-sm mb-4">
              Kata Sandi Berhasil Diubah. Silahkan Login kembali!
            </div>
    

    <!-- LINK REGISTER -->
    <div class="mt-3 text-center">
    <a href="index.php" class="text-blue-500 hover:underline text-sm">Login Kembali</a>
    </div>
    
    
  </div>
</body>

</html>
        ';
}
?>
