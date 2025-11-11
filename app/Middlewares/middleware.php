<?php

// helper utils to help u you check db connection and existence
// check session too
require_once __DIR__ . '/../../config/config.php';
require_once SERVER_ROOT . '/config/database.php';
session_start();

function check_app_ready()
{
    return is_connect_to_db() && is_db_exist() && is_tables_exist();
}

function check_user_logged_in()
{
    return isset($_SESSION['user_id']);
}


if (
    !check_user_logged_in()
    && str_contains($_SERVER['REQUEST_URI'], "login.php") == false
    && str_contains($_SERVER['REQUEST_URI'], "register.php") == false
) {
    header("Location:" . SITE_ROOT . "app/Views/index.php");
    exit;
}


if (
    check_user_logged_in()
    && (str_contains($_SERVER['REQUEST_URI'], "login.php") == true
        || str_contains($_SERVER['REQUEST_URI'], "register.php") == true)
) {
    header("Location:" . SITE_ROOT . "app/Views/dashboard.php");
    exit;
}
