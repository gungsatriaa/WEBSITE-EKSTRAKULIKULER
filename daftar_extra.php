<?php
include 'author.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $extra = $_POST['extra'];
    $semester = $_POST['semester']; // ambil semester dari form

    if (empty($semester)) {
        echo "<script>
            alert('Semester harus diisi!');
            window.history.back();
        </script>";
        exit();
    }

    // Ambil data nama, nis, dan kelas dari tabel users berdasarkan user_id
    $query_user = $conn->prepare("SELECT name, nis, kelas FROM users WHERE id = ?");
    $query_user->bind_param("i", $user_id);
    $query_user->execute();
    $result = $query_user->get_result();
    $user_data = $result->fetch_assoc();
    
    if (!$user_data) {
        die("User tidak ditemukan.");
    }

    $name = $user_data['name'];
    $nis = $user_data['nis'];
    $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : $user_data['kelas'];

    // Cek apakah NIS sudah pernah mendaftar di tabel data_siswa
    $check_query = $conn->prepare("SELECT id FROM data_siswa WHERE nis = ?");
    $check_query->bind_param("s", $nis);
    $check_query->execute();
    $check_result = $check_query->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>
            alert('Kamu sudah pernah mendaftar, tidak bisa mendaftar dua kali!');
            window.location.href = 'main.php';
        </script>";
    } else {
        // Kalau belum, lanjut simpan data
        $sql = "INSERT INTO data_siswa (name, nis, kelas, semester, extra) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $nis, $kelas, $semester, $extra);

        if ($stmt->execute()) {
            echo "<script>
                alert('Data berhasil dikirim!');
                setTimeout(function() {
                    window.location.href = 'main.php';
                }, 2000);
            </script>";
            exit();
        }
        $stmt->close();
    }

    $check_query->close();
    $query_user->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Extra | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-200 min-h-screen flex flex-col">

  <?php include 'navbar.php'; ?>

  <div class="flex-grow flex items-center justify-center px-2 py-4">
    <div class="bg-white p-4 sm:p-5 rounded-xl shadow-md w-full max-w-sm"> <!-- max-w-sm = lebih kecil -->
      <h2 class="text-base sm:text-lg font-bold mb-4 text-center">Form Input Data Extra</h2>

      <form action="" method="POST" onsubmit="return showSuccessMessage()">
        <?php
        if (!isset($_SESSION['user_id'])) {
          header("Location: index.php");
          exit();
        }
        $user_id = $_SESSION['user_id'];
        $users = $conn->query("SELECT id, name, nis, kelas FROM users WHERE id = $user_id");
        $u = $users->fetch_assoc();
        ?>

        <!-- Nama -->
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-semibold">Nama Lengkap</label>
          <input type="text" value="<?= htmlspecialchars($u['name']); ?>" class="mt-1 w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-sm" disabled>
          <input type="hidden" name="user_id" value="<?= $u['id']; ?>">
        </div>

        <!-- NIS -->
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-semibold">NIS</label>
          <input type="text" value="<?= htmlspecialchars($u['nis']); ?>" class="mt-1 w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-sm" disabled>
        </div>

        <!-- Kelas -->
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-semibold">Kelas</label>
          <input type="text" value="<?= htmlspecialchars($u['kelas']); ?>" class="mt-1 w-full p-2 border border-gray-300 rounded-lg bg-gray-100 text-sm" disabled>
          <input type="hidden" name="kelas" value="<?= htmlspecialchars($u['kelas']); ?>">
        </div>

        <!-- Semester -->
        <div class="mb-3">
          <label class="block text-gray-700 text-sm font-semibold">Semester</label>
          <select name="semester" required class="mt-1 w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
            <option value="">-- Pilih Semester --</option>
            <?php
            $pelajaran = $conn->query("SELECT id, semester FROM data_semester");
            while ($p = $pelajaran->fetch_assoc()) {
              echo "<option value='".htmlspecialchars($p['semester'])."'>".htmlspecialchars($p['semester'])."</option>";
            }
            ?>
          </select>
        </div>

        <!-- Extra -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-semibold">Pilihan Extra</label>
          <select name="extra" required class="mt-1 w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
            <option value="">-- Pilih Extra --</option>
            <?php
            $pelajaran = $conn->query("SELECT id, nama_extra FROM data_extra");
            while ($p = $pelajaran->fetch_assoc()) {
              echo "<option value='".htmlspecialchars($p['nama_extra'])."'>".htmlspecialchars($p['nama_extra'])."</option>";
            }
            ?>
          </select>
        </div>

        <!-- Submit -->
        <button type="submit" class="w-full bg-blue-200 hover:bg-blue-300 text-blue-700 font-semibold text-sm py-2 rounded-full transition duration-300">
          Submit
        </button>
      </form>
    </div>
  </div>

  <?php include 'footer.php'; ?>
</body>
</html>

