<?php
include 'config/config.php';
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Gold Coin Wallet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <!-- 404 Icon -->
            <div class="mb-8">
                <div class="inline-block">
                    <div class="text-9xl font-bold bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">
                        404
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Halaman Tidak Ditemukan
            </h1>
            <p class="text-xl text-slate-400 mb-8">
                Maaf, halaman yang Anda cari tidak ada atau telah dipindahkan. Silakan kembali ke halaman utama atau dashboard Anda.
            </p>

            <!-- Illustration -->
            <div class="mb-12 py-8">
                <div class="inline-block">
                    <svg class="w-48 h-48 text-amber-500 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" />
                    </svg>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <?php if ($isLoggedIn): ?>
                    <a href="<?= SITE_ROOT ?>/app/Views/dashboard.php" class="px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                        Kembali ke Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?= SITE_ROOT ?>/app/Views/index.php" class="px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                        Kembali ke Beranda
                    </a>
                <?php endif; ?>
            </div>

            <!-- Additional Help -->
            <div class="mt-12 pt-8 border-t border-slate-700">
                <p class="text-slate-400 mb-4">
                    Butuh bantuan? Hubungi tim support kami
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center text-sm">
                    <a href="mailto:support@goldcoinwallet.com" class="text-amber-400 hover:text-amber-300 transition-colors">
                        support@goldcoinwallet.com
                    </a>
                    <span class="text-slate-600">•</span>
                    <a href="tel:+62123456789" class="text-amber-400 hover:text-amber-300 transition-colors">
                        +62 123 456 789
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-amber-500 rounded-full mix-blend-multiply filter blur-3xl opacity-5 animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-72 h-72 bg-amber-600 rounded-full mix-blend-multiply filter blur-3xl opacity-5 animate-pulse"></div>
    </div>
</body>

</html>