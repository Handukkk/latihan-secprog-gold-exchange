<?php
$pageTitle = 'Gold Coin Wallet - Register';

require_once '../../middlewares/middleware.php';

include '../layout/header.php';
?>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="w-full m-auto mt-8 max-w-md">
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
            <div id="toastError" class="mb-4 p-4 bg-red-600 text-white rounded-lg shadow-lg flex items-center justify-between">
                <span>' . htmlspecialchars($errorMessage) . '</span>
                <button onclick="document.getElementById(\'toastError\').remove()" class="ml-4 font-bold">X</button>
            </div>
            ';
        }
        ?>

        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-500 rounded-full mb-4">
                <span class="text-2xl">💰</span>
            </div>
            <h1 class="text-3xl font-bold text-white">Gold Coin Wallet</h1>
            <p class="text-slate-400 mt-2">Kelola koin emas Anda dengan mudah</p>
        </div>

        <!-- Register Form -->
        <div class="bg-slate-800 rounded-2xl p-8 shadow-2xl border border-slate-700">
            <h2 class="text-2xl font-bold text-white mb-6">Daftar</h2>

            <form id="registerForm" class="space-y-4" method="POST" action="<?= CONTROLLER_URL . 'AuthController.php' ?>">
                <input type="hidden" name="action" value="register">
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Username</label>
                    <input name="username" type="text" id="registerUsername" placeholder="username"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                    <input name="email" type="email" id="registerEmail" placeholder="nama@email.com"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                    <input name="password" type="password" id="registerPassword" placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Konfirmasi Password</label>
                    <input name="confirm_password" type="password" id="registerConfirmPassword" placeholder="••••••••"
                        class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 transition"
                        required>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white font-semibold py-3 rounded-lg transition transform hover:scale-105 mt-6">
                    Daftar
                </button>
            </form>

            <p class="text-center text-slate-400 mt-6">
                Sudah punya akun?
                <a href="login.php" class="text-amber-500 hover:text-amber-400 font-semibold">Masuk di sini</a>
            </p>
            <div class="mt-6 p-4 bg-slate-700/50 rounded-lg border border-slate-600">
                <p class="text-xs text-slate-400 text-center">
                    <a href="#" class="text-amber-500 hover:text-amber-400 font-semibold">Back to Homepage</a>
                </p>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>