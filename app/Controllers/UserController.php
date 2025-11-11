<?php
require_once '../../config/config.php';
require_once '../../config/database.php';


// function get_user()
// {
//     //TODO: implement get user by id logic
//     // make sure to secure the query against SQL Injection
// }
function get_user($user_id) {
    if (empty($user_id)) {
        die("No user_id provided");
    }

    $db = get_instance();
    if (!$db) {
        die("Failed to connect to database");
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
    $stmt->bind_param("s", $user_id);

    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    return $user;
}


// function get_transaction($) {
    //todo: implement get transactions all logic
    // make sure to secure the query against SQL Injection
// }
function get_transaction($user_id) {
    if (empty($user_id)) {
        die("No user_id provided");
    }

    $db = get_instance();
    if (!$db) {
        die("Failed to connect to database");
    }

    $stmt = $db->prepare("SELECT * FROM transactions JOIN users ON transactions.user_id = users.id WHERE users.id = ?");
    $stmt->bind_param("s", $user_id);

    $stmt->execute();
    $res = $stmt->get_result();
    $transactions = $res->fetch_all(MYSQLI_ASSOC);
    
    return $transactions;
}
