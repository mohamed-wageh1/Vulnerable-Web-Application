<?php
require_once "../../includes/db.php";
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    die("Admins only");
}

$user_id = (int) $_POST['user_id'];
$role    = $_POST['role'];

if ($user_id === $_SESSION['user_id']) {
    die("You cannot change your own role");
}

if (!in_array($role, ['admin', 'user'])) {
    die("Invalid role");
}

$query = "UPDATE users SET role='$role' WHERE id=$user_id";
mysqli_query($conn, $query);

echo "OK";
