<?php
require_once "../includes/db.php";
session_start();

// NO CSRF PROTECTION (INTENTIONAL)
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM messages WHERE id = $id");

header("Location: messages.php");
?>