<?php
require_once "koneksi.php"; // sesuaikan dengan file koneksi kamu

// ========================
// PAGINATION CONFIG
// ========================
$limit = 3;
$page = isset($_POST['page']) ? (int) $_POST['page'] : 1;
$page = max(1, $page);

$offset = ($page - 1) * $limit;

// ========================
// HITUNG TOTAL DATA
// ========================
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM gallery");
$totalData = $totalQuery->fetch_assoc();
$total = $totalData['total'];

$total_page = ceil($total / $limit);

$range = 1;
$start = max(1, $page - $range);
$end = min($total_page, $page + $range);

$sql = "SELECT * FROM gallery
        ORDER BY id DESC
        LIMIT ?, ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$data = $stmt->get_result();

$no = $offset + 1;
?>

<!-- TABLE GALERI -->
<div class="overflow-x-auto rounded-xl border shadow-sm bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-zinc-700 text-zinc-100">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Info</th>
                <th class="px-4 py-3 text-left">Gambar</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            <?php if ($data->num_rows > 0): ?>
                <?php while ($row = $data->fetch_assoc()): ?>
                    <tr class="hover:bg-zinc-50 transition">
                        <td class="px-4 py-3"><?= $no++ ?></td>

                        <td class="px-4 py-3">
                            <p class="text-sm text-zinc-600">
                                <?= htmlspecialchars($row['tanggal']) ?> •
                                <span class="font-medium text-zinc-800">
                                    <?= htmlspecialchars($row['username']) ?>
                                </span>
                            </p>
                        </td>

                        <td class="px-4 py-3">
                            <?php if (!empty($row['gambar'])): ?>
                                <img src="img/gallery/<?= htmlspecialchars($row['gambar']) ?>"
                                    class="w-24 h-16 object-cover rounded-lg border shadow">
                            <?php else: ?>
                                <span class="text-xs text-zinc-400">
                                    Tidak ada gambar
                                </span>
                            <?php endif; ?>
                        </td>

                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="openModalEdit('edit<?= $row['id'] ?>')" class="px-3 py-1.5 text-xs rounded-full
                                    bg-emerald-500 hover:bg-emerald-600
                                    text-white shadow transition">
                                    Edit
                                </button>

                                <button onclick="openModalHapus('hapus<?= $row['id'] ?>')" class="px-3 py-1.5 text-xs rounded-full
                                    bg-rose-500 hover:bg-rose-600
                                    text-white shadow transition">
                                    Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-zinc-500">
                        Data galeri belum tersedia
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 text-sm">

    <p class="text-zinc-500">
        Total galeri: <b><?= $total ?>
        </b>
    </p>

    <div class="flex flex-wrap gap-1">

        <button onclick="load_gallery(1)" class="px-3 py-1 border rounded hover:bg-zinc-100">
            First
        </button>

        <button onclick="load_gallery(<?= max(1, $page - 1) ?>)" class="px-3 py-1 border rounded hover:bg-zinc-100">
            «
        </button>

        <?php for ($i = $start; $i <= $end; $i++): ?>
            <button onclick="load_gallery(<?= $i ?>)" class="px-3 py-1 border rounded
                <?= $page == $i
                    ? 'bg-zinc-800 text-white border-zinc-800'
                    : 'hover:bg-zinc-100' ?>">
                <?= $i ?>
            </button>
        <?php endfor; ?>

        <button onclick="load_gallery(<?= min($total_page, $page + 1) ?>)"
            class="px-3 py-1 border rounded hover:bg-zinc-100">
            »
        </button>

        <button onclick="load_gallery(<?= $total_page ?>)" class="px-3 py-1 border rounded hover:bg-zinc-100">
            Last
        </button>

    </div>
</div>