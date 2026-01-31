<?php
require_once "../includes/db.php";
session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(["error" => "unauthorized"]);
    exit;
}

$user_id = $_SESSION['user']['id'];

$res = mysqli_query($conn, "SELECT username,email,role FROM users WHERE id=$user_id");
$user = mysqli_fetch_assoc($res) ?? [];

echo json_encode($user);
