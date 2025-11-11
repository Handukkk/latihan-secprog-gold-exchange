<?php
$pageTitle = 'Gold Coin Wallet - Dashboard';
require_once '../Middlewares/middleware.php';
require_once '../Controllers/UserController.php';
include 'layout/header.php';

$user = get_user($_SESSION['user_id']);
?>
<script src="<?= SITE_ROOT ?>public/js/main.js"></script>

<div class="flex h-screen">
    <?php include 'layout/sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 overflow-y-auto">
        <!-- Mobile Header -->
        <div class="md:hidden bg-slate-800 border-b border-slate-700 p-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-lg">💰</div>
                <h1 class="text-lg font-bold text-white">Gold Wallet</h1>
            </div>
            <button onclick="toggleMobileMenu()" class="text-white">☰</button>
        </div>

        <div class="p-6 md:p-8">
            <!-- Balance Card -->
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-8 text-white mb-8 shadow-lg">
                <p class="text-amber-100 mb-2">Saldo Anda</p>
                <h2 class="text-4xl font-bold mb-2" id="balanceAmount"><?= $user['gold_balance'] ?></h2>
                <p class="text-amber-100">Gold Coins</p>
            </div>

            <!-- Quick Actions -->
            <!-- Changed links to buttons that trigger modals -->
            <div class="grid grid-cols-2 md:grid-cols-2 gap-4 mb-8">
                <button onclick="openTopupModal()" class="bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-lg p-4 text-center transition">
                    <div class="text-3xl mb-2">➕</div>
                    <p class="text-white font-medium text-sm">Top Up</p>
                </button>
                <button onclick="openWithdrawModal()" class="bg-slate-800 hover:bg-slate-700 border border-slate-700 rounded-lg p-4 text-center transition">
                    <div class="text-3xl mb-2">➖</div>
                    <p class="text-white font-medium text-sm">Withdraw</p>
                </button>
            </div>

            <!-- Transaction History -->
            <div class="bg-slate-800 rounded-2xl border border-slate-700 overflow-hidden">
                <div class="p-6 border-b border-slate-700">
                    <h3 class="text-xl font-bold text-white">Riwayat Transaksi</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-700">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">User</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Tanggal</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Tipe</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Jumlah</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Notes</th>
                            </tr>
                        </thead>
                        <tbody id="transactionTable">

                            <?php
                            // Fetch and display real transactions
                            $transactions = get_transaction($_SESSION['user_id']);
                            foreach ($transactions as $transaction) {
                                $date = date('d M Y', strtotime($transaction['created_at']));
                                $name = htmlspecialchars($transaction['username']);
                                $type = htmlspecialchars($transaction['type']);
                                $amount = htmlspecialchars($transaction['amount_gold']);
                                $notes = htmlspecialchars($transaction['methode']);

                                $amountClass = $transaction['type'] === 'TOPUP' ? 'text-amber-400' : 'text-red-400';
                                $amountSign = $transaction['type'] === 'TOPUP' ? '+' : '-';

                                echo '
                                    <tr class="border-b border-slate-700 hover:bg-slate-700/50">
                                    <td class="px-6 py-4 text-slate-300">' . $name . '</td>
                                        <td class="px-6 py-4 text-slate-300">' . $date . '</td>
                                        <td class="px-6 py-4 text-slate-300">' . $type . '</td>
                                        <td class="px-6 py-4 ' . $amountClass . ' font-semibold">' . $amountSign . number_format($amount) . '</td>
                                        <td class="px-6 py-4 text-slate-300">' . $notes . '</td>
                                    </tr>
                                ';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Added Top Up Modal -->
<div id="topupModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-slate-800 rounded-2xl border border-slate-700 w-full max-w-md mx-4 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Top Up Koin</h2>
            <button onclick="closeTopupModal()" class="text-slate-400 hover:text-white text-2xl">✕</button>
        </div>

        <form id="topupModalForm" method="POST" action="<?= SITE_ROOT ?>/app/Controllers/TransactionController.php">
            <div class="mb-4">
                <input type="hidden" name="action" value="TOPUP">
                <label class="block text-slate-300 text-sm font-medium mb-2">Jumlah Koin</label>
                <input type="number" name="amount" id="topupModalAmount" placeholder="Masukkan jumlah koin" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder-slate-400 focus:outline-none focus:border-amber-500" min="100" required>
            </div>

            <div class="mb-4">
                <label class="block text-slate-300 text-sm font-medium mb-2">Pilih Jumlah Cepat</label>
                <div class="grid grid-cols-3 gap-2">
                    <button type="button" onclick="setTopupAmount(500)" class="bg-slate-700 hover:bg-amber-500 text-white py-2 rounded-lg transition">500</button>
                    <button type="button" onclick="setTopupAmount(1000)" class="bg-slate-700 hover:bg-amber-500 text-white py-2 rounded-lg transition">1000</button>
                    <button type="button" onclick="setTopupAmount(5000)" class="bg-slate-700 hover:bg-amber-500 text-white py-2 rounded-lg transition">5000</button>
                </div>
            </div>

            <div class="mb-6 bg-slate-700 rounded-lg p-4">
                <div class="flex justify-between mb-2">
                    <span class="text-slate-300">Subtotal:</span>
                    <span class="text-white" id="topupModalSubtotal">Rp 0</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-slate-300">Biaya Admin (2%):</span>
                    <span class="text-white" id="topupModalFee">Rp 0</span>
                </div>
                <div class="border-t border-slate-600 pt-2 flex justify-between">
                    <span class="text-white font-semibold">Total:</span>
                    <span class="text-amber-400 font-bold text-lg" id="topupModalTotal">Rp 0</span>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-slate-300 text-sm font-medium mb-2">Metode Pembayaran</label>
                <select name="method" id="topupPaymentMethod" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-amber-500">
                    <option value="card">Kartu Kredit</option>
                    <option value="bank">Transfer Bank</option>
                    <option value="ewallet">E-Wallet</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded-lg transition">Lanjutkan Pembayaran</button>
        </form>
    </div>
</div>

<!-- Added Withdraw Modal -->
<div id="withdrawModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-slate-800 rounded-2xl border border-slate-700 w-full max-w-md mx-4 p-6 max-h-[90vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-white">Withdraw Koin</h2>
            <button onclick="closeWithdrawModal()" class="text-slate-400 hover:text-white text-2xl">✕</button>
        </div>

        <form id="withdrawModalForm" method="POST" action="<?= SITE_ROOT ?>/app/Controllers/TransactionController.php">
            <div class="mb-4">
                <input type="hidden" name="action" value="WITHDRAW">
                <label class="block text-slate-300 text-sm font-medium mb-2">Jumlah Koin</label>
                <input type="number" name="amount" id="withdrawModalAmount" placeholder="Masukkan jumlah koin" class="w-full bg-slate-700 border border-slate-600 rounded-lg px-4 py-2 text-white placeholder-slate-400 focus:outline-none focus:border-amber-500" min="100" required>
            </div>

            <div class="mb-6 bg-slate-700 rounded-lg p-4">
                <div class="flex justify-between mb-2">
                    <span class="text-slate-300">Subtotal:</span>
                    <span class="text-white" id="withdrawModalSubtotal">Rp 0</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-slate-300">Biaya Admin (1.5%):</span>
                    <span class="text-white" id="withdrawModalFee">Rp 0</span>
                </div>
                <div class="border-t border-slate-600 pt-2 flex justify-between">
                    <span class="text-white font-semibold">Diterima:</span>
                    <span class="text-amber-400 font-bold text-lg" id="withdrawModalTotal">Rp 0</span>
                </div>
            </div>

            <input value="Proses Withdraw" type="submit" class="cursor-pointer w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 rounded-lg transition">
        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>