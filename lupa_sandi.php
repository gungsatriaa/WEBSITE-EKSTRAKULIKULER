<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Sandi | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-200 flex items-center justify-center min-h-screen px-2">
  <div class="bg-white px-4 py-6 rounded-2xl shadow-lg w-full max-w-xs sm:max-w-sm">
    <h2 class="text-xl sm:text-2xl font-bold mb-4 text-center">Lupa Sandi</h2>

    <form action="proses_lupa_sandi.php" method="POST" class="space-y-3">
      <div>
        <label class="block text-gray-700 text-sm mb-1">Email:</label>
        <input type="email" name="email" autocomplete="off" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
      </div>
      <button type="submit" class="w-full bg-blue-200 hover:bg-blue-300 text-blue-700 font-semibold text-sm py-2 rounded-full transition duration-300">
        Kirim Link Reset
      </button>
    </form>

    <!-- LINK REGISTER -->
    <div class="mt-3 text-center">
    <a href="index.php" class="text-blue-500 hover:underline text-sm">Login Kembali</a>
    </div>
    
    
  </div>
</body>

</html>