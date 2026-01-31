<?php

require_once "../../includes/db.php";

$result = mysqli_query($conn, "SELECT id, username, role FROM users");

$users = [];

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

header("Content-Type: application/json");
echo json_encode($users);
