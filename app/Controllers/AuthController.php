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
    if(
        empty($email) ||
        empty($password)
    ) {
        header("Location:" . SITE_ROOT . "/app/Views/auth/login.php?error=67");
        exit;
    }

    $email = trim((string)$email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:" . SITE_ROOT . "/app/Views/auth/login.php?error=67");
    }

    $db = get_instance();
    if (!is_connect_to_db()) {
         header("Location:" . SITE_ROOT . "app/Views/auth/login.php?error=67");
         exit;
    }

    $stmt = $db->prepare("
        SELECT *
        FROM users
        WHERE email = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $res = $stmt->get_result();
    $user = $res->fetch_assoc();

    if ($user && password_verify($password, $user["password_hash"])) {
        session_regenerate_id(true);
        $_SESSION["user_id"] = $user["id"];
        header("Location:" . SITE_ROOT);
    } else {
        header("Location:" . SITE_ROOT . "app/Views/auth/login.php?error=1");
    }
    exit;
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
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=67");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=67");
    }

    $username = trim((string)$username);
    $username = filter_var($username, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $passowrd = (string)$password;
    $confirmPassword = (string)$confirmPassword;

    $db = get_instance();
    if (!is_connect_to_db()) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=67");
    }

    $stmt = $db->prepare("
        SELECT email
        FROM users
        WHERE email = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $email);

    $stmt->execute();
    $res = $stmt->get_result();
    $isEmail = $res->fetch_assoc();

    if ($isEmail) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=2");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=67");
        exit;
    }

    if ($password !== $confirmPassword) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=3");
        exit;
    }

    if (mb_strlen($password) < 8) {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=4");
        exit;
    }

    $hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $db->prepare("
        INSERT INTO users (username, email, password_hash)
        VALUES (?, ?, ?)
    ");
    $stmt->bind_param("sss", $username, $email, $hash);

    if ($stmt->execute()) {
        login($email, $password);
        exit;
    } else {
        header("Location:" . SITE_ROOT . "app/Views/auth/register.php?error=67");
        exit;
    }
}

// Case Session Management
// function logout(){
//     // TODO: implement logout logic
//     // and redirect to login page
// }
function logout() {
    session_unset();
    session_destroy();
    header("Location:" . SITE_ROOT);
    exit;
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
