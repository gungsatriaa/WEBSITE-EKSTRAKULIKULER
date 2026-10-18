
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-200">

<?php include 'navbar.php' ?>

<div class="flex items-center justify-center min-h-screen p-4">
  <div class="bg-white p-4 sm:p-6 rounded-lg shadow-lg w-full max-w-6xl">

    <!-- Judul -->
    <h2 class="text-lg sm:text-2xl font-semibold mb-4 text-center text-gray-700">Daftar Data Extra</h2>

    <!-- Tabel -->
    <div class="overflow-x-auto border border-gray-300 rounded-lg shadow-sm">
      <table class="min-w-full bg-white text-sm sm:text-base">
        <thead class="bg-blue-200 text-blue-700">
          <tr>
            <th class="px-3 py-2 border">ID</th>
            <th class="px-3 py-2 border">Nama Siswa</th>
            <th class="px-3 py-2 border">NIS</th>
            <th class="px-3 py-2 border">Kelas</th>
            <th class="px-3 py-2 border">Semester</th>
            <th class="px-3 py-2 border">Pilihan Extra</th>
          </tr>
        </thead>
        <tbody class="text-gray-700">
          <?php
          include 'author.php';
          include 'db.php';

          $sql = "SELECT id, name, nis, kelas, semester, extra FROM data_siswa";
          $result = $conn->query($sql);

          while ($row = $result->fetch_assoc()):
          ?>
          <tr class="border-t hover:bg-gray-100">
            <td class="px-3 py-2 border text-center"><?= $row['id'] ?></td>
            <td class="px-3 py-2 border"><?= $row['name'] ?></td>
            <td class="px-3 py-2 border"><?= $row['nis'] ?></td>
            <td class="px-3 py-2 border"><?= $row['kelas'] ?></td>
            <td class="px-3 py-2 border"><?= $row['semester'] ?></td>
            <td class="px-3 py-2 border"><?= $row['extra'] ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

    <!-- Tombol -->
    <div class="mt-6 flex flex-col sm:flex-row justify-center gap-3">
      <a href="main.php" class="bg-pink-200 hover:bg-pink-300 text-pink-700 font-semibold text-sm px-5 py-2 rounded-full transition duration-300 text-center">Kembali</a>
      <a href="export.php" class="bg-green-200 hover:bg-green-300 text-green-700 font-semibold text-sm px-5 py-2 rounded-full transition duration-300 text-center">Export</a>
    </div>

  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
