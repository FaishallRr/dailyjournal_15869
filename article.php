<div class="max-w-6xl mx-auto mb-[270px]">

    <!-- Tombol Trigger Modal Tambah -->
    <button type="button"
        class="inline-flex items-center px-4 py-2 text-white bg-gray-600 hover:bg-gray-700 rounded-lg font-medium transition-all duration-300 mb-3"
        onclick="openModalTambah()">
        <i class="fa fa-plus mr-3"></i> Tambah Article
    </button>

    <!-- Tabel Artikel -->
    <div id="article_data">

    </div>

    <!-- Modal Tambah -->
    <div id="modalTambah"
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 pointer-events-none transition-opacity duration-500 ease-in-out hidden">
        <div
            class="modal-content bg-white rounded-lg shadow-xl w-[30%] transform transition-all duration-500 scale-95 opacity-0">
            <div class="flex justify-between items-center p-4 border-b">
                <h1 class="text-xl font-bold text-gray-800">Tambah Article</h1>
                <button type="button" class="text-xl text-gray-500 hover:text-gray-700 transition duration-300"
                    onclick="closeModalTambah()">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="p-6">
                    <div class="mb-4">
                        <label for="judul" class="block text-[15px] font-medium text-gray-700">Judul</label>
                        <input type="text"
                            class="form-control text-sm block w-full px-3 py-1.5 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300"
                            name="judul" placeholder="Tuliskan Judul Artikel" required>
                    </div>
                    <div class="mb-4">
                        <label for="isi" class="block text-[15px] font-medium text-gray-700">Isi</label>
                        <textarea
                            class="form-control text-sm block w-full px-3 py-1.5 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300"
                            placeholder="Tuliskan Isi Artikel" name="isi" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="gambar" class="block text-[15px] font-medium text-gray-700">Gambar</label>
                        <input type="file"
                            class="form-control text-sm block w-full px-3 py-1.5 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300"
                            name="gambar">
                    </div>
                </div>
                <div class="flex justify-end items-center p-4 border-t">
                    <button type="button"
                        class="ml-2 px-3 py-1.5 rounded-xl text-[14px] text-gray-700 font-medium bg-gray-300 hover:bg-gray-400 transition duration-300"
                        onclick="closeModalTambah()">Close</button>
                    <input type="submit" value="Simpan" name="simpan"
                        class="ml-2 px-3 py-1.5 rounded-xl text-[14px] text-white font-medium bg-zinc-700 hover:bg-zinc-800 transition duration-300">
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function openModalTambah() {
        const modal = document.getElementById('modalTambah');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }

    function closeModalTambah() {
        const modal = document.getElementById('modalTambah');
        const modalContent = modal.querySelector('.modal-content');
        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 100);
    }

    //
    //

    function openModalHapus(modalId) {
        console.log("Mencoba membuka modal dengan ID:", modalId);

        const modal = document.getElementById(modalId);
        if (!modal) {
            console.error(`Modal dengan ID ${modalId} tidak ditemukan.`);
            return;
        }

        const modalContent = modal.querySelector('.modal-content');

        // ⬇️ INI YANG KURANG
        modal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');

        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }

    function closeModalHapus(modalId) {
        const modal = document.getElementById(modalId);
        const modalContent = modal.querySelector('.modal-content');

        modal.classList.add('opacity-0', 'pointer-events-none');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
        }, 500);
    }

    //
    //

    function openModalEdit(id) {
        const modal = document.getElementById(id);
        const content = modal.querySelector('.modal-content');

        modal.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
        content.classList.remove('scale-95', 'opacity-0');
    }

    function closeModalEdit(id) {
        const modal = document.getElementById(id);
        const content = modal.querySelector('.modal-content');

        modal.classList.add('opacity-0', 'pointer-events-none');
        content.classList.add('scale-95', 'opacity-0');

        setTimeout(() => modal.classList.add('hidden'), 300);
    }
</script>


<script>
    function load_data(hlm = 1) {
        $.ajax({
            url: "article_data.php",
            type: "POST",
            data: { hlm: hlm },
            beforeSend: function () {
                $('#article_data').html(
                    '<p class="text-center py-4 text-gray-500">Loading...</p>'
                );
            },
            success: function (data) {
                $('#article_data').html(data);
            },
            error: function () {
                $('#article_data').html(
                    '<p class="text-center text-red-500">Gagal memuat data</p>'
                );
            }
        });
    }

    $(document).ready(function () {
        load_data(1);
    });
</script>



<?php
include "upload_foto.php";

//jika tombol simpan diklik
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = date("Y-m-d H:i:s");
    $username = $_SESSION['username'];
    $gambar = '';
    $nama_gambar = $_FILES['gambar']['name'];

    //jika ada file yang dikirim  
    if ($nama_gambar != '') {
        //panggil function upload_foto untuk cek spesifikasi file yg dikirimkan user
        //function ini memiliki 2 keluaran yaitu status dan message
        $cek_upload = upload_foto($_FILES["gambar"]);

        //cek status true/false
        if ($cek_upload['status']) {
            //jika true maka message berisi nama file gambar
            $gambar = $cek_upload['message'];
        } else {
            //jika true maka message berisi pesan error, tampilkan dalam alert
            echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=article';
            </script>";
            die;
        }
    }

    //cek apakah ada id yang dikirimkan dari form
    if (isset($_POST['id'])) {
        //jika ada id, lakukan update data dengan id tersebut
        $id = $_POST['id'];

        if ($nama_gambar == '') {
            //jika tidak ganti gambar
            $gambar = $_POST['gambar_lama'];
        } else {
            //jika ganti gambar, hapus gambar lama
            unlink("img/" . $_POST['gambar_lama']);
        }

        $stmt = $conn->prepare("UPDATE article 
                                SET 
                                judul =?,
                                isi =?,
                                gambar = ?,
                                tanggal = ?,
                                username = ?
                                WHERE id = ?");

        $stmt->bind_param("sssssi", $judul, $isi, $gambar, $tanggal, $username, $id);
        $simpan = $stmt->execute();
    } else {
        //jika tidak ada id, lakukan insert data baru
        $stmt = $conn->prepare("INSERT INTO article (judul,isi,gambar,tanggal,username)
                                VALUES (?,?,?,?,?)");

        $stmt->bind_param("sssss", $judul, $isi, $gambar, $tanggal, $username);
        $simpan = $stmt->execute();
    }

    if ($simpan) {
        echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}

//jika tombol hapus diklik
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $gambar = $_POST['gambar'];

    if ($gambar != '') {
        //hapus file gambar
        unlink("img/" . $gambar);
    }

    $stmt = $conn->prepare("DELETE FROM article WHERE id =?");

    $stmt->bind_param("i", $id);
    $hapus = $stmt->execute();

    if ($hapus) {
        echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=article';
        </script>";
    } else {
        echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=article';
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>