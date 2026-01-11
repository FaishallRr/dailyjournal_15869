<?php
// query article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);
$jumlah_article = $hasil1->num_rows;


// query article
$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
$hasil2 = $conn->query($sql2);
$jumlah_gallery = $hasil2->num_rows;
?>

<div class="w-full flex justify-center pt-6 sm:pt-8 md:pt-10">
    <div class="
        flex flex-col
        sm:flex-row
        gap-4 sm:gap-6 md:gap-10
        justify-center items-stretch
        w-full max-w-6xl px-3 sm:px-4 md:px-6
    ">

        <!-- CARD ARTICLE -->
        <div class="group flex justify-center w-full sm:w-auto">
            <a href="admin.php?page=article" class="w-full">
                <div class="
                    bg-white border border-red-500 shadow-lg rounded-xl
                    p-4 sm:p-5 md:p-6
                    w-full sm:w-64 md:w-72
                    transition-all duration-300
                    group-hover:shadow-2xl group-hover:scale-[1.03]
                ">

                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-2xl sm:text-3xl text-red-600 mb-1 sm:mb-2">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                            <h5 class="text-base sm:text-lg font-semibold text-gray-700">
                                Article
                            </h5>
                        </div>

                        <span class="
                            bg-red-600 text-white
                            text-xl sm:text-2xl md:text-3xl
                            font-bold
                            px-3 sm:px-4 py-1.5 sm:py-2
                            rounded-full shadow
                        ">
                            <?= $jumlah_article ?>
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <!-- CARD GALLERY -->
        <div class="group flex justify-center w-full sm:w-auto">
            <a href="admin.php?page=gallery" class="w-full">
                <div class="
                bg-white border border-red-500 shadow-lg rounded-xl
                p-4 sm:p-5 md:p-6
                w-full sm:w-64 md:w-72
                transition-all duration-300
                group-hover:shadow-2xl group-hover:scale-[1.03]
            ">

                    <div class="flex justify-between items-center">
                        <div>
                            <div class="text-2xl sm:text-3xl text-red-600 mb-1 sm:mb-2">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                            <h5 class="text-base sm:text-lg font-semibold text-gray-700">
                                Gallery
                            </h5>
                        </div>

                        <span class="
                        bg-red-600 text-white
                        text-xl sm:text-2xl md:text-3xl
                        font-bold
                        px-3 sm:px-4 py-1.5 sm:py-2
                        rounded-full shadow
                    ">
                            <?php echo $jumlah_gallery; ?>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>