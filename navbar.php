<nav class="fixed top-0 left-0 w-full z-50 bg-white flex justify-between items-center px-6 py-4 border-b border-gray-200">
  <div class="text-blue-400 font-bold text-base sm:text-lg">smkn1masubud.</div>

  <!-- Desktop Menu -->
  <div class="hidden md:flex items-center space-x-6 text-xs sm:text-sm font-semibold">
    <a href="main.php" class="hover:text-blue-500">Dashboard</a>
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
<div id="mobile-menu" class="md:hidden hidden fixed top-14 left-0 w-full bg-white text-xs sm:text-sm font-semibold px-6 py-6 space-y-4 border-t border-gray-200 z-40">
  <a href="main.php" class="block text-center hover:text-blue-500">Dashboard</a>
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