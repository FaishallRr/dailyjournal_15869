<?php
// query article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);
$jumlah_article = $hasil1->num_rows;
?>

<div class="w-full flex justify-center pt-10">
    <div class="flex gap-10 justify-center items-center">

        <!-- CARD ARTICLE -->
        <div class="group flex justify-center">
            <a href="admin.php?page=article">
                <div class="bg-white border border-red-500 shadow-lg rounded-xl p-6 w-72
                        transition-all duration-300 group-hover:shadow-2xl group-hover:scale-[1.03]">

                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-3xl text-red-600 mb-2">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <h5 class="text-lg font-semibold text-gray-700">Article</h5>
                        </div>

                        <span class="bg-red-600 text-white text-3xl font-bold px-4 py-2 rounded-full shadow">
                            <?= $jumlah_article ?>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <!-- CARD GALLERY -->
        <div class="group flex justify-center">
            <div class="bg-white border border-red-500 shadow-lg rounded-xl p-6 w-72
                        transition-all duration-300 group-hover:shadow-2xl group-hover:scale-[1.03]">

                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-3xl text-red-600 mb-2">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <h5 class="text-lg font-semibold text-gray-700">Gallery</h5>
                    </div>

                    <span class="bg-red-600 text-white text-3xl font-bold px-4 py-2 rounded-full shadow">
                        <?php // echo $jumlah_gallery; ?>
                    </span>
                </div>
            </div>
        </div>

    </div>
</div>