<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gold_coin');

// helper utils to help u you check db connection and existence


function get_instance()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
    // Check connection
    if ($conn->connect_error) {
        return null;
    }
    return $conn;
}

function is_connect_to_db()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    // Check connection
    if ($conn->connect_error) {
        return false;
    }
    return true;
}

function is_db_exist()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    $result = $conn->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
    return $result && $result->num_rows > 0;
}

function is_tables_exist()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $tables = ['users', 'transactions'];
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '" . $table . "'");
        if (!$result || $result->num_rows == 0) {
            return false;
        }
    }
    return true;
}


