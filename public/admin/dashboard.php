<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /public/index.php");
    exit;
}

// INTENTIONALLY WEAK CHECK (for vuln later)
if ($_SESSION['role'] !== 'admin') {
    // vuln: allow access anyway
}

echo "<h1>Admin Dashboard</h1>";
echo "<p>Role: " . $_SESSION['role'] . "</p>";
echo "<p>User ID: " . $_SESSION['user_id'] . "</p>";
?>
<script src="../assets/js/admin.js"></script>
<a href="upload.php">Upload Files</a>
