<?php
include "koneksi.php";

$limit = 3;
$page = isset($_POST['hlm']) ? (int) $_POST['hlm'] : 1;
$page = max(1, $page);
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit OFFSET $offset";
$data = $conn->query($sql);

$total = $conn->query("SELECT COUNT(*) AS total FROM article")->fetch_assoc()['total'];
$total_page = ceil($total / $limit);

$range = 1;
$start = max(1, $page - $range);
$end = min($total_page, $page + $range);

$no = $offset + 1;
?>

<div class="overflow-x-auto rounded-xl border shadow-sm bg-white">
    <table class="min-w-full text-sm">
        <thead class="bg-zinc-700 text-zinc-100">
            <tr>
                <th class="px-4 py-3 text-left">No</th>
                <th class="px-4 py-3 text-left">Judul</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">Isi</th>
                <th class="px-4 py-3 text-left hidden md:table-cell">Gambar</th>
                <th class="px-4 py-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            <?php while ($row = $data->fetch_assoc()): ?>
                <tr class="hover:bg-gray-100">
                    <td class="px-3 py-2 text-[15px]"><?= $no++ ?></td>

                    <td class="px-4 py-3">
                        <p class="font-semibold text-zinc-800 text-[15px]">
                            <?= htmlspecialchars($row['judul']) ?>
                        </p>
                        <p class="text-xs text-zinc-500 mt-1 text-[15px]">
                            <?= $row['tanggal'] ?> •
                            <?= htmlspecialchars($row['username']) ?>
                        </p>
                    </td>

                    <td class="px-3 py-2 hidden md:table-cell text-[14px]">
                        <?= nl2br(htmlspecialchars($row['isi'])) ?>
                    </td>

                    <td class="px-3 py-2 hidden md:table-cell">
                        <?php if ($row['gambar']): ?>
                            <img src="img/<?= $row['gambar'] ?>" class="w-20 rounded shadow">
                        <?php endif; ?>
                    </td>

                    <td class="px-3 py-2 text-center">
                        <div class="flex gap-2 justify-center">
                            <button onclick="openModalEdit('edit<?= $row['id'] ?>')" class="px-3 py-2 text-xs font-medium
                            bg-emerald-500 hover:bg-emerald-600
                            text-white rounded-full transition shadow">
                                Edit
                            </button>

                            <button onclick="openModalHapus('hapus<?= $row['id'] ?>')" class="px-3 py-2 text-xs font-medium
                            bg-rose-500 hover:bg-rose-600
                            text-white rounded-full transition shadow">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 text-sm">

    <p class="text-zinc-500">
        Total artikel: <b><?= $total ?></b>
    </p>

    <div class="flex flex-wrap gap-1">
        <button onclick="load_data(1)" class="px-3 py-1 border rounded hover:bg-zinc-100">
            First
        </button>

        <button onclick="load_data(<?= max(1, $page - 1) ?>)" class="px-3 py-1 border rounded hover:bg-zinc-100">
            «
        </button>

        <?php for ($i = $start; $i <= $end; $i++): ?>
            <button onclick="load_data(<?= $i ?>)" class="px-3 py-1 border rounded
                <?= $page == $i
                    ? 'bg-zinc-800 text-white border-zinc-800'
                    : 'hover:bg-zinc-100' ?>">
                <?= $i ?>
            </button>
        <?php endfor; ?>

        <button onclick="load_data(<?= min($total_page, $page + 1) ?>)"
            class="px-3 py-1 border rounded hover:bg-zinc-100">
            »
        </button>

        <button onclick="load_data(<?= $total_page ?>)" class="px-3 py-1 border rounded hover:bg-zinc-100">
            Last
        </button>
    </div>
</div>