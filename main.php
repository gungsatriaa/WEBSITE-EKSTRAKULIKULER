<?php
include 'author.php';
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$role = $_SESSION['role'];
$name = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .no-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .no-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>
<body class="bg-stone-200 text-gray-900">
  <!-- Navbar -->
  <!-- NAVBAR -->
  <nav class="fixed top-0 left-0 w-full z-50 bg-gray-100 flex justify-between items-center px-6 py-4 border-b border-gray-200">
  <div class="text-blue-400 font-bold text-base sm:text-lg">smkn1masubud.</div>

  <!-- Desktop Menu -->
  <div class="hidden md:flex items-center space-x-6 text-xs sm:text-sm font-semibold">
    <a href="#home" class="hover:text-blue-500">Dashboard</a>
    <a href="#about" class="hover:text-blue-500">About Me</a>
    <a href="#extra" class="hover:text-blue-500">Extrakurikuler</a>
    <a href="profile.php" class="block text-center hover:text-blue-500">Profile</a>
    <form action="logout.php" method="POST">
      <button type="submit" class="bg-pink-200 hover:bg-pink-300 text-pink-700 font-semibold text-xs sm:text-sm px-5 py-2 rounded-full transition duration-300">
        Logout
      </button>
    </form>
  </div>

  <!-- Hamburger -->
  <div class="md:hidden flex items-center">
    <button id="hamburger-button" class="focus:outline-none">
      <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor"
        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
  </div>
</nav>

<!-- MOBILE MENU -->
<div id="mobile-menu" class="md:hidden hidden fixed top-14 left-0 w-full bg-gray-100 text-xs sm:text-sm font-semibold px-6 py-6 space-y-4 border-t border-gray-200 z-40">
  <a href="#home" class="block text-center hover:text-blue-500">Dashboard</a>
  <a href="#about" class="block text-center hover:text-blue-500">About Me</a>
  <a href="#extra" class="block text-center hover:text-blue-500">Extrakurikuler</a>
  <a href="profile.php" class="block text-center hover:text-blue-500">Profile</a>
  <form action="logout.php" method="POST" class="w-full px-4">
    <button type="submit" class="bg-pink-200 hover:bg-pink-300 text-pink-700 font-semibold text-xs sm:text-sm px-5 py-2 w-full rounded-full transition duration-300">
      Logout
    </button>
  </form>
</div>

<!-- KONTEN -->
<div class="pt-20 px-6">
  <!-- isi halaman -->
</div>

<!-- SCRIPT TOGGLE -->
<script>
  const hamburger = document.getElementById('hamburger-button');
  const mobileMenu = document.getElementById('mobile-menu');

  hamburger.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>



  <!-- Hero Section -->
  <section class="flex flex-col-reverse md:flex-row items-center justify-between px-6 md:px-20 max-w-7xl mx-auto md:min-h-screen py-10 md:py-20 gap-4 md:gap-20" id="home">

  
  <!-- Teks -->
  <div class="space-y-4 max-w-xl text-center md:text-left">
    <h2 class="text-blue-400 text-xl font-semibold">Hallo <?= htmlspecialchars($name); ?>, Selamat Datang di</h2>
    <h1 class="text-5xl font-extrabold text-gray-900">SMK N 1 MAS UBUD</h1>
    <h3 class="text-2xl font-medium text-gray-600">
      Sekolah Extrakulikuler <span class="text-black font-semibold">Ternyaman</span>
    </h3>
    <p class="text-gray-500 text-lg">
      Menjadi anak yang Berbakat di Bidangnya itu hebat bukan?
      <span class="font-bold text-black">Bangettt!</span>
    </p>
    <a href="#extra" class="inline-block bg-blue-200 hover:bg-blue-300 text-blue-700 font-semibold text-sm px-6 py-2 rounded-full transition duration-300">
      Daftar Sekarang
    </a>
  </div>

  <!-- Gambar logo -->
  <div class="flex justify-center md:justify-end">
  <img src="tikmas.png" alt="Logo SMK N 1 MAS UBUD" class="w-32 md:w-[300px] h-auto drop-shadow-lg mx-auto md:mx-0">

  </div>

</section>







  <!-- Features Section -->
  <section class="bg-stone-200 py-16 px-8" id="about">
    <div class="max-w-6xl mx-auto text-center">
      <h2 class="text-3xl font-bold mb-6">Kenapa Harus SMK N 1 MAS UBUD?</h2>
      <div class="grid md:grid-cols-3 gap-10 mt-10">
        <div class="p-6 bg-gray-100 rounded-xl shadow">
          <h3 class="text-xl font-semibold mb-2">Beragam Ekstrakurikuler</h3>
          <p>Mulai dari seni, olahraga, hingga teknologi. Semua ada!</p>
        </div>
        <div class="p-6 bg-gray-100 rounded-xl shadow">
          <h3 class="text-xl font-semibold mb-2">Pembinaan Intensif</h3>
          <p>Didampingi mentor profesional dan berpengalaman di bidangnya.</p>
        </div>
        <div class="p-6 bg-gray-100 rounded-xl shadow">
          <h3 class="text-xl font-semibold mb-2">Lingkungan Nyaman</h3>
          <p>Tempat yang asyik dan aman untuk tumbuh dan berkembang.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Extrakurikuler Terkini Section -->
<section class="bg-stone-200 py-20 px-4 md:px-8" id="extra">
  <div class="max-w-7xl mx-auto">
    <h2 class="text-2xl md:text-3xl font-bold text-center mb-4">Extrakulikuler Terkini</h2>
    <p class="text-center text-gray-500 mb-10 md:mb-12">
      Silahkan kalian bisa membaca artikel yang saya sediakan dibawah ini.
    </p>

    <!-- Navigasi & Slider -->
    <div class="relative">
      <!-- Tombol Navigasi -->
      <button id="prev"
        class="hidden md:flex absolute left-0 top-1/2 -translate-y-1/2 bg-white shadow p-2 rounded-full text-indigo-500 z-10 hover:scale-110 transition">
        &#10094;
      </button>

      <!-- Wrapper Slider -->
      <div id="slider"
        class="flex overflow-x-auto space-x-4 md:space-x-6 scroll-smooth px-2 md:px-8 py-4 md:mx-12 no-scrollbar snap-x snap-mandatory">
        
        <!-- CARD TEMPLATE -->
        <div class="bg-gray-100 rounded-xl shadow-lg w-64 sm:w-72 md:w-96 shrink-0 snap-start">
          <img src="https://imgsrv2.voi.id/GkKno6ge5BtIRjxcngtX_YvCx8ttF5SXg86aXRDl-Nc/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy8yODcxODgvMjAyMzA2MTcyMjAxLW1haW4uY3JvcHBlZF8xNjg3MDE0MTI1LmpwZWc.jpg"
            class="rounded-t-xl w-full h-48 object-cover" />
          <div class="p-4">
            <span class="text-sm bg-pink-200 text-pink-700 font-medium px-3 py-1 rounded-full">#1</span>
            <h3 class="font-bold text-xl mt-3">Bulu Tangkis</h3>
            <p class="text-gray-600 mt-2 text-sm">Bertanggung jawab atas tampilan visual dan pengalaman pengguna melalui desain yang menarik.</p>
            <button onclick="window.location.href='detail_bultang.php'"
              class="mt-4 inline-flex items-center justify-center w-8 h-8 rounded-full border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white transition">
              ➜
            </button>
          </div>
        </div>

        <div class="bg-gray-100 rounded-xl shadow-lg w-64 sm:w-72 md:w-96 shrink-0 snap-start">
          <img src="https://www.devteam.space/wp-content/uploads/2022/04/What-is-Esports.jpg"
            class="rounded-t-xl w-full h-48 object-cover" />
          <div class="p-4">
            <span class="text-sm bg-pink-200 text-pink-700 font-medium px-3 py-1 rounded-full">#2</span>
            <h3 class="font-bold text-xl mt-3">E-Sports</h3>
            <p class="text-gray-600 mt-2 text-sm">Bertanggung jawab atas tampilan visual dan pengalaman pengguna melalui desain yang menarik.</p>
            <button onclick="window.location.href='detail_esport.php'"
              class="mt-4 inline-flex items-center justify-center w-8 h-8 rounded-full border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white transition">
              ➜
            </button>
          </div>
        </div>

        <div class="bg-gray-100 rounded-xl shadow-lg w-64 sm:w-72 md:w-96 shrink-0 snap-start">
          <img src="https://image.kemenpora.go.id/images/content/2023/05/10/3503/6040Menang-2-1-Atas-Kamboja--Timnas-Indonesia-Kunci-Juara-Grup-A-dan-Lolos-ke-Semifinal-SEA-Games-2023sh.jpg"
            class="rounded-t-xl w-full h-48 object-cover" />
          <div class="p-4">
            <span class="text-sm bg-pink-200 text-pink-700 font-medium px-3 py-1 rounded-full">#3</span>
            <h3 class="font-bold text-xl mt-3">Sepak Bola</h3>
            <p class="text-gray-600 mt-2 text-sm">Bertanggung jawab atas tampilan visual dan pengalaman pengguna melalui desain yang menarik.</p>
            <button onclick="window.location.href='detail_sepakbola.php'"
              class="mt-4 inline-flex items-center justify-center w-8 h-8 rounded-full border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white transition">
              ➜
            </button>
          </div>
        </div>

        <div class="bg-gray-100 rounded-xl shadow-lg w-64 sm:w-72 md:w-96 shrink-0 snap-start">
          <img src="https://img.okezone.com/content/2023/02/06/43/2759602/tugas-setter-dalam-permainan-bola-voli-6g9UBVqGkN.jpg"
            class="rounded-t-xl w-full h-48 object-cover" />
          <div class="p-4">
            <span class="text-sm bg-pink-200 text-pink-700 font-medium px-3 py-1 rounded-full">#4</span>
            <h3 class="font-bold text-xl mt-3">Volly</h3>
            <p class="text-gray-600 mt-2 text-sm">Bertanggung jawab atas tampilan visual dan pengalaman pengguna melalui desain yang menarik.</p>
            <button onclick="window.location.href='detail_volly.php'"
              class="mt-4 inline-flex items-center justify-center w-8 h-8 rounded-full border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white transition">
              ➜
            </button>
          </div>
        </div>

        <div class="bg-gray-100 rounded-xl shadow-lg w-64 sm:w-72 md:w-96 shrink-0 snap-start">
          <img src="https://static.vecteezy.com/system/resources/previews/024/603/811/non_2x/rock-music-concert-background-illustration-ai-generative-free-photo.jpg"
            class="rounded-t-xl w-full h-48 object-cover" />
          <div class="p-4">
            <span class="text-sm bg-pink-200 text-pink-700 font-medium px-3 py-1 rounded-full">#5</span>
            <h3 class="font-bold text-xl mt-3">Band</h3>
            <p class="text-gray-600 mt-2 text-sm">Bertanggung jawab atas tampilan visual dan pengalaman pengguna melalui desain yang menarik.</p>
            <button onclick="window.location.href='detail_band.php'"
              class="mt-4 inline-flex items-center justify-center w-8 h-8 rounded-full border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white transition">
              ➜
            </button>
          </div>
        </div>

        <div class="bg-gray-100 rounded-xl shadow-lg w-64 sm:w-72 md:w-96 shrink-0 snap-start">
          <img src="https://cdn-s-www.lalsace.fr/images/59574BEB-43B2-4C28-84E5-8E95C873E6D6/NW_raw/le-basket-va-devoir-attendre-avant-de-reprendre-normalement-dans-l-hexagone-ye-aung-thu-afp-1600978742.jpg"
            class="rounded-t-xl w-full h-48 object-cover" />
          <div class="p-4">
            <span class="text-sm bg-pink-200 text-pink-700 font-medium px-3 py-1 rounded-full">#6</span>
            <h3 class="font-bold text-xl mt-3">Basket</h3>
            <p class="text-gray-600 mt-2 text-sm">Bertanggung jawab atas tampilan visual dan pengalaman pengguna melalui desain yang menarik.</p>
            <button onclick="window.location.href='detail_basket.php'"
              class="mt-4 inline-flex items-center justify-center w-8 h-8 rounded-full border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white transition">
              ➜
            </button>
          </div>
        </div>

        <div class="bg-gray-100 rounded-xl shadow-lg w-64 sm:w-72 md:w-96 shrink-0 snap-start">
          <img src="https://www.baritopost.co.id/wp-content/uploads/2018/10/10-10-Atletik.jpg"
            class="rounded-t-xl w-full h-48 object-cover" />
          <div class="p-4">
            <span class="text-sm bg-pink-200 text-pink-700 font-medium px-3 py-1 rounded-full">#7</span>
            <h3 class="font-bold text-xl mt-3">Atletik</h3>
            <p class="text-gray-600 mt-2 text-sm">Bertanggung jawab atas tampilan visual dan pengalaman pengguna melalui desain yang menarik.</p>
            <button onclick="window.location.href='detail_atletik.php'"
              class="mt-4 inline-flex items-center justify-center w-8 h-8 rounded-full border border-indigo-500 text-indigo-500 hover:bg-indigo-500 hover:text-white transition">
              ➜
            </button>
          </div>
        </div>

        <!-- Copy/paste card lainnya sesuai kebutuhan -->
        <!-- ... SEMUA CARD TETAP DI SINI TANPA PERUBAHAN BESAR -->

      </div>

      <!-- Tombol Navigasi -->
      <button id="next"
        class="hidden md:flex absolute right-0 top-1/2 -translate-y-1/2 bg-white shadow p-2 rounded-full text-indigo-500 z-10 hover:scale-110 transition">
        &#10095;
      </button>
    </div>

    <!-- CTA Bawah -->
    <div class="text-center mt-12 md:mt-16 space-y-4 sm:space-y-0 sm:space-x-4">
      <a href="daftar_extra.php"
        class="inline-block bg-blue-200 text-blue-700 font-semibold text-sm px-6 py-2 rounded-full transition hover:bg-blue-300">Daftar</a>

      <?php if ($role == 'admin'): ?>
        <a href="view_data.php"
          class="inline-block bg-blue-200 text-blue-700 font-semibold text-sm px-6 py-2 rounded-full transition hover:bg-blue-300">Lihat Daftar</a>
        <a href="view_users.php"
          class="inline-block bg-blue-200 text-blue-700 font-semibold text-sm px-6 py-2 rounded-full transition hover:bg-blue-300">Lihat Users</a>
      <?php endif; ?>
    </div>

  </div>

  <script>
  const slider = document.getElementById('slider');
  const nextBtn = document.getElementById('next');
  const prevBtn = document.getElementById('prev');

  // Dapatkan lebar satu card (card pertama)
  const card = slider.querySelector('.shrink-0');
  const cardStyle = getComputedStyle(card);
  const cardMargin = parseInt(cardStyle.marginRight) || 16; // fallback jika tidak pakai margin
  const cardWidth = card.offsetWidth + cardMargin;

  nextBtn.addEventListener('click', () => {
    slider.scrollBy({
      left: cardWidth,
      behavior: 'smooth'
    });
  });

  prevBtn.addEventListener('click', () => {
    slider.scrollBy({
      left: -cardWidth,
      behavior: 'smooth'
    });
  });
</script>



</section>



  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-12">
  <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-8">
    
  
    <div>
      <h2 class="text-xl font-bold mb-2">SMK N 1 MAS Ubud</h2>
      <h3 class="text-md font-semibold mb-2 text-gray-400">Hubungi saya</h3>
      <p class="text-sm text-gray-300">smkn1masubud@gmail.com</p>
      <p class="text-sm text-gray-300">Jl. Raya Ambarawati | Mas | Ubud</p>
      <p class="text-sm text-gray-300">Bali</p>
    </div>

    
    <div>
      <h3 class="text-md font-semibold mb-2">Tautan</h3>
      <ul class="space-y-1 text-gray-300 text-sm">
        <li><a href="#home" class="hover:text-white">Instagram</a></li>
        <li><a href="#about" class="hover:text-white">Twitter</a></li>
        <li><a href="#extra" class="hover:text-white">Facebook</a></li>
      </ul>
    </div>
    
  </div>

  <div class="mt-10 border-t border-gray-700 pt-6 text-center text-sm text-gray-500">
    &copy; 2025 Grubug Grup XI PPLG. All rights reserved.
  </div>
</footer>

</body>
</html>
