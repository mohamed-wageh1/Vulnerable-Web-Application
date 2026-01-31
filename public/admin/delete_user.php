<?php
require_once "../../includes/db.php";

// INTENTIONAL BROKEN ACCESS CONTROL
$id = $_GET['id'] ?? 0;

mysqli_query($conn, "DELETE FROM users WHERE id = $id");
