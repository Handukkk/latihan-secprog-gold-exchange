<?php
require_once '../../config/config.php';
require_once '../../config/database.php';


// function topup_transaction($user_id, $type, $amount_gold, $notes){
//todo: implement create transaction logic
// make sure to secure the query against SQL Injection
// just add gold to user id and update balance accordingly
// make sure save the notes to with format 'Top up via {method}'
// }
function topup_transaction($user_id, $type, $amount_gold, $notes) {
    $db = get_instance();
    if (!$db) {
        return false;
    }

    $db->begin_transaction();
    try {
        $stmt = $db->prepare("
        INSERT INTO transactions (user_id, type, amount_gold, methode) 
        VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("isds", $user_id, $type, $amount_gold, $notes);

        if (!$stmt->execute()) {
            throw new Exception("Transaction failed");
        }

        $stmt = $db->prepare("
            UPDATE users
            SET gold_balance = gold_balance + ?
            WHERE id = ?
        ");
        $stmt->bind_param("di", $amount_gold, $user_id);

        if (!$stmt->execute()) {
            throw new Exception("Update balance failed");
        }

        $db->commit();
        return true;
    } catch (Exception $e) {
        $db->rollback();
        return false;
    }
}

// function withdraw_transaction_request($user_id, $amount_gold, $methode)
// {
   //todo: implement withdraw transaction logic
   // make sure to secure the query against SQL Injection
   // just minus gold to user id and update balance accordingly
   // make sure cant minus if balance not enough
// }
function withdraw_transaction($user_id, $amount_gold) {
    $db = get_instance();
    if (!$db) {
        return false;
    }

    $db->begin_transaction();
    try {
        $stmt = $db->prepare("
        SELECT * 
        FROM users
        WHERE id = ?
        ");
        $stmt->bind_param("i", $user_id);
        
        $stmt->execute();
        $res = $stmt->get_result();
        $balance = $res->fetch_assoc();

        if ((float)$balance["gold_balance"] < $amount_gold) {
            throw new Exception("Insufficient balance");
        }

        $stmt = $db->prepare("
        INSERT INTO transactions (user_id, type, amount_gold, methode) 
        VALUES (?, 'WITHDRAW', ?, 'WITHDRAWED')
        ");
        $stmt->bind_param("id", $user_id, $amount_gold);

        if (!$stmt->execute()) {
            throw new Exception("Transaction failed");
        }

        $stmt = $db->prepare("
            UPDATE users
            SET gold_balance = gold_balance - ?
            WHERE id = ?
        ");
        $stmt->bind_param("di", $amount_gold, $user_id);

        if (!$stmt->execute()) {
            throw new Exception("Update balance failed");
        }

        $db->commit();
        return true;
    } catch (Exception $e) {
        $db->rollback();
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . SITE_ROOT . "app/Views/auth/login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $type = $_POST['action'] === 'TOPUP' ? 'TOPUP' : 'WITHDRAW';
    $amount_gold = floatval($_POST['amount']);
    $methode =  "";
    if (isset($_POST['method']))
        $methode = htmlspecialchars('Top up via ' . $_POST['method']);


    if ($type === 'WITHDRAW') {
        withdraw_transaction($user_id, $amount_gold);
        header("Location: " . SITE_ROOT . "app/Views/dashboard.php");
        exit;
    } else {
        $success = topup_transaction($user_id, $type, $amount_gold, $methode);
        if ($success) {
            header("Location: " . SITE_ROOT . "app/Views/dashboard.php");
            exit;
        }
    }
}
