<?php
include "koneksi.php";

$upload_dir = "img/profile/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}
?>

<div class="max-w-6xl mx-auto mb-40 px-4">

    <button onclick="openModalTambah()" class="inline-flex items-center gap-2
        px-4 py-2 bg-zinc-700 text-white rounded-xl
        text-sm font-medium hover:scale-[1.03] transition">
        ＋ Tambah User
    </button>

    <div id="user_data" class="mt-6"></div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div id="modalTambah" class="fixed inset-0 z-50 hidden flex items-center justify-center
    bg-black/60 backdrop-blur-sm px-4">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-xl animate-fadeIn">
        <form method="post" enctype="multipart/form-data">
            <div class="p-4 border-b flex justify-between items-center">
                <h2 class="font-bold text-zinc-700 text-lg">Tambah User</h2>
                <button type="button" onclick="closeModalTambah()"
                    class="w-9 h-9 flex items-center justify-center rounded-full bg-zinc-100 hover:bg-zinc-200">✕</button>
            </div>

            <div class="p-4 space-y-3">
                <input type="text" name="username" required placeholder="Username"
                    class="w-full border rounded-xl p-3 text-sm">
                <input type="password" name="password" required placeholder="Password"
                    class="w-full border rounded-xl p-3 text-sm">
                <input type="file" name="profile" accept="image/*" class="w-full border rounded-xl p-3 text-sm">
            </div>

            <div class="p-4 border-t text-right">
                <button name="simpan"
                    class="px-4 py-2 bg-zinc-700 hover:bg-zinc-800 text-white rounded-xl text-sm font-bold">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= MODAL EDIT & HAPUS ================= -->
<?php
$q = $conn->query("SELECT * FROM user ORDER BY id DESC");
while ($row = $q->fetch_assoc()):
    ?>
    <!-- EDIT -->
    <div id="edit<?= $row['id'] ?>" class="fixed inset-0 z-50 hidden flex items-center justify-center
bg-black/60 backdrop-blur-sm px-4">
        <div class="bg-white rounded-2xl w-full max-w-md shadow-xl animate-fadeIn">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">

                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="font-bold text-zinc-700 text-lg">Edit User</h2>
                    <button type="button" onclick="closeModalEdit('edit<?= $row['id'] ?>')"
                        class="w-9 h-9 flex items-center justify-center rounded-full bg-zinc-100 hover:bg-zinc-200">✕</button>
                </div>

                <div class="p-4 space-y-3">
                    <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>"
                        class="w-full border rounded-xl p-3 text-sm">
                    <input type="password" name="password" placeholder="Kosongkan jika tidak diganti"
                        class="w-full border rounded-xl p-3 text-sm">
                    <input type="file" name="profile" accept="image/*" class="w-full border rounded-xl p-3 text-sm">
                    <?php if ($row['profile'] && file_exists($upload_dir . $row['profile'])): ?>
                        <img src="<?= $upload_dir . $row['profile'] ?>" class="w-20 h-20 rounded-full object-cover mt-2">
                    <?php endif; ?>
                </div>

                <div class="p-4 border-t text-right">
                    <button name="update"
                        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-bold">Update</button>
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
                    Hapus User
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
                        Apakah kamu yakin ingin menghapus user <b><?= htmlspecialchars($row['username']) ?></b>?
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
                    <input type="hidden" name="profile" value="<?= $row['profile'] ?>">

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

<!-- ================= JS ================= -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function load_user(page = 1) {
        $.post("user_data.php", { page }, data => $("#user_data").html(data));
    }
    $(document).ready(() => load_user());

    const openModalTambah = () => $("#modalTambah").removeClass("hidden");
    const closeModalTambah = () => $("#modalTambah").addClass("hidden");
    const openModalEdit = id => $("#" + id).removeClass("hidden");
    const closeModalEdit = id => $("#" + id).addClass("hidden");
    const openModalHapus = id => $("#" + id).removeClass("hidden");
    const closeModalHapus = id => $("#" + id).addClass("hidden");
</script>

<?php
/* ================= SIMPAN ================= */
if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $profile = null;

    if (!empty($_FILES['profile']['name'])) {
        $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $profile = 'user_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['profile']['tmp_name'], $upload_dir . $profile);
    }

    $stmt = $conn->prepare("INSERT INTO user (username,password,profile) VALUES (?,?,?)");
    $stmt->bind_param("sss", $username, $password, $profile);
    $stmt->execute();
    echo "<script>location='admin.php?page=user'</script>";
}

/* ================= UPDATE ================= */
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];

    $old = $conn->query("SELECT profile FROM user WHERE id=$id")->fetch_assoc();
    $profile = $old['profile'];

    if (!empty($_FILES['profile']['name'])) {
        if ($profile && file_exists($upload_dir . $profile))
            unlink($upload_dir . $profile);
        $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $profile = 'user_' . time() . '.' . $ext;
        move_uploaded_file($_FILES['profile']['tmp_name'], $upload_dir . $profile);
    }

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE user SET username=?, password=?, profile=? WHERE id=?");
        $stmt->bind_param("sssi", $username, $password, $profile, $id);
    } else {
        $stmt = $conn->prepare("UPDATE user SET username=?, profile=? WHERE id=?");
        $stmt->bind_param("ssi", $username, $profile, $id);
    }

    $stmt->execute();
    echo "<script>location='admin.php?page=user'</script>";
}

/* ================= HAPUS ================= */
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $old = $conn->query("SELECT profile FROM user WHERE id=$id")->fetch_assoc();
    if ($old['profile'] && file_exists($upload_dir . $old['profile']))
        unlink($upload_dir . $old['profile']);
    $conn->query("DELETE FROM user WHERE id=$id");
    echo "<script>location='admin.php?page=user'</script>";
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