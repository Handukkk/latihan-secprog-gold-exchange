# Gold Coin Game - Aplikasi Dompet Sederhana

Ini adalah proyek aplikasi web untuk dompet "Gold Coin Game" yang dibangun menggunakan **PHP Vanilla** dengan arsitektur **MVC (Model-View-Controller)** sederhana. Proyek ini meminta kalian buat melakukan patching

## 🌟 Fitur Utama

* **Otentikasi Pengguna:** Sistem Register & Login lengkap berbasis Session.
* **Dashboard:** Halaman utama untuk melihat saldo Gold Coin dan riwayat transaksi.
* **Simulasi Top Up:** Fitur untuk menambah saldo Gold Coin melalui *fake payment gateway*.
* **Simulasi Withdraw:** Fitur untuk mengajukan penarikan Gold Coin (simulasi ke rekening bank).

## 💻 Tumpukan Teknologi (Stack)

* **Backend:** PHP Vanilla (direkomendasikan PHP 8.0+)
* **Database:** MySQL
* **Server:** Apache (dengan `mod_rewrite` aktif)
* **Frontend:** HTML/CSS/JS (Struktur disiapkan untuk diisi dengan kode dari v0.dev atau framework frontend lainnya).

## 🚀 Cara Instalasi

Ikuti langkah-langkah ini untuk menjalankan proyek secara lokal:

1.  **Salin Proyek:**
    Salin folder proyek (`gold-coin-game`) ke *document root* server Anda (misal: `C:\xampp\htdocs\`).

2.  **Konfigurasi Database:**
    Buka file `config/database.php`. Sesuaikan nilai konstanta berikut dengan pengaturan MySQL Anda:
    * `DB_HOST` (biasanya 'localhost')
    * `DB_USER` (biasanya 'root')
    * `DB_PASS` (password Anda, mungkin kosong)
    * `DB_NAME` (nama database, misal: 'gold_coin_game')

3.  **Jalankan Server:**
    Pastikan server Apache dan MySQL Anda berjalan (misal: melalui XAMPP Control Panel).

4.  **Jalankan Skrip Instalasi:**
    Buka browser Anda dan navigasikan ke skrip instalasi:
    ```
    http://localhost/gold-coin-game/install.php
    ```
    Skrip ini akan secara otomatis membuat database dan semua tabel yang diperlukan, serta satu akun admin default.

5.  **WAJIB: Hapus Instalasi!**
    Setelah Anda melihat pesan "Setup Database Selesai!", **SEGERA HAPUS** file `install.php` dari proyek Anda. Ini adalah langkah keamanan yang krusial.

6.  **Selesai!**
    Aplikasi Anda sekarang siap diakses.

## 📂 Struktur Folder

```
/gold-coin-game/
├── app/
│   ├── Controllers/    # Logika bisnis (Auth, Dashboard, dll)
│   ├── Models/         # Interaksi database (User, Transaction)
│   └── Views/          # File-file UI (HTML/PHP)
│
├── config/
│   └── database.php    # Kredensial & konstanta utama
│
├── public/             # Folder yang diakses web
│   ├── css/
│   ├── js/
│   ├── .htaccess       # Aturan routing
│   └── index.php       # Router Utama
│
├── .htaccess           # Keamanan (blokir akses ke 'app')
├── install.php         # Skrip setup database (HAPUS SETELAH DIPAKAI)
└── README.md           # File ini
```

## 🧑‍💼 Akun Admin Default

Setelah menjalankan `install.php`, Anda dapat login menggunakan akun berikut:

* **Username:** `admin`
* **Password:** `admin123` (Sesuai yang di-set di `install.php`)