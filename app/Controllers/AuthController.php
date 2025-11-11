<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

// This controller willl handle user authentication: login, register, logout and sql injection prevention


// function login($email, $password) {
//     //TODO: implement login logic
//     // validate credentials against stored user data
//     // start user session upon successful login
//     // redirect to dashboard or show error message on failure
// }
session_start();
function login($email, $password) {
    if(empty($email) || empty($password)) {
        header("Location:" . SITE_ROOT . "app/Views/auth/login.php?error=5");
    }

    $db = get_instance();
    if(!$db) {
        header("Location:" . SITE_ROOT . "app/Views/auth/login.php?error=5");
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param("s", $email);
    
    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if($user && password_verify($password, $user["password_hash"])) {
        $_SESSION['user_id'] = $user["id"];
        $_SESSION['username'] = $user["username"];

        header("Location: /");
        exit;
    } else {
        header("Location:" . SITE_ROOT . "app/Views/auth/login.php?error=1");
    }
}


// Case Prepared Statements for Security
// function register($username, $email, $password, $confirmPassword){
//     // TODO: implement registration logic & securely store user credentials
//     // criteria: password min 8 chars
//     // handle duplicate email
//     // and redirect to login page upon success
// }
function register($username, $email, $password, $confirmPassword) {
    if (
        empty($username) ||
        empty($email) ||
        empty($password) ||
        empty($confirmPassword)
    ) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=5");
    }

    $db = get_instance();
    if (!$db) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=5");
    }

    $stmt = $db->prepare("SELECT email FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $res = $stmt->get_result();
    $isEmail = $res->fetch_assoc();

    if ($isEmail) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=2");
    }

    if ($password !== $confirmPassword) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=3");
    }

    if (mb_strlen($password) < 8) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=4");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, email, password_hash, gold_balance) VALUES (?, ?, ?, 0.00)");
    $stmt->bind_param("sss", $username, $email, $password_hash);

    $stmt->execute();

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if ($user) {
        $_SESSION['user_id'] = $user["id"];
        $_SESSION['username'] = $user["username"];

        header("Location: /");
        exit;
    }
}


// Case Session Management
// function logout(){
//     // TODO: implement logout logic
//     // and redirect to login page
// }
function logout() {
    session_destroy();
    header("Location: /");
}

// main handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    switch ($action) {
        case 'login':
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            login($email, $password);
            break;

        case 'register':
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            register($username, $email, $password, $confirmPassword);
            break;

        case 'logout':
            logout();
            break;

        default:
            // Invalid action
            header("HTTP/1.1 400 Bad Request");
            echo "Invalid action.";
            break;
    }
}
