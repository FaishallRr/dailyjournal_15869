<?php
include "koneksi.php";

$limit = 3;
$page = max(1, (int) ($_POST['page'] ?? 1));
$offset = ($page - 1) * $limit;

$total = $conn->query("SELECT COUNT(*) total FROM user")->fetch_assoc()['total'];
$total_page = ceil($total / $limit);
$range = 1;
$start = max(1, $page - $range);
$end = min($total_page, $page + $range);

$data = $conn->query("SELECT * FROM user ORDER BY id DESC LIMIT $offset,$limit");
$no = $offset + 1;
$upload_dir = "img/profile/";
?>

<div class="overflow-x-auto rounded-xl border bg-white shadow-sm">
    <table class="min-w-full text-sm">
        <thead class="bg-zinc-700 text-white">
            <tr>
                <th class="px-4 py-3 text-center whitespace-nowrap">No</th>
                <th class="px-4 py-3 text-center whitespace-nowrap">Profile</th>
                <th class="px-4 py-3 text-left whitespace-nowrap">Username</th>
                <th class="px-4 py-3 text-center whitespace-nowrap">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php while ($row = $data->fetch_assoc()): ?>
                <tr class="hover:bg-zinc-50">
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <?= $no++ ?>
                    </td>

                    <td class="px-4 py-3 text-center">
                        <div class="flex justify-center">
                            <?php if ($row['profile'] && file_exists($upload_dir . $row['profile'])): ?>
                                <img src="<?= $upload_dir . $row['profile'] ?>" class="w-10 h-10 rounded-full object-cover">
                            <?php else: ?>
                                <div class="w-10 h-10 rounded-full bg-zinc-200
                                    flex items-center justify-center text-xs">
                                    N/A
                                </div>
                            <?php endif; ?>
                        </div>
                    </td>

                    <td class="px-4 py-3 text-left font-medium whitespace-nowrap">
                        <?= htmlspecialchars($row['username']) ?>
                    </td>

                    <td class="px-4 py-3 text-center whitespace-nowrap">
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
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mt-6 text-sm">
    <p class="text-zinc-500">Total user: <b><?= $total ?></b></p>
    <div class="flex gap-1">
        <button onclick="load_user(1)" class="px-3 py-1 border rounded">First</button>
        <button onclick="load_user(<?= max(1, $page - 1) ?>)" class="px-3 py-1 border rounded">«</button>
        <?php for ($i = $start; $i <= $end; $i++): ?>
            <button onclick="load_user(<?= $i ?>)"
                class="px-3 py-1 border rounded <?= $page == $i ? 'bg-zinc-800 text-white' : '' ?>"><?= $i ?></button>
        <?php endfor; ?>
        <button onclick="load_user(<?= min($total_page, $page + 1) ?>)" class="px-3 py-1 border rounded">»</button>
        <button onclick="load_user(<?= $total_page ?>)" class="px-3 py-1 border rounded">Last</button>
    </div>
</div>