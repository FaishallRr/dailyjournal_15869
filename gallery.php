<?php
include "koneksi.php";
include "upload_foto.php";
?>

<div class="max-w-6xl mx-auto mb-40 px-4">

    <button onclick="openModalTambah()" class="inline-flex items-center gap-2
        px-4 py-2 bg-zinc-700 text-white rounded-xl
        text-sm font-medium hover:scale-[1.03] transition">
        ＋ Tambah Gallery
    </button>

    <div id="gallery_data" class="mt-6"></div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah" class="fixed inset-0 hidden z-50
    flex items-center justify-center
    bg-black/60 backdrop-blur-sm px-4">

    <div class="bg-white rounded-2xl w-full max-w-md shadow-xl animate-fadeIn">
        <form method="post" enctype="multipart/form-data">

            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="font-bold text-gray-700 text-lg">Tambah Gallery</h2>
                <button type="button" onclick="closeModalTambah()" class="w-9 h-9 flex items-center justify-center
                    rounded-full bg-zinc-100 hover:bg-zinc-200 transition">
                    ✕
                </button>
            </div>

            <div class="p-4 space-y-3">
                <input type="file" name="gambar" required class="w-full text-sm border rounded-lg p-2">
            </div>

            <div class="p-4 border-t text-right">
                <button name="simpan" class="px-4 py-2 bg-zinc-700 hover:bg-zinc-800
                    text-white rounded-xl text-sm font-medium transition">
                    Simpan
                </button>
            </div>

        </form>
    </div>
</div>

<!-- ================= MODAL EDIT & HAPUS ================= -->
<?php
$q = $conn->query("SELECT * FROM gallery ORDER BY tanggal DESC");
while ($row = $q->fetch_assoc()):
    ?>

    <!-- ===== EDIT ===== -->
    <div id="edit<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden flex items-center justify-center
    bg-black/60 backdrop-blur-sm px-4 overflow-y-auto">

        <div class="bg-white rounded-2xl w-[90%] sm:w-[80%] md:w-[60%] lg:w-[50%] max-w-3xl shadow-xl animate-fadeIn
        max-h-[95vh] overflow-y-auto mx-auto">
            <form method="post" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">

                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="font-bold text-gray-700 text-lg">Edit Gallery</h2>
                    <button type="button" onclick="closeModalEdit('edit<?= $row['id'] ?>')" class="w-9 h-9 flex items-center justify-center
                    rounded-full bg-zinc-100 hover:bg-zinc-200 transition">
                        ✕
                    </button>
                </div>

                <div class="p-4 space-y-3">
                    <?php if ($row['gambar'] && file_exists("img/gallery/" . $row['gambar'])): ?>
                        <img src="img/gallery/<?= $row['gambar'] ?>"
                            class="w-full rounded-xl shadow mb-2 object-cover max-h-[400px] mx-auto">
                    <?php endif; ?>

                    <input type="file" name="gambar" class="w-full text-sm border rounded-lg p-2">
                </div>

                <div class="p-4 border-t text-right">
                    <button name="update" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700
                    text-white rounded-xl text-sm font-medium transition">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>


    <!-- ===== HAPUS ===== -->
    <div id="hapus<?= $row['id'] ?>" class="fixed inset-0 hidden z-50
    flex items-center justify-center
    bg-black/60 backdrop-blur-sm px-4">

        <div class="bg-white rounded-2xl w-full max-w-md
        p-6 shadow-xl animate-fadeIn">

            <div class="flex justify-between items-start mb-4">
                <h3 class="font-bold text-gray-700 text-lg">
                    Hapus Gallery
                </h3>
                <button onclick="closeModalHapus('hapus<?= $row['id'] ?>')" class="w-9 h-9 flex items-center justify-center
                rounded-full bg-zinc-100 hover:bg-zinc-200 transition">
                    ✕
                </button>
            </div>

            <div class="flex gap-3">
                <div class="w-10 h-10 flex items-center justify-center
                rounded-full bg-red-100 text-red-600 font-bold">
                    !
                </div>
                <p class="text-zinc-700 mt-1">
                    Yakin ingin menghapus gambar ini?
                </p>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button onclick="closeModalHapus('hapus<?= $row['id'] ?>')" class="px-4 py-2 border rounded-xl text-sm
                hover:bg-zinc-100 transition">
                    Batal
                </button>

                <form method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">

                    <button name="hapus" class="px-4 py-2 bg-red-600 hover:bg-red-700
                    text-white rounded-xl text-sm transition">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>

<?php endwhile; ?>

<!-- ================= JAVASCRIPT ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function load_gallery(page = 1) {
        $.post("gallery_data.php", { page: page }, function (data) {
            $("#gallery_data").html(data);
        });
    }
    $(document).ready(() => load_gallery());

    function openModalTambah() { $("#modalTambah").removeClass("hidden"); }
    function closeModalTambah() { $("#modalTambah").addClass("hidden"); }
    function openModalEdit(id) { $("#" + id).removeClass("hidden"); }
    function closeModalEdit(id) { $("#" + id).addClass("hidden"); }
    function openModalHapus(id) { $("#" + id).removeClass("hidden"); }
    function closeModalHapus(id) { $("#" + id).addClass("hidden"); }
</script>

<?php
/* ========== SIMPAN ========== */
if (isset($_POST['simpan'])) {
    $tanggal = date("Y-m-d H:i:s");
    $username = "admin";
    $gambar = "";

    if (!empty($_FILES['gambar']['name'])) {
        $up = upload_foto($_FILES['gambar']);
        if ($up['status']) {
            $gambar = $up['message'];

            // pindahkan ke img/gallery
            if (!is_dir("img/gallery")) {
                mkdir("img/gallery", 0777, true);
            }

            rename("img/" . $gambar, "img/gallery/" . $gambar);
        }
    }


    $stmt = $conn->prepare(
        "INSERT INTO gallery (gambar,tanggal,username)
         VALUES (?,?,?)"
    );
    $stmt->bind_param("sss", $gambar, $tanggal, $username);
    $stmt->execute();
    $stmt->close();

    echo "<script>location='admin.php?page=gallery'</script>";
}

/* ========== UPDATE ========== */
if (isset($_POST['update'])) {
    $gambar = $_POST['gambar_lama'];

    if (!empty($_FILES['gambar']['name'])) {
        $up = upload_foto($_FILES['gambar']);
        if ($up['status']) {

            // hapus gambar lama
            if ($gambar && file_exists("img/gallery/" . $gambar)) {
                unlink("img/gallery/" . $gambar);
            }

            $gambar = $up['message'];

            // pastikan folder ada
            if (!is_dir("img/gallery")) {
                mkdir("img/gallery", 0777, true);
            }

            // pindahkan file baru
            rename("img/" . $gambar, "img/gallery/" . $gambar);
        }
    }

    $stmt = $conn->prepare(
        "UPDATE gallery SET gambar=? WHERE id=?"
    );
    $stmt->bind_param("si", $gambar, $_POST['id']);
    $stmt->execute();
    $stmt->close();

    echo "<script>location='admin.php?page=gallery'</script>";
}

/* ========== HAPUS ========== */
if (isset($_POST['hapus'])) {
    if ($_POST['gambar'])
        unlink("img/gallery/" . $_POST['gambar']);

    $stmt = $conn->prepare("DELETE FROM gallery WHERE id=?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $stmt->close();

    echo "<script>location='admin.php?page=gallery'</script>";
}
?>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn .2s ease-out;
    }
</style>