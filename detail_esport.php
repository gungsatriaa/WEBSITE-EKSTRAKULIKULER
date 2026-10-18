<?php
include 'author.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-Sports | SMK N 1 MAS UBUD</title>
  <link rel="icon" type="image/png" href="tikmas.png">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .slider-container {
      position: relative;
      overflow: hidden;
    }
    .slide {
      position: absolute;
      inset: 0;
      opacity: 0;
      transition: opacity 1s ease-in-out;
    }
    .slide.active {
      opacity: 1;
      z-index: 1;
    }
  </style>
</head>
<body class="bg-stone-200">

  <!-- Navbar -->
  <?php include 'navbar.php' ?>

  <!-- Konten Blog -->
  <div class="container mx-auto px-4 mt-6 md:mt-8">
    <div class="bg-white p-4 md:p-6 rounded-lg shadow">
      <h1 class="text-xl md:text-2xl font-bold mb-3">Selamat Datang di Ekstrakurikuler Atletik</h1>
      <p class="text-gray-700 text-sm md:text-base leading-relaxed">Di sini kamu bisa melihat berbagai kegiatan ekstrakurikuler yang seru di sekolah. Mulai dari Bulu Tangkis, E-Sports, Pramuka, hingga Paskibra. Jangan lewatkan momen-momen terbaik yang terekam dalam galeri slideshow di bawah!</p>
    </div>
  </div>

  <!-- Slider -->
  <div class="container mx-auto px-4 mt-4 md:mt-6">
    <div class="slider-container rounded-lg shadow h-40 sm:h-52 md:h-64 relative overflow-hidden">
      <img src="https://www.baritopost.co.id/wp-content/uploads/2018/10/10-10-Atletik.jpg" class="slide active w-full h-full object-cover rounded-lg" alt="Slide 1">
      <img src="https://organisasi.co.id/wp-content/uploads/2022/03/Atletikjawapos.com_.jpg" class="slide w-full h-full object-cover rounded-lg" alt="Slide 2">
      <img src="https://tse2.mm.bing.net/th?id=OIP.lOe0oPfXOnbekyU-uyL74wHaE8&pid=Api&P=0&h=220" class="slide w-full h-full object-cover rounded-lg" alt="Slide 3">

      <!-- Tombol navigasi -->
      <button onclick="prevSlide()" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-1 sm:p-2 text-xs sm:text-base">&#10094;</button>
      <button onclick="nextSlide()" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white bg-opacity-70 rounded-full p-1 sm:p-2 text-xs sm:text-base">&#10095;</button>
    </div>
  </div>

  <!-- Tombol Daftar -->
  <!-- Tombol Daftar -->
<div class="container mx-auto px-4 text-center mt-8 md:mt-16 mb-12">
  <a href="daftar_extra.php" class="inline-block bg-blue-200 text-blue-700 font-semibold text-sm px-6 py-3 rounded-full transition hover:bg-blue-300">Daftar</a>
</div>



  <script>
    let slideIndex = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (i === index) {
          slide.classList.add('active');
        }
      });
    }

    function nextSlide() {
      slideIndex = (slideIndex + 1) % slides.length;
      showSlide(slideIndex);
    }

    function prevSlide() {
      slideIndex = (slideIndex - 1 + slides.length) % slides.length;
      showSlide(slideIndex);
    }

    // Auto slide setiap 4 detik
    setInterval(nextSlide, 4000);
  </script>

  <?php include 'footer.php' ?>

</body>
</html>
