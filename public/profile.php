<?php
$pageTitle = "User Profile";
require_once "../includes/header.php";

$user = $_SESSION['user'] ?? [];

$username = $user['username'] ?? '';
$email    = $user['email'] ?? '';
$role     = $user['role'] ?? 'user';
?>

<h2>User Profile</h2>

<p>Username: <?= htmlspecialchars($username) ?></p>

<p>Email:
    <?= $email !== '' ? htmlspecialchars($email) : '<em>not set</em>' ?>
</p>

<p>Role: <?= htmlspecialchars($role) ?></p>

<h2 id="profile-name"></h2>
<script src="assets/js/profile.js"></script>
