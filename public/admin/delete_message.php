<?php
session_start();
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'admin') {
    http_response_code(403);
    die("Access denied");
}

if (
    !isset($_POST['csrf_token'], $_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    http_response_code(403);
    die("Invalid CSRF token");
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    http_response_code(400);
    die("Invalid message ID");
}

$stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
$stmt->execute([$id]);

header("Location: messages.php");
exit;
