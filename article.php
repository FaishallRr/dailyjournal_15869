<?php
include "koneksi.php";
include "upload_foto.php";
?>

<div class="max-w-6xl mx-auto mb-40">

    <div class="mb-5">
        <button onclick="openModalTambah()" class="inline-flex items-center gap-2
        px-4 py-2 bg-zinc-700 text-white rounded-xl
        text-sm font-medium hover:scale-[1.03] transition">
            <span class="text-lg">＋</span>
            Tambah Artikel
        </button>
    </div>

    <div id="article_data"></div>
</div>



<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden
            items-center justify-center z-50">
    <div class="bg-white rounded-2xl
            w-[80%] sm:w-full
            max-w-lg
            shadow-xl
            animate-fadeIn">
        <form method="post" enctype="multipart/form-data">
            <div class="p-4 border-b flex justify-between">
                <h2 class="font-bold text-[18px] mt-1 text-gray-600">Tambah Artikel</h2>
                <button type="button" onclick="closeModalTambah()" class="w-9 h-9 flex items-center justify-center
           rounded-full
           bg-zinc-100 hover:bg-zinc-200
           text-zinc-700 hover:text-zinc-900
           transition">
                    ✕
                </button>
            </div>

            <div class="p-4 space-y-3">
                <input type="text" name="judul" required class="w-full border p-3 rounded-xl" placeholder="Judul">
                <textarea name="isi" required class="w-full border p-3 rounded-xl h-[100px]"
                    placeholder="Isi"></textarea>
                <input type="file" name="gambar" class="ml-1">
            </div>

            <div class="p-4 border-t text-right">
                <button name="simpan" class="px-4 py-2 bg-zinc-700 text-white rounded-xl text-center font-bold">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


<!-- ================= MODAL EDIT & HAPUS ================= -->
<?php
$q = $conn->query("SELECT * FROM article");
while ($row = $q->fetch_assoc()):
    ?>

    <!-- EDIT -->
    <div id="edit<?= $row['id'] ?>" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden
            items-center justify-center z-50">
        <div class="bg-white rounded-2xl
            w-[80%] sm:w-full
            max-w-lg
            shadow-xl
            animate-fadeIn">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">

                <div class="p-4 border-b flex justify-between">
                    <h2 class="font-bold text-[18px] mt-1 text-gray-600">Edit Artikel</h2>
                    <button type="button" onclick="closeModalEdit('edit<?= $row['id'] ?>')" class="w-9 h-9 flex items-center justify-center
           rounded-full
           bg-zinc-100 hover:bg-zinc-200
           text-zinc-700 hover:text-zinc-900
           transition">✕</button>
                </div>

                <div class="p-4 space-y-3">

                    <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']) ?>"
                        class="w-full border p-3 rounded-xl">

                    <textarea name="isi"
                        class="w-full border p-3 rounded-xl h-[100px]"><?= htmlspecialchars($row['isi']) ?></textarea>

                    <?php if ($row['gambar']): ?>
                        <div class="space-y-1">
                            <p class="text-xs text-zinc-500">Gambar saat ini:</p>
                            <img src="img/<?= $row['gambar'] ?>" class="w-full max-h-40 object-cover rounded-xl shadow border">
                        </div>
                    <?php endif; ?>

                    <div class="space-y-1">
                        <p class="text-xs text-zinc-500">Ganti gambar (opsional):</p>
                        <input type="file" name="gambar" class="w-full text-sm border rounded-lg p-2">
                    </div>

                </div>

                <div class="p-4 border-t text-right">
                    <button name="simpan" class="px-4 py-2 bg-green-600 text-white rounded-xl text-center font-bold">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- HAPUS -->
    <div id="hapus<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden
           flex items-center justify-center
           bg-black/60 backdrop-blur-sm">

        <div class="bg-white rounded-2xl
            w-[80%] sm:w-full
            max-w-md
            p-6
            shadow-2xl
            animate-fadeIn">

            <div class="flex items-start justify-between mb-4">
                <h3 class="font-bold text-[18px] -mt-1 text-gray-600">
                    Hapus Artikel
                </h3>

                <button onclick="closeModalHapus('hapus<?= $row['id'] ?>')" class="w-9 h-9 flex items-center justify-center
           rounded-full
           bg-zinc-100 hover:bg-zinc-200
           text-zinc-700 hover:text-zinc-900
           transition -mt-1">
                    ✕
                </button>
            </div>

            <div class="flex gap-3 items-start">
                <div class="w-10 h-10 flex items-center justify-center
            rounded-full
            bg-red-100
            text-red-600
            text-lg
            font-semibold">
                    !
                </div>


                <div>
                    <p class="text-[16px] text-zinc-700 mt-1">
                        Apakah kamu yakin ingin menghapus artikel ini?
                    </p>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeModalHapus('hapus<?= $row['id'] ?>')" class="px-4 py-2 text-sm
                       rounded-xl
                       border border-zinc-300
                       text-zinc-700
                       hover:bg-zinc-100
                       transition">
                    Batal
                </button>

                <form method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">

                    <button name="hapus" class="px-4 py-2 text-sm
                           rounded-xl
                           bg-red-600 hover:bg-red-700
                           text-white
                           transition">
                        Ya, Hapus
                    </button>
                </form>
            </div>

        </div>
    </div>


<?php endwhile; ?>

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


<!-- ================= JAVASCRIPT ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function load_data(page = 1) {
        $.post("article_data.php", { hlm: page }, function (data) {
            $("#article_data").html(data);
        });
    }
    $(document).ready(() => load_data());

    function openModalTambah() { $("#modalTambah").removeClass("hidden").addClass("flex"); }
    function closeModalTambah() { $("#modalTambah").addClass("hidden").removeClass("flex"); }
    function openModalEdit(id) { $("#" + id).removeClass("hidden").addClass("flex"); }
    function closeModalEdit(id) { $("#" + id).addClass("hidden").removeClass("flex"); }
    function openModalHapus(id) { $("#" + id).removeClass("hidden").addClass("flex"); }
    function closeModalHapus(id) { $("#" + id).addClass("hidden").removeClass("flex"); }
</script>


<?php
/* SIMPAN / UPDATE */
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tgl = date("Y-m-d H:i:s");
    $user = $_SESSION['username'];
    $gambar = $_POST['gambar_lama'] ?? '';

    if (!empty($_FILES['gambar']['name'])) {
        $up = upload_foto($_FILES['gambar']);
        if ($up['status'])
            $gambar = $up['message'];
    }

    if (!empty($_POST['id'])) {
        $stmt = $conn->prepare(
            "UPDATE article SET judul=?, isi=?, gambar=?, tanggal=?, username=? WHERE id=?"
        );
        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tgl, $user, $_POST['id']);
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO article (judul,isi,gambar,tanggal,username) VALUES (?,?,?,?,?)"
        );
        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tgl, $user);
    }
    $stmt->execute();
    $stmt->close();
    echo "<script>location='admin.php?page=article'</script>";
}

/* HAPUS */
if (isset($_POST['hapus'])) {
    if ($_POST['gambar'])
        unlink("img/" . $_POST['gambar']);
    $stmt = $conn->prepare("DELETE FROM article WHERE id=?");
    $stmt->bind_param("i", $_POST['id']);
    $stmt->execute();
    $stmt->close();
    echo "<script>location='admin.php?page=article'</script>";
}
?>