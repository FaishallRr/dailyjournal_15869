<?php
include("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Strand</title>
  <link rel="icon" href="./img/icon.png" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="/css/global.css" />
</head>

<body class="overflow-x-hidden">
  <div class="relative min-h-screen w-full overflow-hidden">
    <div class="absolute inset-0">
      <a href="/">
        <img src="/img/img1.jpg" alt="background" class="w-full h-full object-cover" /></a>
    </div>

    <div class="bg-transparent w-full text-white fixed top-0 left-0 z-50">
      <div class="flex justify-between items-center px-10 py-5">
        <div>
          <a href="/">
            <img src="./img/icon.png" alt="Logo" class="h-20" />
          </a>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex gap-8 text-lg font-medium">
          <a href="#" class="hover:text-gray-400 transition cursor-pointer">Home</a>
          <a href="#article" class="hover:text-gray-400 transition cursor-pointer">Article</a>
          <a href="#gallery" class="hover:text-gray-400 transition cursor-pointer">Gallery</a>
          <a href="#schedule" class="hover:text-gray-400 transition cursor-pointer">Schedule</a>
          <a href="#profile" class="hover:text-gray-400 transition cursor-pointer">Profile</a>
          <a href="./login.php" class="hover:text-gray-400 transition cursor-pointer">Login</a>
          <div class="flex gap-2 items-center mt-[-5px]">
            <a id="dark-mode"
              class="border-2 px-2 py-1 rounded-xl bg-zinc-800 border-zinc-800 text-white shadow-xl hover:bg-zinc-700 hover:border-zinc-700 transition cursor-pointer"><i
                class="fa-solid fa-moon"></i>
            </a>
            <a id="light-mode"
              class="border-2 px-2 py-1 rounded-xl bg-gray-200 border-zinc-200 text-zinc-800 shadow-xl hover:bg-zinc-300 hover:border-zinc-300 transition cursor-pointer"><i
                class="fa-solid fa-sun"></i>
            </a>
          </div>
        </div>

        <div class="md:hidden">
          <button id="burger-icon" class="text-2xl">
            <i class="fa fa-bars"></i>
          </button>
        </div>
      </div>

      <!-- Mobile menu -->
      <div id="mobile-menu"
        class="md:hidden hidden flex flex-col h-screen items-end gap-6 py-10 px-10 bg-zinc-900/90 backdrop-blur-sm fixed top-0 right-0 w-full transition-all duration-300 z-50">
        <button id="close-menu" class="text-3xl text-white mb-5 hover:text-gray-400">
          <i class="fa fa-times"></i>
        </button>

        <a href="#"
          class="block hover:text-gray-400 transition cursor-pointer text-right text-white text-lg font-medium">
          Home
        </a>
        <a href="#article"
          class="block hover:text-gray-400 transition cursor-pointer text-right text-white text-lg font-medium">
          Article
        </a>
        <a href="#gallery"
          class="block hover:text-gray-400 transition cursor-pointer text-right text-white text-lg font-medium">
          Gallery
        </a>
        <a href="#schedule"
          class="block hover:text-gray-400 transition cursor-pointer text-right text-white text-lg font-medium">
          Schedule
        </a>
        <a href="#profile"
          class="block hover:text-gray-400 transition cursor-pointer text-right text-white text-lg font-medium">
          Profile
        </a>
        <a href="./login.php"
          class="block hover:text-gray-400 transition cursor-pointer text-right text-white text-lg font-medium">
          Login
        </a>

        <div class="flex gap-3 items-center justify-end mt-6">
          <a id="dark-mode-mobile"
            class="border-2 px-3 py-2 rounded-xl bg-zinc-800 border-zinc-800 text-white shadow-md hover:bg-zinc-700 hover:border-zinc-700 transition cursor-pointer">
            <i class="fa-solid fa-moon"></i>
          </a>
          <a id="light-mode-mobile"
            class="border-2 px-3 py-2 rounded-xl bg-gray-200 border-zinc-200 text-zinc-800 shadow-md hover:bg-zinc-300 hover:border-zinc-300 transition cursor-pointer">
            <i class="fa-solid fa-sun"></i>
          </a>
        </div>
      </div>
    </div>

    <div class="relative z-10 flex justify-start items-center min-h-screen text-white px-[10vw]">
      <div class="flex flex-col max-w-[700px] justify-start items-start text-left mt-5">
        <p class="text-4xl sm:text-6xl font-bold leading-tight">
          Luxury Busbes For Coller By Prandle
        </p>
        <p class="text-sm sm:text-xl mt-4 text-gray-200">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veniam
          nulla blanditiis quidem ipsum velit voluptatum.
        </p>
        <p class="text-sm sm:text-xl mt-3 text-gray-200">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt
          rerum, culpa aut ad fuga voluptatem?
        </p>
        <div class="flex text-gray-200 gap-4 mt-3 text-sm sm:text-xl font-bold">
          <span id="tanggal"></span>
          <span id="jam"></span>
        </div>
        <div class="flex mt-8 gap-4 items-center">
          <a href=""
            class="border border-zinc-700 bg-zinc-800 rounded-full px-6 py-2 text-sm sm:text-lg text-gray-200 hover:bg-zinc-700 transition">Order
            Now</a>
          <a href="#" class="text-3xl">
            <i class="fa-brands fa-instagram"></i>
          </a>
          <a href="#" class="text-3xl">
            <i class="fa-regular fa-envelope"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-zinc-900 w-full h-[100%] sm:h-screen text-white flex justify-center items-center">
    <div
      class="flex-row sm:flex text-start items-center justify-center gap-[40px] w-[90%] max-w-[1200px] mt-[200px] mb-[200px]">
      <div class="flex flex-col gap-4 w-[40%] mt-10 justify-start sm:justify-center ml-10 sm:ml-0 mt-[-10px] mt:mt-0">
        <p class="font-bold text-3xl sm:text-4xl leading-tight">
          The Luxury Experience you'll Remember
        </p>
        <p class="text-sm sm:text-lg text-gray-300">.....</p>
        <p class="text-sm sm:text-lg text-gray-300">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt
          culpa enim aliquid repudiandae maiores cum!
        </p>
      </div>

      <div class="flex gap-4 justify-center sm:justify-start mt-20 sm:mt-0">
        <img src="/img/room1.jpg" alt="Room 1"
          class="w-[130px] h-[300px] sm:w-[300px] sm:h-[400px] object-cover rounded-xl hover:scale-105 transition-transform duration-300" />
        <img src="/img/room2.jpg" alt="Room 2"
          class="w-[130px] h-[300px] sm:w-[300px] sm:h-[400px] object-cover rounded-xl hover:scale-105 transition-transform duration-300 mt-20" />
      </div>
    </div>
  </div>

  <div
    class="bg-zinc-800 w-full min-h-screen text-white flex flex-col justify-center items-center py-20 scroll-mt-[-10px]"
    id="article">

    <div class="flex flex-col gap-4 w-[60%] text-center mb-20">
      <p class="font-bold text-3xl sm:text-4xl">Article</p>
      <p class="text-sm sm:text-lg text-gray-300">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo laborum voluptatibus possimus omnis iusto
        nihil.
      </p>
    </div>

    <!-- Wrapper flex untuk semua card -->
    <div class="flex flex-wrap gap-10 justify-center items-start w-full px-5">

      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql);

      while ($row = $hasil->fetch_assoc()) {
        ?>

        <!-- Card -->
        <div
          class="w-[70%] sm:w-[22%] bg-zinc-900 flex flex-col gap-3 border border-zinc-700 rounded-xl overflow-hidden hover:scale-105 hover:shadow-lg transition-transform duration-300">

          <img src="img/<?= $row["gambar"] ?>" class="w-full h-[200px] object-cover" alt="gambar" />

          <p class="text-xl font-bold text-center px-2"><?= $row["judul"] ?></p>

          <p class="text-sm text-center px-4 text-gray-300">
            <?= substr($row["isi"], 0, 120) ?>...
          </p>

          <p class="text-xs text-center py-3 text-gray-400 mb-4"><?= $row["tanggal"] ?></p>
        </div>

      <?php } ?>

    </div>

  </div>


  <div class="bg-zinc-900 w-full min-h-screen text-white flex flex-col justify-center items-center py-20" id="gallery">
    <div class="flex flex-col gap-4 w-[60%] text-center mb-20">
      <p class="font-bold text-3xl sm:text-4xl">
        Presents views around the villa
      </p>
      <p class="text-sm sm:text-lg text-gray-300">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci
        obcaecati consequatur esse consectetur quos neque impedit doloremque
        perferendis enim quibusdam!
      </p>
    </div>

    <?php

    $gallery = $conn->query("
    SELECT gambar 
    FROM gallery 
    ORDER BY tanggal DESC
");
    ?>

    <div class="flex flex-wrap justify-center items-center gap-6 w-[80%] mx-auto">

      <?php while ($row = $gallery->fetch_assoc()): ?>
        <img src="img/gallery/<?= htmlspecialchars($row['gambar']) ?>" alt="Gallery" class="w-40 h-80 object-cover rounded-xl
                   hover:scale-105
                   transition-transform duration-300
                   shadow-md" />
      <?php endwhile; ?>

    </div>

  </div>

  <div class="bg-zinc-800 w-full min-h-screen text-white flex flex-col justify-center items-center py-20" id="schedule">
    <div class="flex flex-col gap-4 w-[60%] text-center mb-15">
      <p class="font-bold text-3xl sm:text-4xl">
        Reservation Schedule - The Strand
      </p>
      <p class="text-sm sm:text-lg text-gray-300">
        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veritatis
        sunt illo ipsa laboriosam, saepe unde!
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7 p-6">
      <div class="keep-color bg-blue-50 border-t-4 border-blue-500 rounded-xl shadow p-6">
        <h2 class="text-center text-xl font-semibold text-zinc-800 mb-3">
          Monday
        </h2>
        <div class="space-y-3 text-center">
          <div>
            <p class="font-bold text-lg text-gray-800">09:00 - 12:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Faishal</span>
            </p>
            <p class="text-sm text-gray-500">Room: Sunset Suite</p>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">14:00 - 17:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Alif</span>
            </p>
            <p class="text-sm text-gray-500">Room: Ocean View Deluxe</p>
          </div>
        </div>
      </div>

      <div class="keep-color bg-green-50 border-t-4 border-green-500 rounded-xl shadow p-4">
        <h2 class="text-center text-xl font-semibold text-green-700 mb-3">
          Tuesday
        </h2>
        <div class="space-y-3 text-center">
          <div>
            <p class="font-bold text-lg text-gray-800">10:00 - 13:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Rani</span>
            </p>
            <p class="text-sm text-gray-500">Room: Garden View</p>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">16:00 - 20:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Bima</span>
            </p>
            <p class="text-sm text-gray-500">Room: Poolside Suite</p>
          </div>
        </div>
      </div>

      <div class="keep-color bg-red-50 border-t-4 border-red-500 rounded-xl shadow p-4">
        <h2 class="text-center text-xl font-semibold text-red-700 mb-3">
          Wednesday
        </h2>
        <div class="space-y-3 text-center">
          <div>
            <p class="font-bold text-lg text-gray-800">08:00 - 11:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Tia</span>
            </p>
            <p class="text-sm text-gray-500">Room: Horizon Suite</p>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">13:30 - 18:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Iqbal</span>
            </p>
            <p class="text-sm text-gray-500">Room: Cliffside Retreat</p>
          </div>
        </div>
      </div>

      <div class="keep-color bg-yellow-50 border-t-4 border-yellow-500 rounded-xl shadow p-4">
        <h2 class="text-center text-xl font-semibold text-yellow-700 mb-3">
          Thursday
        </h2>
        <div class="space-y-3 text-center">
          <div>
            <p class="font-bold text-lg text-gray-800">09:00 - 12:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Aisyah</span>
            </p>
            <p class="text-sm text-gray-500">Room: Seaside Loft</p>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">15:00 - 19:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Admin</span>
            </p>
            <p class="text-sm text-gray-500">Room: Oceanfront Suite</p>
          </div>
        </div>
      </div>

      <div class="keep-color bg-purple-50 border-t-4 border-purple-500 rounded-xl shadow p-4">
        <h2 class="text-center text-xl font-semibold text-purple-700 mb-3">
          Friday
        </h2>
        <div class="space-y-3 text-center">
          <div>
            <p class="font-bold text-lg text-gray-800">08:30 - 12:30</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Dimas</span>
            </p>
            <p class="text-sm text-gray-500">Room: Lagoon Villa</p>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">14:00 - 17:30</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Laila</span>
            </p>
            <p class="text-sm text-gray-500">Room: Garden Residence</p>
          </div>
        </div>
      </div>

      <div class="keep-color bg-pink-50 border-t-4 border-pink-500 rounded-xl shadow p-4">
        <h2 class="text-center text-xl font-semibold text-pink-700 mb-3">
          Saturday
        </h2>
        <div class="space-y-3 text-center">
          <div>
            <p class="font-bold text-lg text-gray-800">09:00 - 14:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Rafi</span>
            </p>
            <p class="text-sm text-gray-500">Room: Infinity Pool Suite</p>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">16:00 - 21:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Nisa</span>
            </p>
            <p class="text-sm text-gray-500">Room: Private Garden Villa</p>
          </div>
        </div>
      </div>

      <div class="keep-color bg-orange-50 border-t-4 border-orange-500 rounded-xl shadow p-4">
        <h2 class="text-center text-xl font-semibold text-orange-700 mb-3">
          Sunday
        </h2>
        <div class="space-y-3 text-center">
          <div>
            <p class="font-bold text-lg text-gray-800">10:00 - 15:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Farel</span>
            </p>
            <p class="text-sm text-gray-500">Room: Coral Bay Suite</p>
          </div>
          <div>
            <p class="font-bold text-lg text-gray-800">17:00 - 20:00</p>
            <p class="text-gray-700">
              Booked by: <span class="font-medium">Dina</span>
            </p>
            <p class="text-sm text-gray-500">Room: Beachfront Pavilion</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-zinc-900 w-full min-h-screen text-white flex flex-col justify-center items-center py-20" id="profile">
    <!-- Bagian judul boleh ikut berubah -->
    <div class="flex flex-col gap-4 w-[60%] text-center mb-20">
      <p class="font-bold text-3xl sm:text-4xl">Profile - Owner</p>
    </div>

    <!-- Bagian isi profil (tidak berubah tema) -->
    <div
      class="no-theme-change flex flex-col md:flex-row items-center bg-gradient-to-br from-[#1f1f1f] to-[#2a2a2a] rounded-3xl shadow-2xl p-8 md:p-12 w-[90%] md:w-[70%] lg:w-[55%] hover:shadow-zinc-700/50 transition-all duration-300">
      <!-- Foto Profil -->
      <div class="flex-shrink-0 mb-8 md:mb-0 md:mr-10 relative group">
        <div
          class="absolute inset-0 bg-[#3a3a3a] rounded-full blur-xl opacity-40 group-hover:opacity-60 transition duration-300">
        </div>
        <img src="./img/profile.png" alt="Foto Owner"
          class="relative w-44 h-44 rounded-full object-cover border-4 border-[#444] shadow-lg group-hover:scale-105 transition-transform duration-300" />
      </div>

      <!-- Informasi Profil -->
      <div class="text-center md:text-left space-y-3 text-gray-300">
        <h2 class="text-3xl font-bold tracking-wide">
          Faishal Rasyid Rusianto
        </h2>
        <p class="text-gray-400 mb-5 text-lg">
          Owner Villa & Website
          <span class="text-blue-400">The Strand Booking</span>
        </p>

        <div class="space-y-2 text-base">
          <p>
            <span class="font-semibold text-gray-300">📧 Email:</span>
            faishalrasyid@example.com
          </p>
          <p>
            <span class="font-semibold text-gray-300">📱 Telepon:</span>
            +62 812 3456 7890
          </p>
          <p>
            <span class="font-semibold text-gray-300">📍 Alamat:</span>
            Jl. Diponegoro No. 45, Semarang
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="bg-zinc-200 w-full py-20 text-white flex justify-center">
    <div class="flex flex-col md:flex-row justify-between items-center w-[90%] max-w-screen-lg">
      <div>
        <img src="./img/icon.png" alt="icon"
          class="w-24 sm:w-32 md:w-40 mt-[-70px] sm:mt-[-60px] md:mt-[-50px] object-contain" />
      </div>

      <div class="flex flex-col items-center md:items-start text-center md:text-left gap-4 mt-6 md:mt-0">
        <p class="text-sm text-gray-600 font-medium">
          Luxury Busbes For Coller By Prandle
        </p>
        <div class="flex gap-6">
          <a href="#" class="text-2xl hover:text-gray-800">
            <i class="fa-brands fa-instagram text-gray-600"></i>
          </a>
          <a href="#" class="text-2xl hover:text-gray-800">
            <i class="fa-regular fa-envelope text-gray-600"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="./script.js"></script>
</body>

</html>