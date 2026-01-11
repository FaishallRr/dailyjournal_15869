<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link rel="icon" href="img/logo.png" />

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            margin-bottom: 120px;
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 120px;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- NAVBAR -->
    <nav class="sticky top-0 bg-zinc-700 shadow-md z-50">
        <div class="max-w-6xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="." class="text-2xl font-bold text-gray-300 tracking-wide">
                The Strand
            </a>

            <!-- Mobile button -->
            <button id="menuBtn" class="md:hidden text-gray-300 text-3xl">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Desktop menu -->
            <ul id="menuList" class="hidden md:flex gap-8 items-center">

                <!-- Dashboard -->
                <li>
                    <a href="admin.php?page=dashboard"
                        class="flex items-center gap-2 text-gray-300 hover:text-gray-400 transition duration-300 text-[18px]">
                        Dashboard
                    </a>
                </li>

                <!-- Article -->
                <li>
                    <a href="admin.php?page=article"
                        class="flex items-center gap-2 text-gray-300 hover:text-gray-400 transition duration-300 text-[18px]">
                        Article
                    </a>
                </li>

                <!-- Gallery -->
                <li>
                    <a href="admin.php?page=gallery"
                        class="flex items-center gap-2 text-gray-300 hover:text-gray-400 transition duration-300 text-[18px]">
                        Gallery
                    </a>
                </li>


                <!-- User -->
                <li>
                    <a href="admin.php?page=user"
                        class="flex items-center gap-2 text-gray-300 hover:text-gray-400 transition duration-300 text-[18px]">
                        User
                    </a>
                </li>

                <!-- USER DROPDOWN -->
                <li class="relative group cursor-pointer z-50">
                    <button id="userMenuBtn"
                        class="flex items-center gap-2 text-gray-300 font-semibold text-[18px] hover:text-gray-400 transition duration-300">
                        <?= $_SESSION['username'] ?>
                        <i class="fa-solid fa-caret-down mt-1"></i>
                    </button>

                    <ul id="userDropdown"
                        class="absolute hidden right-0 bg-white shadow-lg rounded mt-2 py-2 w-36 z-[9999]">
                        <li>
                            <a href="logout.php" class="block px-4 py-2 hover:bg-gray-50">
                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        <!-- MOBILE MENU -->
        <ul id="mobileMenu" class="hidden flex flex-col bg-red-100 px-6 py-4 space-y-3 md:hidden">

            <a href="admin.php?page=dashboard" class="flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>

            <a href="admin.php?page=article" class="flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-file-lines"></i> Article
            </a>

            <a href="admin.php?page=gallery" class="flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-camera"></i> Gallery
            </a>

            <a href="admin.php?page=user" class="flex items-center gap-2 text-gray-700">
                <i class="fa-solid fa-users"></i> User
            </a>

            <a href="logout.php" class="flex items-center gap-2 text-red-600 font-semibold">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </ul>
    </nav>

    <!-- CONTENT -->
    <!-- content begin -->
    <section id="content" class="px-3 sm:px-4 md:px-6 lg:px-8 py-6">
        <div class="
        max-w-6xl mx-auto
        flex flex-col
        lg:flex-row
        gap-4 lg:gap-6
    ">

            <!-- CONTENT -->
            <div class="w-full">
                <?php if (isset($_GET['page'])): ?>

                    <h4 class="text-lg sm:text-xl md:text-2xl lg:text-3xl 
                           font-semibold text-gray-700
                           pb-2 border-b border-red-300 mb-4">
                        <?= ucfirst($_GET['page']) ?>
                    </h4>

                    <?php include($_GET['page'] . ".php"); ?>

                <?php else: ?>

                    <h4 class="text-lg sm:text-xl md:text-2xl lg:text-3xl 
                           font-semibold
                           pb-2 border-b border-red-300 mb-4">
                        Dashboard
                    </h4>

                    <?php include("dashboard.php"); ?>

                <?php endif; ?>
            </div>

        </div>
    </section>



    <!-- content end -->


    <!-- FOOTER -->
    <footer class="bg-zinc-700 shadow-inner py-6 text-center">
        <div class="flex justify-center gap-5 text-3xl">

            <a href="https://www.instagram.com/udinusofficial" class="text-gray-300 hover:text-red-600">
                <i class="fa-brands fa-instagram"></i>
            </a>

            <a href="https://twitter.com/udinusofficial" class="text-gray-300 hover:text-red-600">
                <i class="fa-brands fa-x-twitter"></i>
            </a>

            <a href="https://wa.me/+62812685577" class="text-gray-300 hover:text-red-600">
                <i class="fa-brands fa-whatsapp"></i>
            </a>

        </div>

        <div class="mt-3 font-medium text-gray-300">
            Aprilyani Nur Safitri © 2023
        </div>
    </footer>

    <script>
        /* Mobile menu toggle */
        const menuBtn = document.getElementById("menuBtn");
        const mobileMenu = document.getElementById("mobileMenu");

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        /* User dropdown toggle */
        const userMenuBtn = document.getElementById("userMenuBtn");
        const userDropdown = document.getElementById("userDropdown");

        userMenuBtn.addEventListener("click", () => {
            userDropdown.classList.toggle("hidden");
        });

        // Menutup dropdown jika klik di luar
        document.addEventListener("click", (e) => {
            if (!userMenuBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add("hidden");
            }
        });
    </script>

</body>

</html>