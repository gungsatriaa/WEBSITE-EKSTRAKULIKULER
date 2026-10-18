<?php
include 'author.php';
include 'config_profile.php';

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_SESSION['id'];
$result = $conn->query("SELECT * FROM users WHERE id = $id");

if ($result && $result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    die("Data tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-200 min-h-screen flex flex-col">
  <nav>
    <?php include 'navbar.php'?>
  </nav>

  <!-- Konten Utama -->
  <main class="flex-grow flex items-center justify-center px-4 py-8">
    <div class="bg-white p-6 sm:p-8 rounded-xl shadow-md w-full max-w-4xl">
      <!-- Header Profil -->
      <div class="flex flex-col md:flex-row md:items-center md:space-x-6 text-center md:text-left">
        <div class="flex-shrink-0">
          <img src="tikmas.png" alt="Foto Profil"
            class="w-32 h-32 rounded-full object-cover mx-auto md:mx-0">
        </div>
        <div class="mt-4 md:mt-0">
          <h1 class="text-3xl font-bold text-gray-800"><?= strtoupper($data['name']) ?></h1>
          <p class="text-gray-500 mt-1"><?= $data['kelas'] ?> | <?= $data['nis'] ?></p>
        </div>
      </div>

      <!-- Info + Keamanan -->
      <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Informasi Akun -->
        <div class="bg-gray-50 p-5 rounded-xl shadow">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Informasi Akun</h2>
          <p class="mb-2"><span class="font-medium">Username:</span> <?= $data['username'] ?></p>
          <p class="mb-2"><span class="font-medium">Email:</span> <?= $data['email'] ?></p>
        </div>

        <!-- Keamanan -->
        <div class="bg-gray-50 p-5 rounded-xl shadow">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Keamanan</h2>
          <div class="">
            <a href="lupa_sandi.php"
              class="bg-blue-200 text-blue-700 px-5 py-2 rounded-full text-center hover:bg-blue-300 w-full sm:w-auto">Ubah Sandi</a>
          </div>
        </div>
      </div>

      <!-- Tombol Aksi -->
      <div class="mt-8 flex flex-col sm:flex-row gap-4">
        <a href="logout.php"
           class="bg-red-200 text-red-700 px-5 py-2 rounded-full text-center hover:bg-red-300 w-full sm:w-auto">Logout</a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-8 px-4">
    <?php include 'footer.php'; ?>
  </footer>

</body>
</html>



