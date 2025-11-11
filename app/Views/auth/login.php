<?php
$pageTitle = 'Gold Coin Wallet - Login';
require_once '../../middlewares/middleware.php';
include '../layout/header.php';

?>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900  flex items-center justify-center p-4">
    <!-- Simple toast error handler -->
    <?php
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        $errorMessage = '';
        switch ($error) {
            case '1':
                $errorMessage = 'Invalid email or password.';
                break;
            case '2':
                $errorMessage = 'Email already registered.';
                break;
            case '3':
                $errorMessage = 'Passwords do not match.';
                break;
            case '4':
                $errorMessage = 'Passwords length minimal 6 characters.';
                break;
            default:
                $errorMessage = 'An unknown error occurred.';
        }
        echo '
            <div id="toastError" class=" w-fulll ml-4  fixed bottom-0 mb-4 p-4 bg-red-600 text-white rounded-lg shadow-lg flex items-center justify-between">
                <span>' . htmlspecialchars($errorMessage) . '</span>
                <button onclick="document.getElementById(\'toastError\').remove()" class="ml-4 font-bold">X</button>
            </div>
            ';
    }
    ?>
    <div class="w-full m-auto mt-8 max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-500 rounded-full mb-4">
                <span class="text-2xl">💰</span>
            </div>
            <h1 class="text-3xl font-bold text-white">Gold Coin Wallet</h1>
            <p class="text-slate-400 mt-2">Kelola koin emas Anda dengan mudah</p>
        </div>

        <!-- Login Form -->
        <div class="bg-slate-800 rounded-2xl p-8 shadow-2xl border border-slate-700">
            <h2 class="text-2xl font-bold text-white mb-6">Masuk</h2>

            <form id="loginForm" method="POST" action="<?= CONTROLLER_URL . 'AuthController.php' ?>" class="space-y-4">
                <input type="hidden" name="action" value="login">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input name="email" type="email" id="loginEmail" placeholder="nama@email.com"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                    <input name="password" type="password" id="loginPassword" placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition"
                        required>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold py-3 rounded-lg transition transform hover:scale-105 mt-6">
                    Masuk
                </button>
            </form>

            <p class="text-center text-slate-400 mt-6">
                Belum punya akun?
                <a href="register.php" class="text-amber-500 hover:text-amber-400 font-semibold">Daftar di sini</a>
            </p>
        </div>

        <div class="mt-6 p-4 bg-slate-700/50 rounded-lg border border-slate-600">
            <p class="text-xs text-slate-400 text-center">
                <a href="<?= SITE_ROOT ?>" class="text-amber-500 hover:text-amber-400 font-semibold">Back to Homepage</a>
            </p>
        </div>

    </div>
    <script src="script.js"></script>
</body>

</html>