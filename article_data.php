<?php
include "koneksi.php";

$limit = 3;
$hlm = isset($_POST['hlm']) ? intval($_POST['hlm']) : 1;
$hlm = max(1, $hlm);

$offset = ($hlm - 1) * $limit;

// data
$sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit OFFSET $offset";
$hasil = $conn->query($sql);

// total data (OPTIMAL)
$totalData = $conn->query("SELECT COUNT(*) as total FROM article")->fetch_assoc();
$total_records = $totalData['total'];
$jumlah_page = ceil($total_records / $limit);

// batas halaman kiri-kanan
$jumlah_number = 1;
$start_number = ($hlm > $jumlah_number) ? $hlm - $jumlah_number : 1;
$end_number = ($hlm < ($jumlah_page - $jumlah_number)) ? $hlm + $jumlah_number : $jumlah_page;

$no = $offset + 1;
?>

<table class="min-w-full text-left border border-gray-200">
    <thead class="bg-zinc-700 text-gray-100">
        <tr>
            <th class="px-4 py-3 text-sm font-semibold">No</th>
            <th class="px-4 py-3 text-sm font-semibold w-1/4">Judul</th>
            <th class="px-4 py-3 text-sm font-semibold w-1/2">Isi</th>
            <th class="px-4 py-3 text-sm font-semibold w-1/4">Gambar</th>
            <th class="px-4 py-3 text-sm font-semibold w-1/4">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">

        <?php
        while ($row = $hasil->fetch_assoc()) {
            ?>
            <tr class="hover:bg-gray-100 transition">
                <td class="px-4 py-3 font-medium text-gray-700"><?= $no++ ?></td>
                <td class="px-4 py-3 text-gray-800">
                    <strong class="text-red-700"><?= $row["judul"] ?></strong>
                    <div class="text-sm text-gray-500 mt-1">
                        Pada : <?= $row["tanggal"] ?><br>
                        Oleh : <?= $row["username"] ?>
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-700"><?= $row["isi"] ?></td>
                <td class="px-4 py-3">
                    <?php if ($row["gambar"] && file_exists('img/' . $row["gambar"])): ?>
                        <img src="img/<?= $row["gambar"] ?>" class="w-24 rounded shadow">
                    <?php endif; ?>
                </td>
                <td class="px-3 py-3">
                    <div class="flex gap-1">
                        <a href="#" title="edit"
                            class="inline-flex items-center px-3 py-1 text-white bg-green-500 hover:bg-green-600 rounded-full"
                            onclick="openModalEdit('modalEditId_<?= $row['id'] ?>')">
                            <i class="fa fa-pencil-alt"></i>
                        </a>

                        <a href="#" title="delete"
                            class="inline-flex items-center px-3 py-1 text-white bg-red-500 hover:bg-red-600 rounded-full"
                            onclick="openModalHapus('modalHapusId_<?= $row['id'] ?>')">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>

            <!-- Modal Edit -->
            <div id="modalEditId_<?= $row['id'] ?>" class="fixed inset-0 hidden opacity-0 pointer-events-none
                               flex items-center justify-center bg-black bg-opacity-50
                               transition-opacity duration-300 mb-12">

                <div class="modal-content bg-white rounded-lg shadow-xl w-[30%]
                                    transform scale-95 opacity-0 transition-all duration-300">

                    <div class="flex justify-between items-center p-4 border-b">
                        <h1 class="text-xl font-bold text-gray-800">Edit Article</h1>
                        <button onclick="closeModalEdit('modalEditId_<?= $row['id'] ?>')">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>

                    <form method="post" enctype="multipart/form-data">
                        <div class="p-6 space-y-4">

                            <!-- PENTING -->
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <input type="hidden" name="gambar_lama" value="<?= $row['gambar'] ?>">

                            <div>
                                <label class="block text-sm font-medium">Judul</label>
                                <input type="text" name="judul" value="<?= htmlspecialchars($row['judul']) ?>"
                                    class="w-full border rounded px-3 py-2" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Isi</label>
                                <textarea name="isi" class="w-full border rounded px-3 py-2"
                                    required><?= htmlspecialchars($row['isi']) ?></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium">Ganti Gambar</label>
                                <input type="file" name="gambar">
                                <?php if ($row['gambar']) { ?>
                                    <img src="img/<?= $row['gambar'] ?>" class="w-24 mt-2 rounded">
                                <?php } ?>
                            </div>

                        </div>

                        <div class="flex justify-end items-center p-4 border-t">
                            <button type="button" class="px-3 py-1.5 bg-gray-300 rounded-xl text-[14px] font-medium"
                                onclick="closeModalEdit('modalEditId_<?= $row['id'] ?>')">
                                Batal
                            </button>

                            <button type="submit" name="simpan"
                                class="ml-2 px-3 py-1.5 bg-green-600 text-white rounded-xl text-[14px] font-medium">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Hapus -->
            <div id="modalHapusId_<?= $row['id'] ?>"
                class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out hidden">
                <div
                    class="modal-content bg-white rounded-lg shadow-xl w-96 transform transition-all duration-500 scale-95 opacity-0">
                    <div class="flex justify-between items-center p-4 border-b">
                        <h1 class="text-xl font-semibold text-gray-800">Konfirmasi Hapus Article</h1>
                        <button type="button" class="text-gray-500 hover:text-gray-700"
                            onclick="closeModalHapus('modalHapusId_<?= $row['id'] ?>')">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="p-6">
                            <div class="mb-4">
                                <label for="formGroupExampleInput" class="block text-sm font-medium text-gray-700">
                                    Yakin akan menghapus artikel "<strong><?= $row['judul'] ?></strong>"?
                                </label>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="gambar" value="<?= $row['gambar'] ?>">
                            </div>
                        </div>
                        <div class="flex justify-end items-center p-4 border-t">
                            <button type="button"
                                class="px-3 py-1.5 rounded-xl text-[14px] text-gray-700 font-medium bg-gray-300 hover:bg-gray-400 transition duration-300"
                                onclick="closeModalHapus('modalHapusId_<?= $row['id'] ?>')">Batal</button>
                            <input type="submit" value="Hapus" name="hapus"
                                class="ml-2 px-3 py-1.5 rounded-xl text-white text-[14px] font-medium bg-red-500 hover:bg-red-600 transition duration-300">
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </tbody>
</table>

<!-- PAGINATION -->
<nav class="flex justify-between items-center mt-4">

    <p class="text-sm text-gray-600">
        Total article : <?= $total_records ?>
    </p>

    <ul class="inline-flex items-center gap-1 text-sm">

        <!-- First -->
        <li>
          <button 
    onclick="<?= $hlm == 1 ? '' : 'load_data(1)' ?>" class="px-3 py-1 border rounded 
            <?= $hlm == 1 ? 'text-gray-400 bg-gray-100 cursor-not-allowed' : 'hover:bg-gray-100' ?>" <?= $hlm == 1 ? 'disabled' : '' ?>>
            First
        </button>

        </li>

        <!-- Prev -->
        <li>
            <button onclick="load_data(<?= max(1, $hlm - 1) ?>)"
                class="px-3 py-1 border rounded
                <?= $hlm == 1 ? 'text-gray-400 bg-gray-100 cursor-not-allowed' : 'hover:bg-gray-100' ?>"
                <?= $hlm == 1 ? 'disabled' : '' ?>>
                «
            </button>
        </li>

        <!-- Number -->
        <?php for ($i = $start_number; $i <= $end_number; $i++): ?>
            <li>
                <button onclick="load_data(<?= $i ?>)"
                    class="px-3 py-1 border rounded
                    <?= $hlm == $i ? 'bg-zinc-700 text-white font-semibold' : 'hover:bg-gray-100' ?>">
                    <?= $i ?>
                </button>
            </li>
        <?php endfor; ?>

        <!-- Next -->
        <li>
            <button onclick="load_data(<?= min($jumlah_page, $hlm + 1) ?>)"
                class="px-3 py-1 border rounded
                <?= $hlm == $jumlah_page ? 'text-gray-400 bg-gray-100 cursor-not-allowed' : 'hover:bg-gray-100' ?>"
                <?= $hlm == $jumlah_page ? 'disabled' : '' ?>>
                »
            </button>
        </li>

        <!-- Last -->
        <li>
            <button onclick="load_data(<?= $jumlah_page ?>)"
                class="px-3 py-1 border rounded
                <?= $hlm == $jumlah_page ? 'text-gray-400 bg-gray-100 cursor-not-allowed' : 'hover:bg-gray-100' ?>"
                <?= $hlm == $jumlah_page ? 'disabled' : '' ?>>
                Last
            </button>
        </li>
    </ul>
</nav>
