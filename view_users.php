<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Users | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-200">

<?php include 'navbar.php' ?>

<div class="flex items-center justify-center min-h-screen p-3">
  <div class="bg-white p-4 sm:p-5 rounded-lg shadow-lg w-full max-w-5xl">

    <h2 class="text-lg sm:text-xl font-semibold mb-4 text-center text-gray-700">Daftar Data Users</h2>

    <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm">
      <table class="min-w-full bg-white text-xs sm:text-sm">
        <thead class="bg-blue-200 text-blue-700">
          <tr>
            <th class="px-3 py-2 border">ID</th>
            <th class="px-3 py-2 border">Nama Siswa</th>
            <th class="px-3 py-2 border">NIS</th>
            <th class="px-3 py-2 border">Kelas</th>
            <th class="px-3 py-2 border">Username</th>
            <th class="px-3 py-2 border">Dibuat Pada</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <?php
          include 'author.php';
          include 'db.php';

          $sql = "SELECT id, name, nis, kelas, username, created_at FROM users";
          $result = $conn->query($sql);

          while ($row = $result->fetch_assoc()):
          ?>
          <tr class="border-t hover:bg-gray-100">
            <td class="px-3 py-2 border text-center"><?= $row['id'] ?></td>
            <td class="px-3 py-2 border"><?= $row['name'] ?></td>
            <td class="px-3 py-2 border"><?= $row['nis'] ?></td>
            <td class="px-3 py-2 border"><?= $row['kelas'] ?></td>
            <td class="px-3 py-2 border"><?= $row['username'] ?></td>
            <td class="px-3 py-2 border"><?= $row['created_at'] ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-5 text-center">
      <a href="main.php" class="bg-pink-200 hover:bg-pink-300 text-pink-700 font-semibold text-xs sm:text-sm px-5 py-2 rounded-full transition duration-300">
        Kembali
      </a>
    </div>

  </div>
</div>

<?php include 'footer.php' ?>
</body>
</html>
