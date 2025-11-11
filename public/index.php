<?php

require '../config/database.php';

if (!is_connect_to_db() || !is_db_exist() || !is_tables_exist()) {
    die("Something wrong, please run the installer first.");
}

// kalau udah ready semua, glhf
// Something bootsrap nanti di isi disini, tapi kalau udah aman pindah ke views handler.
require '../app/middlewares/middleware.php';
header("Location: " . SITE_ROOT . "app/Views/index.php");
