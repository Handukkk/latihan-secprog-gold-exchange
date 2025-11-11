<!-- Sidebar -->
<aside class="w-64 bg-slate-800 border-r border-slate-700 p-6 overflow-y-auto hidden md:block">
    <div class="flex items-center gap-3 mb-8">
        <div class="w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center text-xl">💰</div>
        <h1 class="text-xl font-bold text-white">Gold Wallet</h1>
    </div>

    <nav class="space-y-2">
        <a href="dashboard.php" class="flex items-center gap-3 px-4 py-3 <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'bg-amber-500/20 text-amber-400 border border-amber-500/30' : 'text-slate-300 hover:bg-slate-700'; ?> rounded-lg font-medium transition">
            <span>📊</span> Dashboard
        </a>
    </nav>

    <div class="mt-8 pt-8 border-t border-slate-700">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-slate-700 rounded-full flex items-center justify-center">👤</div>
            <div>
                <p class="text-sm font-medium text-white" id="sidebarUsername"><?= $user["username"] ?></p>
                <p class="text-xs text-slate-400">Member</p>
            </div>
        </div>
        <form action="<?= SITE_ROOT ?>/app/Controllers/AuthController.php" method="post">
            <input type="hidden" name="action" value="logout">
            <input type="submit" class="cursor-pointer w-full px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg transition text-sm font-medium" value="Logout">
        </form>
    </div>
</aside>