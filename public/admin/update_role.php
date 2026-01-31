<?php
require_once "../../includes/db.php";
session_start();

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die("Access denied: Admins only");
}

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
    http_response_code(403);
    die("Invalid CSRF token");
}

$user_id = (int) $_POST['user_id'];
$role    = $_POST['role'];

if ($user_id === $_SESSION['user_id']) {
    die("You cannot change your own role");
}

if (!in_array($role, ['admin', 'user'])) {
    die("Invalid role");
}

$stmt = $conn->prepare("UPDATE users SET role=? WHERE id=?");
$stmt->bind_param("si", $role, $user_id);
$stmt->execute();

echo "OK";
