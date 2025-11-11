<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Coin Wallet - Dompet Digital Emas Terpercaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-slate-900 text-white">
    <!-- Navigation Header -->
    <nav class="fixed top-0 w-full bg-slate-900/95 backdrop-blur-md border-b border-slate-700 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-amber-600 rounded-lg flex items-center justify-center">
                        <span class="text-xl font-bold">💰</span>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">Gold Coin</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="hover:text-amber-400 transition">Fitur</a>
                    <a href="#how-it-works" class="hover:text-amber-400 transition">Cara Kerja</a>
                    <a href="#pricing" class="hover:text-amber-400 transition">Harga</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-4">
                    <?php if ($isLoggedIn): ?>
                        <a href="dashboard.php" class="btn-primary px-6 py-2 text-sm">Dashboard</a>
                    <?php else: ?>
                        <a href="./auth/login.php" class="text-amber-400 hover:text-amber-300 font-semibold transition">Masuk</a>
                        <a href="./auth/register.php" class="btn-primary px-6 py-2 text-sm">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div class="space-y-4">
                        <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                            Dompet Digital <span class="bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">Emas Terpercaya</span>
                        </h1>
                        <p class="text-xl text-slate-400">
                            Kelola koin emas digital Anda dengan aman, mudah, dan cepat. Transaksi instan tanpa ribet.
                        </p>
                    </div>

                    <?php if (!$isLoggedIn) { ?>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="./auth/register.php" class="btn-primary px-8 py-4 text-center font-semibold rounded-lg">
                                Mulai Sekarang
                            </a>
                            <a href="./auth/login.php" class="px-8 py-4 border-2 border-amber-500 text-amber-400 font-semibold rounded-lg hover:bg-amber-500/10 transition text-center">
                                Masuk Akun
                            </a>
                        </div>
                    <?php } ?>
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-8">
                        <div>
                            <p class="text-3xl font-bold text-amber-400">10K+</p>
                            <p class="text-slate-400">Pengguna Aktif</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-amber-400">$5M+</p>
                            <p class="text-slate-400">Transaksi</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold text-amber-400">99.9%</p>
                            <p class="text-slate-400">Uptime</p>
                        </div>
                    </div>
                </div>

                <!-- Right Visual -->
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-500/20 to-amber-600/20 rounded-3xl blur-3xl"></div>
                    <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl p-8 border border-slate-700">
                        <div class="space-y-6">
                            <!-- Card Preview -->
                            <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-2xl p-6 text-white shadow-2xl transform -rotate-3">
                                <div class="flex justify-between items-start mb-12">
                                    <div>
                                        <p class="text-sm opacity-80">Saldo Anda</p>
                                        <p class="text-3xl font-bold">2,500 GC</p>
                                    </div>
                                    <span class="text-4xl">💰</span>
                                </div>
                                <div class="flex justify-between items-end">
                                    <div>
                                        <p class="text-xs opacity-80">Nama Pemilik</p>
                                        <p class="font-semibold">John Doe</p>
                                    </div>
                                    <p class="text-sm">Valid Thru 12/25</p>
                                </div>
                            </div>

                            <!-- Transaction Preview -->
                            <div class="space-y-3">
                                <p class="text-sm text-slate-400 font-semibold">Transaksi Terbaru</p>
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center p-3 bg-slate-700/50 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center">
                                                <span>⬆️</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold">Top Up</p>
                                                <p class="text-xs text-slate-400">Hari ini</p>
                                            </div>
                                        </div>
                                        <p class="font-bold text-green-400">+500 GC</p>
                                    </div>
                                    <div class="flex justify-between items-center p-3 bg-slate-700/50 rounded-lg">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-red-500/20 rounded-full flex items-center justify-center">
                                                <span>⬇️</span>
                                            </div>
                                            <div>
                                                <p class="font-semibold">Withdraw</p>
                                                <p class="text-xs text-slate-400">Kemarin</p>
                                            </div>
                                        </div>
                                        <p class="font-bold text-red-400">-200 GC</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-slate-400">Semua yang Anda butuhkan untuk mengelola koin emas digital</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-dark hover:border-amber-500/50 hover:shadow-amber-500/20 hover:shadow-2xl transition">
                    <div class="w-14 h-14 bg-amber-500/20 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-2xl">🔒</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Keamanan Terjamin</h3>
                    <p class="text-slate-400">Enkripsi tingkat bank untuk melindungi setiap transaksi Anda dengan teknologi terkini.</p>
                </div>

                <!-- Feature 2 -->
                <div class="card-dark hover:border-amber-500/50 hover:shadow-amber-500/20 hover:shadow-2xl transition">
                    <div class="w-14 h-14 bg-amber-500/20 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-2xl">⚡</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Transaksi Instan</h3>
                    <p class="text-slate-400">Top up dan withdraw dalam hitungan detik tanpa perlu menunggu lama.</p>
                </div>

                <!-- Feature 3 -->
                <div class="card-dark hover:border-amber-500/50 hover:shadow-amber-500/20 hover:shadow-2xl transition">
                    <div class="w-14 h-14 bg-amber-500/20 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-2xl">📊</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Laporan Lengkap</h3>
                    <p class="text-slate-400">Pantau semua transaksi Anda dengan dashboard yang detail dan mudah dipahami.</p>
                </div>

                <!-- Feature 4 -->
                <div class="card-dark hover:border-amber-500/50 hover:shadow-amber-500/20 hover:shadow-2xl transition">
                    <div class="w-14 h-14 bg-amber-500/20 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-2xl">💳</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Banyak Metode Pembayaran</h3>
                    <p class="text-slate-400">Dukung transfer bank, e-wallet, dan berbagai metode pembayaran lainnya.</p>
                </div>

                <!-- Feature 5 -->
                <div class="card-dark hover:border-amber-500/50 hover:shadow-amber-500/20 hover:shadow-2xl transition">
                    <div class="w-14 h-14 bg-amber-500/20 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-2xl">🌍</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Akses Dimana Saja</h3>
                    <p class="text-slate-400">Kelola dompet Anda dari perangkat apa pun, kapan pun, di mana pun.</p>
                </div>

                <!-- Feature 6 -->
                <div class="card-dark hover:border-amber-500/50 hover:shadow-amber-500/20 hover:shadow-2xl transition">
                    <div class="w-14 h-14 bg-amber-500/20 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-2xl">👥</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Dukungan 24/7</h3>
                    <p class="text-slate-400">Tim support kami siap membantu Anda kapan saja dengan respons cepat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Cara Kerja</h2>
                <p class="text-xl text-slate-400">Tiga langkah mudah untuk memulai</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full flex items-center justify-center mb-6 text-3xl font-bold">
                            1
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-center">Daftar Akun</h3>
                        <p class="text-slate-400 text-center">Buat akun baru dengan email dan password yang aman dalam waktu kurang dari 1 menit.</p>
                    </div>
                    <div class="hidden md:block absolute top-20 left-[60%] w-[40%] h-1 bg-gradient-to-r from-amber-500 to-transparent"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full flex items-center justify-center mb-6 text-3xl font-bold">
                            2
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-center">Top Up Saldo</h3>
                        <p class="text-slate-400 text-center">Pilih metode pembayaran dan top up koin emas sesuai kebutuhan Anda.</p>
                    </div>
                    <div class="hidden md:block absolute top-20 left-[60%] w-[40%] h-1 bg-gradient-to-r from-amber-500 to-transparent"></div>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="flex flex-col items-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full flex items-center justify-center mb-6 text-3xl font-bold">
                            3
                        </div>
                        <h3 class="text-2xl font-bold mb-3 text-center">Mulai Transaksi</h3>
                        <p class="text-slate-400 text-center">Gunakan koin emas Anda untuk berbagai keperluan atau withdraw kapan saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="py-20 px-4 sm:px-6 lg:px-8 bg-slate-800/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Harga Transparan</h2>
                <p class="text-xl text-slate-400">Biaya admin yang kompetitif dan jelas</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Pricing Card 1 -->
                <div class="card-dark">
                    <h3 class="text-2xl font-bold mb-2">Top Up</h3>
                    <p class="text-slate-400 mb-6">Biaya admin</p>
                    <p class="text-4xl font-bold text-amber-400 mb-6">1%</p>
                    <ul class="space-y-3 text-slate-300">
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Proses instan
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Berbagai metode
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Aman terjamin
                        </li>
                    </ul>
                </div>

                <!-- Pricing Card 2 -->
                <div class="card-dark border-2 border-amber-500 relative">
                    <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-amber-500 to-amber-600 px-4 py-1 rounded-full text-sm font-bold">
                        POPULER
                    </div>
                    <h3 class="text-2xl font-bold mb-2">Withdraw</h3>
                    <p class="text-slate-400 mb-6">Biaya admin</p>
                    <p class="text-4xl font-bold text-amber-400 mb-6">2%</p>
                    <ul class="space-y-3 text-slate-300">
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Proses cepat
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Ke rekening bank
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Konfirmasi email
                        </li>
                    </ul>
                </div>

                <!-- Pricing Card 3 -->
                <div class="card-dark">
                    <h3 class="text-2xl font-bold mb-2">Transfer</h3>
                    <p class="text-slate-400 mb-6">Biaya admin</p>
                    <p class="text-4xl font-bold text-amber-400 mb-6">Gratis</p>
                    <ul class="space-y-3 text-slate-300">
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Tanpa biaya
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Antar pengguna
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="text-amber-400">✓</span> Instan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-gradient-to-r from-amber-500/20 to-amber-600/20 border border-amber-500/50 rounded-3xl p-12 text-center">
                <h2 class="text-4xl font-bold mb-4">Siap Memulai?</h2>
                <p class="text-xl text-slate-300 mb-8">Bergabunglah dengan ribuan pengguna yang telah mempercayai Gold Coin Wallet</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">

                    <?php if (!$isLoggedIn) { ?>
                        <a href="./auth/register.php" class="btn-primary px-8 py-4 font-semibold">
                            Daftar Gratis Sekarang
                        </a>
                        <a href="./auth/login.php" class="px-8 py-4 border-2 border-amber-500 text-amber-400 font-semibold rounded-lg hover:bg-amber-500/10 transition">
                            Sudah Punya Akun? Masuk
                        </a>

                    <?php } else { ?>
                        <a href="dashboard.php" class="px-8 py-4 border-2 border-amber-500 text-amber-400 font-semibold rounded-lg hover:bg-amber-500/10 transition">
                            Kunjungi Dashboard
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-700 py-12 px-4 sm:px-6 lg:px-8 bg-slate-900/50">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Brand -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-amber-400 to-amber-600 rounded-lg flex items-center justify-center">
                            <span class="text-xl font-bold">💰</span>
                        </div>
                        <span class="text-xl font-bold">Gold Coin</span>
                    </div>
                    <p class="text-slate-400">Dompet digital emas terpercaya untuk semua kebutuhan Anda.</p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-bold mb-4">Produk</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#features" class="hover:text-amber-400 transition">Fitur</a></li>
                        <li><a href="#pricing" class="hover:text-amber-400 transition">Harga</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Keamanan</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-bold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-amber-400 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Blog</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Karir</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="space-y-2 text-slate-400">
                        <li><a href="#" class="hover:text-amber-400 transition">Privasi</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-amber-400 transition">Kontak</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-700 pt-8 text-center text-slate-400">
                <p>&copy; 2025 Gold Coin Wallet. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>