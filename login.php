<?php
session_start();
include "koneksi.php";

if (isset($_SESSION['username'])) {
    header("location:admin.php");
    exit;
}

$notif = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['user'] ?? '');
    $inputPass = $_POST['pass'] ?? '';

    // Ambil data user berdasarkan username
    $stmt = $conn->prepare("SELECT username, password FROM user WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($inputPass, $user['password'])) {
        $_SESSION['username'] = $user['username'];

        $notif = "
        <div class='mt-6 p-4 bg-green-100 text-green-800 rounded-xl shadow text-center space-y-1 animate-fadeIn'>
            <p><strong>Username:</strong> $username</p>
            <p><strong>Password:</strong> $inputPass</p>
            <p class='font-semibold mt-2'>Login Berhasil! Mengalihkan...</p>
        </div>

        <script>
            setTimeout(() => {
                window.location.href = 'admin.php';
            }, 1500);
        </script>
        ";

    } else {

        $notif = "
        <div class='mt-6 p-4 bg-red-100 text-red-700 rounded-xl shadow text-center space-y-1 animate-fadeIn'>
            <p><strong>Username:</strong> $username</p>
            <p><strong>Password:</strong> $inputPass</p>
            <p class='font-semibold mt-2'>Username atau Password Salah!</p>
        </div>
        ";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-zinc-700 via-zinc-650 to-black flex items-center justify-center px-4">
    <div class="flex flex-col w-full max-w-lg">

        <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-3xl shadow-2xl p-8">

            <div class="flex flex-col justify-center items-center mb-4">
                <div
                    class="w-20 h-20 rounded-2xl bg-white/10 border border-white/10 backdrop-blur-md flex items-center justify-center shadow-xl">
                    <img src="https://cdn-icons-png.flaticon.com/512/456/456212.png"
                        class="w-12 h-12 opacity-90 drop-shadow-lg" />
                </div>
                <p class="text-3xl text-white font-bold tracking-wide mt-6 drop-shadow">
                    The Strand Booking
                </p>
            </div>

            <div class="w-full border-t border-white/10 my-6"></div>

            <form method="POST" class="space-y-4">

                <div>
                    <input type="text" name="user"
                        class="w-full px-4 py-3 rounded-2xl bg-white/10 text-white border border-white/20 placeholder-gray-400 focus:ring-2 focus:ring-red-400 focus:bg-white/20 transition outline-none duration-300"
                        placeholder="Username" required />
                </div>

                <div>
                    <input type="password" name="pass"
                        class="w-full px-4 py-3 rounded-2xl bg-white/10 text-white border border-white/20 placeholder-gray-400 focus:ring-2 focus:ring-red-400 focus:bg-white/20 transition outline-none duration-300"
                        placeholder="Password" required />
                </div>

                <button type="submit"
                    class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-2xl shadow-lg mt-6 transition active:scale-95">
                    Login
                </button>
            </form>
        </div>

        <?php if ($notif !== "")
            echo $notif; ?>
    </div>
</body>

</html>