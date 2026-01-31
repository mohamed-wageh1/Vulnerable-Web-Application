<?php
session_start();

function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: /login.php");
        exit;
    }
}

function require_admin() {
    require_login();

    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        http_response_code(403);
        die("403 Forbidden - Admins only");
    }
}
