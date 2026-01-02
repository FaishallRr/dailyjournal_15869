const burgerIcon = document.getElementById("burger-icon");
const mobileMenu = document.getElementById("mobile-menu");
const closeMenu = document.getElementById("close-menu");
burgerIcon.addEventListener("click", () => {
  mobileMenu.classList.remove("hidden");
});
closeMenu.addEventListener("click", () => {
  mobileMenu.classList.add("hidden");
});

//

window.setTimeout("tampilWaktu()", 1000);
function tampilWaktu() {
  const waktu = new Date();
  const bulan = waktu.getMonth() + 1;

  setTimeout("tampilWaktu()", 1000);
  document.getElementById("tanggal").innerHTML =
    waktu.getDate() + "/" + bulan + "/" + waktu.getFullYear();
  document.getElementById("jam").innerHTML =
    waktu.getHours() + ":" + waktu.getMinutes() + ":" + waktu.getSeconds();
}
//

// dark and light mode
document.body.classList.add("transition-colors", "duration-500");

// Ambil semua tombol dark/light mode (desktop + mobile)
const darkButtons = document.querySelectorAll("#dark-mode, #dark-mode-mobile");
const lightButtons = document.querySelectorAll(
  "#light-mode, #light-mode-mobile"
);

function isColorCard(el) {
  return el.closest(
    "[class*='bg-blue-'], [class*='bg-green-'], [class*='bg-red-'], [class*='bg-yellow-'], [class*='bg-purple-'], [class*='bg-pink-'], [class*='bg-orange-']"
  );
}

function setDarkMode() {
  document.body.classList.remove("bg-gray-300", "bg-gray-400", "text-black");
  document.body.classList.add("bg-zinc-900", "text-gray-300");

  const profile = document.getElementById("profile");
  if (profile) {
    profile.classList.remove("bg-gray-300");
    profile.classList.add("bg-zinc-900");
  }

  document.querySelectorAll("[class*='bg-']").forEach((el, index) => {
    if (
      el.closest(".no-theme-change") ||
      el.id === "profile" || // jangan ubah isi profile
      el.closest(".bg-transparent") || // navbar
      el.closest(".relative.z-10") || // hero
      el.closest(".bg-zinc-200") || // footer
      isColorCard(el) // card berwarna
    )
      return;

    el.classList.remove(
      "bg-white",
      "bg-gray-300",
      "bg-gray-400",
      "bg-zinc-200",
      "bg-zinc-300",
      "bg-zinc-400"
    );

    el.classList.add(index % 2 === 0 ? "bg-zinc-900" : "bg-zinc-800");
  });

  document.querySelectorAll("[class*='text-']").forEach((el) => {
    if (
      el.closest(".no-theme-change") ||
      el.closest("#profile") || // jangan ubah teks di profile
      el.closest(".bg-transparent") ||
      el.closest(".relative.z-10") ||
      el.closest(".bg-zinc-200") ||
      isColorCard(el)
    )
      return;

    el.classList.remove(
      "text-gray-200",
      "text-gray-300",
      "text-gray-400",
      "text-gray-500",
      "text-gray-600",
      "text-gray-700",
      "text-gray-800",
      "text-white",
      "text-black"
    );
    el.classList.add("text-gray-300");
  });
}

// Fungsi Light Mode
function setLightMode() {
  document.body.classList.remove("bg-zinc-900", "bg-zinc-800", "text-gray-300");
  document.body.classList.add("bg-gray-300", "text-black");

  // 🌤️ Ganti background #profile
  const profile = document.getElementById("profile");
  if (profile) {
    profile.classList.remove("bg-zinc-900");
    profile.classList.add("bg-gray-300");
  }

  document.querySelectorAll("[class*='bg-']").forEach((el, index) => {
    if (
      el.closest(".no-theme-change") ||
      el.id === "profile" ||
      el.closest(".bg-transparent") ||
      el.closest(".relative.z-10") ||
      el.closest(".bg-zinc-200") ||
      isColorCard(el)
    )
      return;

    el.classList.remove("bg-zinc-900", "bg-zinc-800");
    el.classList.add(index % 2 === 0 ? "bg-gray-300" : "bg-gray-400");
  });

  document.querySelectorAll("[class*='text-']").forEach((el) => {
    if (
      el.closest(".no-theme-change") ||
      el.closest("#profile") || // teks profil tetap
      el.closest(".bg-transparent") ||
      el.closest(".relative.z-10") ||
      el.closest(".bg-zinc-200") ||
      isColorCard(el)
    )
      return;

    el.classList.remove("text-gray-300", "text-white");
    el.classList.add("text-gray-800");
  });
}

// Aktifkan semua tombol
darkButtons.forEach((btn) => btn.addEventListener("click", setDarkMode));
lightButtons.forEach((btn) => btn.addEventListener("click", setLightMode));

//

// Fungsi untuk membuka modal Tambah
function openModalTambah() {
  const modal = document.getElementById("modalTambah");
  const modalContent = modal.querySelector(".modal-content");
  modal.classList.remove("hidden", "opacity-0", "pointer-events-none");
  modal.classList.add("opacity-100");
  modalContent.classList.remove("scale-95", "opacity-0");
  modalContent.classList.add("scale-100", "opacity-100");
}

// Fungsi untuk menutup modal Tambah
function closeModalTambah() {
  const modal = document.getElementById("modalTambah");
  const modalContent = modal.querySelector(".modal-content");
  modal.classList.add("opacity-0", "pointer-events-none");
  modalContent.classList.add("scale-95", "opacity-0");
  setTimeout(() => {
    modal.classList.add("hidden");
  }, 500);
}

// Fungsi untuk membuka modal Hapus
function openModalHapus(modalId) {
  const modal = document.getElementById(modalId);
  const modalContent = modal.querySelector(".modal-content");
  modal.classList.remove("opacity-0", "pointer-events-none");
  modal.classList.add("opacity-100");
  modalContent.classList.remove("scale-95", "opacity-0");
  modalContent.classList.add("scale-100", "opacity-100");
}

// Fungsi untuk menutup modal Hapus
function closeModalHapus(modalId) {
  const modal = document.getElementById(modalId);
  const modalContent = modal.querySelector(".modal-content");
  modal.classList.add("opacity-0", "pointer-events-none");
  modalContent.classList.add("scale-95", "opacity-0");
  setTimeout(() => {
    modal.classList.add("hidden");
  }, 500);
}
